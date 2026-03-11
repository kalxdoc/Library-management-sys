<?php
// public/student_dashboard.php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php"); exit();
}
require_once __DIR__ . '/../src/Models/Book.php';
require_once __DIR__ . '/../src/Models/Transaction.php';

$bookModel = new Book();
$txModel = new Transaction();
$availableBooks = $bookModel->getAll();
$myBooks = $txModel->getStudentTransactions($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - LMS</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Student Library Portal</h1>
            <div class="user-info">
                Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> | 
                <button onclick="upgradeSub()">Upgrade to Premium</button> | 
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <section>
            <h2>My Borrowed Books</h2>
            <div class="card-grid">
                <?php if(empty($myBooks)): ?>
                    <p>You have no active borrows.</p>
                <?php endif; ?>
                <?php foreach($myBooks as $tx): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($tx['title']); ?></h3>
                    <p>Author: <?php echo htmlspecialchars($tx['author']); ?></p>
                    <p>Deadline: <span class="deadline"><?php echo $tx['return_deadline']; ?></span></p>
                    <p>Current Fine: $<?php echo number_format($txModel->calculateFine($tx['return_deadline']), 2); ?></p>
                    <button onclick="returnBook(<?php echo $tx['id']; ?>)">Return Book</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2>Available Books</h2>
            <table id="catalogTable">
                <thead>
                    <tr><th>Title</th><th>Author</th><th>Available</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php foreach($availableBooks as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo $book['available_quantity']; ?> / <?php echo $book['total_quantity']; ?></td>
                        <td>
                            <?php if($book['available_quantity'] > 0): ?>
                            <button onclick="borrowBook(<?php echo $book['id']; ?>)">Borrow</button>
                            <?php else: ?>
                            <span class="out-of-stock">Out of Stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <script src="assets/js/student.js"></script>
</body>
</html>
