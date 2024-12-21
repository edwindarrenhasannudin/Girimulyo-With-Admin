<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $link = $_POST['link'];

    // Validasi input
    if (empty($id) || empty($name) || empty($image) || empty($link)) {
        die("Data tidak boleh kosong.");
    }

    try {
        $stmt = $pdo->prepare("UPDATE commodities SET name = ?, image = ?, link = ? WHERE id = ?");
        $stmt->execute([$name, $image, $link, $id]);

        // Redirect kembali ke panel admin setelah update
        header("Location: admin.php");
        exit();
    } catch (Exception $e) {
        die("Gagal memperbarui komoditas: " . $e->getMessage());
    }
} else {
    die("Metode tidak diizinkan.");
}
?>
