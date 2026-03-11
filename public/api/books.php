<?php
// public/api/books.php
session_start();
require_once __DIR__ . '/../../src/Models/Book.php';

// Security: Only Admins can access this API
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$bookModel = new Book();
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

try {
    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            echo json_encode($bookModel->getById($_GET['id']));
        } else {
            echo json_encode($bookModel->getAll());
        }
    } 
    elseif ($method === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data['id']) && !empty($data['id'])) {
            // Update
            $success = $bookModel->update($data['id'], $data['title'], $data['author'], $data['isbn'], $data['category'], $data['quantity']);
        } else {
            // Create
            $success = $bookModel->create($data['title'], $data['author'], $data['isbn'], $data['category'], $data['quantity']);
        }
        echo json_encode(['success' => $success]);
    } 
    elseif ($method === 'DELETE') {
        $id = $_GET['id'];
        $success = $bookModel->delete($id);
        echo json_encode(['success' => $success]);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
