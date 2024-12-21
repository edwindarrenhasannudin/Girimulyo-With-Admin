<?php
session_start();
include 'db.php';

// Periksa apakah pengguna adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Periksa apakah ID dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($id === false) {
        header("Location: admin_panel.php?error=ID+tidak+valid");
        exit();
    }

    try {
        // Hapus komoditas berdasarkan ID
        $stmt = $pdo->prepare("DELETE FROM commodities WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Redirect kembali ke halaman admin dengan pesan sukses
            header("Location: admin.php?message=Komoditas+berhasil+dihapus");
            exit();
        } else {
            // Redirect jika tidak ada baris yang dihapus
            header("Location: admin.php?error=Komoditas+tidak+ditemukan");
            exit();
        }
    } catch (PDOException $e) {
        // Tangani kesalahan jika query gagal
        header("Location: admin.php?error=Error+dalam+penghapusan");
        exit();
    }
} else {
    // Redirect jika ID tidak dikirim
    header("Location: admin.php?error=ID+tidak+valid");
    exit();
}
?>
