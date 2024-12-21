<?php
session_start();
include 'db.php';

// Pastikan pengguna sudah login dan memiliki peran sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $image = $_POST['image'];
    $link = $_POST['link'];

    // Pastikan data tidak kosong
    if (!empty($name) && !empty($image) && !empty($link)) {
        // Masukkan data ke dalam tabel commodities
        $stmt = $pdo->prepare("INSERT INTO commodities (name, image, link) VALUES (:name, :image, :link)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':link', $link);

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, arahkan kembali ke halaman index.php
            header("Location: admin.php");
            exit();
        } else {
            echo "Gagal menambahkan komoditas.";
        }
    } else {
        echo "Semua field harus diisi.";
    }
}
?>
