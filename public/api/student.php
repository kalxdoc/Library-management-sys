<?php
// Shafin
session_start();
require_once __DIR__ . '/../../src/Models/Transaction.php';
require_once __DIR__ . '/../../src/Models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$txModel = new Transaction();
$userModel = new User();
$data = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? '';

header('Content-Type: application/json');

try {
    if ($action === 'borrow') {
        $sub = $userModel->getSubscriptionInfo($_SESSION['user_id']);
        $txModel->borrowBook($_SESSION['user_id'], $data['book_id'], $sub);
        echo json_encode(['success' => true]);
    } 
    elseif ($action === 'return') {
        echo json_encode($txModel->returnBook($data['transaction_id']));
    }
    elseif ($action === 'upgrade') {
        $success = $userModel->upgradeSubscription($_SESSION['user_id'], 'premium');
        echo json_encode(['success' => $success]);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
