<?php
require_once 'db.php';

function getUserByPhone($phone) {
    $db = new Database();
    $conn = $db->getConnection();
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $stmt->close();
    $db->closeConnection();
    
    return $user;
}

function createUser($name, $phone) {
    $db = new Database();
    $conn = $db->getConnection();
    
    $stmt = $conn->prepare("INSERT INTO users (name, phone) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $phone);
    $success = $stmt->execute();
    
    $userId = $conn->insert_id;
    
    $stmt->close();
    $db->closeConnection();
    
    return $success ? $userId : false;
}

function addRecyclingRecord($userId, $bottleCount) {
    $db = new Database();
    $conn = $db->getConnection();
    
    $stmt = $conn->prepare("INSERT INTO recycling_records (user_id, bottle_count) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $bottleCount);
    $success = $stmt->execute();
    
    $stmt->close();
    $db->closeConnection();
    
    return $success;
}

function getUserTotalBottles($userId) {
    $db = new Database();
    $conn = $db->getConnection();
    
    $stmt = $conn->prepare("SELECT SUM(bottle_count) as total FROM recycling_records WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    $db->closeConnection();
    
    return $row['total'] ?? 0;
}

function startSessionIfNotStarted() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
?>