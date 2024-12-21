<?php

session_start();
include 'db.php';

$stmt = $pdo->query("SELECT * FROM potensi");
$potensiList = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Girimulyo</title>
    <link rel="icon" href="asset/logo.png" type="x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container-fluid px-0">
        <header class="py-3">
            <div class="container-fluid d-flex justify-content-between align-items-center px-0">
                <div class="d-flex align-items-center">
                    <img src="asset/logo.png" alt="Logo Desa Girimulyo" class="mr-2" style="width: 50px;">
                    <h1 id="judul" class="h4 mb-0 stroked-text ml-10"></h1>
                </div>
                <nav class="ml-auto">
                    <ul class="nav">
                        <div class="dashboard">
                            <li class="nav-item mx-2"><a href="#" class="nav-link">Dashboard</a></li>
                        </div>
                        <div class="tentang-kami">
                            <li class="nav-item mx-2"><a href="tentang_kami/index.html" class="nav-link">Tentang Kami</a></li>
                        </div>
                        <div class="search">
                            <li class="nav-item mx-2"><a href="search.php" class="nav-link">Search</a></li>
                        </div>
                        <div class="search">
                            <li class="nav-item mx-2"><a href="login.php" class="nav-link">Login Admin</a></li>
                        </div>
                    </ul>
                </nav>
            </div>
        </header>

        <section class="container-fluid my-0 px-3">
            <div class="row">
                <div class="container-fluid px-0 col-md-6">
                    <?php
                    include 'db.php';

                    // Ambil data profil
                    $stmt = $pdo->query("SELECT * FROM profiles");
                    $profile = $stmt->fetch();
                    ?>
                    <h2 class="font-weight-bold"><?php echo $profile['title']; ?></h2>
                    <p><?php echo $profile['content']; ?></p>
                    <h3>Potensi Pertanian dan Perkebunan</h3>
                    <p>Desa Girimulyo memiliki lahan yang cocok untuk budidaya berbagai komoditas unggulan, yaitu:</p>
                    <ul>
                    <?php foreach ($potensiList as $potensi): ?>
                        <li><?php echo htmlspecialchars($potensi['nama']); ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div class="image-overlay"></div>
                <img src="asset/profil-desa.jpg" alt="Gambar Desa" class="background-image img-fluid rounded">
            </div>
        </section>

        <div class="commodities container-fluid my-5 px-5">
            <img src="asset/bg-komoditas.png" alt="Background" class="background-image bgComoditas">
            
            <h3 id="judul2">Beberapa Komoditas Desa:</h3>
            <div class="row text-center justify-content-center">
                <?php
                // Ambil data komoditas
                $stmt = $pdo->query("SELECT * FROM commodities");
                $commodities = $stmt->fetchAll();

                foreach ($commodities as $commodity): ?>
                    <div class="col-md-3 mb-3" style="margin-top: 70px;">
                        <div class="position-relative">
                            <img src="<?php echo $commodity['image']; ?>" alt="<?php echo $commodity['name']; ?>" class="img-fluid rounded" >
                        </div>
                        <a href="<?php echo $commodity['link']; ?>" class="btn btn-primary overlay-btn"><?php echo $commodity['name']; ?></a>
                    </div>
                <?php endforeach; ?>
            </div><br><br><br>
        </div>
        <div class="container">
            <div class="alamat-section">
                <div class="map-section">
                    <h1 class="h4 mb-0 stroked-text ml-10">ALAMAT</h1>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127116.82350003041!2d105.62382669099243!3d-5.3556621307478265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40fa74b7e221d5%3A0x817a9b8bad9cd211!2sGiri%20Mulyo%2C%20Marga%20Sekapung%2C%20East%20Lampung%20Regency%2C%20Lampung!5e0!3m2!1sen!2sid!4v1731400638124!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="alamat-text">
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                            Desa Girimulyo, Kecamatan Marga Sekampung,
                            <br/>
                            Kabupaten Lampung Timur, Lampung
                    </p>
                </div>
            </div>
            <div class="kontak-section">
                <h2>Kontak Kami</h2>
                <p><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/groups/3335658526505631/?ref=share&mibextid=NSMWBT">@Desa_Girimulyo</a></p>
                <p><i class="fab fa-youtube"></i> <a href="https://youtube.com/@gmcreatortmmediajalanan?si=clgJOhPXx8Bg_s9J">Desa_Girimulyo</a></p>
                <p><i class="fas fa-phone"></i> <a 
                        href="https://wa.me/6281998256234?text=Halo, saya tertarik dengan produk di Desa Girimulyo. Apakah bisa bertanya lebih lanjut?" 
                        target="_blank">
                        081998256234
                    </a></p>
                <p><i class="fas fa-globe"></i> <a href="http://girimulyo-lampungtimur.desa.id/">girimulyo-lampungtimur.desa.id</a></p>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
