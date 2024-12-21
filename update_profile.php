<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($id) || empty($title) || empty($content)) {
        echo "All fields are required.";
        exit();
    }

    try {
        $stmt = $pdo->prepare("UPDATE profiles SET title = :title, content = :content WHERE id = :id");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: admin.php?message=Profile updated successfully.");
            exit();
        } else {
            echo "Failed to update profile.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
    exit();
}
