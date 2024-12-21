<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data profil
$stmt = $pdo->query("SELECT * FROM profiles");
$profile = $stmt->fetch();

// Ambil data komoditas
$stmt = $pdo->query("SELECT * FROM commodities");
$commodities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
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

        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input, textarea, button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            height: 150px;
            resize: vertical;
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

        .commodity {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .commodity:last-child {
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
        <h1>Panel Admin - Nama Desa</h1>
    </header>

    <div class="container">
        <h1>Panel Admin</h1>

        <h2>Edit Profil</h2>

        <!-- Form Profil -->
        <form method="POST" action="update_profile.php">
            <!-- Label untuk Nama Form -->
            <div class="form-label">Form Profil (Title)</div>
            <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
            <input type="text" name="title" value="<?php echo $profile['title']; ?>" required>

            <div class="form-label">Form Profil (Content)</div>
            <textarea name="content" required><?php echo $profile['content']; ?></textarea>

            <button type="submit">Update Profil</button>
        </form>
    </div>
</body>
</html>
