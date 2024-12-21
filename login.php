<?php
session_start();
include 'db.php';

// Array untuk menyimpan nama file gambar
$images = [];
for ($i = 1; $i <= 18; $i++) {
    $images[] = "asset/FOTO BERJALAN-$i.jpg"; // Menambahkan nama file gambar ke array
}

// Mengacak pemilihan gambar pertama
$randomImage = $images[array_rand($images)];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Bandingkan password secara langsung
    if ($user && $user['password'] === $password) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: admin.php");
        exit();
    } else {
        $error = "Username atau password tidak valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desa Girimulyo</title>
    <link rel="icon" href="asset/logo.png" type="x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('<?php echo $randomImage; ?>'); /* Menggunakan gambar acak sebagai latar belakang */
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out; /* Transisi halus saat berganti gambar */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-96 bg-opacity-80"> <!-- Menambahkan transparansi pada latar belakang form -->
        <div class="flex justify-center mb-6">
            <img src="asset/logo.png" alt="Logo" style="height: 80px;">
        </div>
        <h2 class="text-2xl font-bold text-center text-green-600 mb-6">Login Admin</h2>
        <form method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-green-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-green-500" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 rounded hover:bg-green-700 transition duration-200">Login</button>
        </form>
        <?php if (isset($error)) echo '<div class="mt-4 text-red-500 text-center">' . $error . '</div>'; ?>
    </div>

    <script>
        const images = [
            <?php foreach ($images as $image) {
                echo "'$image',";
            } ?>
        ];

        let currentIndex = 0;

        function changeBackground() {
            currentIndex = (currentIndex + 1) % images.length; // Menghitung indeks gambar berikutnya
            document.body.style.backgroundImage = `url('${images[currentIndex]}')`; // Mengubah gambar latar belakang
        }

        setInterval(changeBackground, 5000); // Mengganti gambar setiap 5 detik
    </script>
</body>
</html>