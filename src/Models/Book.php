<?php
// src/Models/Book.php
require_once __DIR__ . '/../../config/db.php';

class Book {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM books ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($title, $author, $isbn, $category, $quantity) {
        $sql = "INSERT INTO books (title, author, isbn, category, total_quantity, available_quantity) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $author, $isbn, $category, $quantity, $quantity]);
    }

    public function update($id, $title, $author, $isbn, $category, $quantity) {
        $sql = "UPDATE books SET title = ?, author = ?, isbn = ?, category = ?, total_quantity = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $author, $isbn, $category, $quantity, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
