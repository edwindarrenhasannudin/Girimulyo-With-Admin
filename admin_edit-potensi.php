<?php
session_start();
include 'db.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data potensi dari tabel potensi
$stmt = $pdo->query("SELECT * FROM potensi");
$potensiList = $stmt->fetchAll();

// Menangani proses tambah potensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_potensi'])) {
    $nama = $_POST['nama'];
    if (!empty($nama)) {
        $stmt = $pdo->prepare("INSERT INTO potensi (nama) VALUES (:nama)");
        $stmt->execute(['nama' => $nama]);
        header("Location: admin.php");
        exit();
    }
}

// Menangani proses edit potensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_potensi'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    if (!empty($id) && !empty($nama)) {
        $stmt = $pdo->prepare("UPDATE potensi SET nama = :nama WHERE id = :id");
        $stmt->execute(['nama' => $nama, 'id' => $id]);
        header("Location: admin_edit-potensi.php");
        exit();
    }
}

// Menangani proses hapus potensi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_potensi'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $stmt = $pdo->prepare("DELETE FROM potensi WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: admin_edit-potensi.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Potensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            height: 50px;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #4CAF50;
        }

        form {
            margin-bottom: 20px;
        }

        input, textarea, button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .potensi-item {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .potensi-item:last-child {
            border-bottom: none;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions button {
            flex: 1;
        }

        .add-form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="asset/logo.png" alt="Logo">
        <h1>Panel Admin - Manage Potensi</h1>
    </header>

    <div class="container">
        <h1>Kelola Potensi</h1>

        <h2>Daftar Potensi</h2>
        <?php foreach ($potensiList as $potensi): ?>
            <div class="potensi-item">
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $potensi['id']; ?>">
                    <input type="text" name="nama" value="<?php echo $potensi['nama']; ?>" required>
                    <div class="actions">
                        <button type="submit" name="edit_potensi">Update</button>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $potensi['id']; ?>">
                            <button type="submit" name="delete_potensi" style="background-color: #f44336;">Hapus</button>
                        </form>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>

        <h2>Tambah Potensi</h2>
        <form method="POST" action="" class="add-form">
            <input type="text" name="nama" placeholder="Nama Potensi" required>
            <button type="submit" name="add_potensi">Tambah Potensi</button>
        </form>
    </div>
</body>
</html>
