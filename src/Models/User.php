<?php
// src/Models/User.php
require_once __DIR__ . '/../../config/db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function register($username, $email, $password, $role = 'student', $subscription = 'general') {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO users (username, email, password, role, subscription_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        try {
            return $stmt->execute([$username, $email, $hashed_password, $role, $subscription]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function upgradeSubscription($userId, $type) {
        $sql = "UPDATE users SET subscription_type = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$type, $userId]);
    }

    public function getSubscriptionInfo($userId) {
        $stmt = $this->db->prepare("SELECT subscription_type FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }
}
