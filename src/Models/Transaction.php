<?php
// Developed by Hasan Shahriar Nayan
require_once __DIR__ . '/../../config/db.php';

class Transaction {
    private $db;
    private $limits = [
        'general' => ['max_books' => 3, 'days' => 7],
        'premium' => ['max_books' => 10, 'days' => 30]
    ];
    private $fine_rate = 1.00; // $1 per day

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function borrowBook($userId, $bookId, $subscriptionType) {
        // 1. Check if user exceeded limits
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM transactions WHERE user_id = ? AND status = 'borrowed'");
        $stmt->execute([$userId]);
        if ($stmt->fetchColumn() >= $this->limits[$subscriptionType]['max_books']) {
            throw new Exception("Subscription limit reached.");
        }

        // 2. Check book availability
        $stmt = $this->db->prepare("SELECT available_quantity FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        if ($stmt->fetchColumn() <= 0) {
            throw new Exception("Book currently unavailable.");
        }

        // 3. Calculate deadline
        $days = $this->limits[$subscriptionType]['days'];
        $deadline = date('Y-m-d', strtotime("+$days days"));

        $this->db->beginTransaction();
        try {
            // Create transaction
            $stmt = $this->db->prepare("INSERT INTO transactions (user_id, book_id, return_deadline) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $bookId, $deadline]);

            // Update book availability
            $stmt = $this->db->prepare("UPDATE books SET available_quantity = available_quantity - 1 WHERE id = ?");
            $stmt->execute([$bookId]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function returnBook($transactionId) {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE id = ?");
        $stmt->execute([$transactionId]);
        $tx = $stmt->fetch();

        if (!$tx) throw new Exception("Transaction not found.");

        $fine = $this->calculateFine($tx['return_deadline']);
        
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("UPDATE transactions SET return_date = NOW(), status = 'returned', fine_amount = ? WHERE id = ?");
            $stmt->execute([$fine, $transactionId]);

            $stmt = $this->db->prepare("UPDATE books SET available_quantity = available_quantity + 1 WHERE id = ?");
            $stmt->execute([$tx['book_id']]);

            $this->db->commit();
            return ['success' => true, 'fine' => $fine];
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function calculateFine($deadline) {
        $today = new DateTime();
        $due = new DateTime($deadline);
        if ($today > $due) {
            $diff = $today->diff($due)->days;
            return $diff * $this->fine_rate;
        }
        return 0.00;
    }

    public function getStudentTransactions($userId) {
        $sql = "SELECT t.*, b.title, b.author 
                FROM transactions t 
                JOIN books b ON t.book_id = b.id 
                WHERE t.user_id = ? AND t.status = 'borrowed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
