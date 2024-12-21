<?php
include 'dbset.php';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Ambil keyword pencarian jika ada
$keyword = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Query untuk mengambil data produk berdasarkan pencarian
$query = "SELECT id, name, image, link FROM commodities WHERE name LIKE '%$keyword%'";
$result = $conn->query($query);

// Ambil hasil dalam array
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Girimulyo</title>
    <link rel="icon" href="asset/logo.png" type="x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_ts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <header class="py-3">
        <div class="container-fluid d-flex justify-content-between align-items-center px-0">
            <div class="d-flex align-items-center">
                <img src="asset/logo.png" alt="Logo Desa Girimulyo" class="mr-2" style="width: 50px;">
                <h1 id="judul" class="h4 mb-0 stroked-text ml-10"></h1>
            </div>
            <nav class="ml-auto">
                <ul class="nav">
                    <div class="dashboard">
                        <li class="nav-item mx-2"><a href="index.php" class="nav-link">Dashboard</a></li>
                    </div>
                    <div class="tentang-kami">
                        <li class="nav-item mx-2"><a href="./tentang_kami/index.html" class="nav-link">Tentang Kami</a></li>
                    </div>
                    <div class="search">
                        <li class="nav-item mx-2"><a href="#" class="nav-link">Search</a></li>
                    </div>
                </ul>
            </nav>
        </div>
    </header>

    <div class="main-content" id="main-content">
        <div class="container-fluid my-0 px-2 mx-0" id="second-content">
            <div class="search-container position-relative">
                <input type="text" placeholder="Hasil pencarian berdasarkan..." id="search-input" value="<?php echo htmlspecialchars($keyword); ?>">
                <i class="fas fa-search search-icon"></i>
                <a href="index.php"><i class="fas fa-times close-btn"></i></a>

                <div class="row justify-content-center">
                    <?php if (!empty($products)) { ?>
                        <?php foreach ($products as $product) { ?>
                            <div class="col-12 col-md-4 product-card" data-product="<?php echo $product['name']; ?>">  
                                <div class="product-image">
                                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                                </div>
                                <button onclick="window.location.href='<?php echo $product['link']; ?>'">
                                    <?php echo $product['name']; ?>
                                </button>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="popup-error" id="popup-error">
                            <div class="popup-content">
                                <span class="close-popup" id="close-popup">&times;</span>
                                <div class="error-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <p class="key_error">Kata Kunci yang anda</p>
                                <p class="key_error">masukkan tidak ditemukan</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
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

    <script src="script_ts.js"></script>
    <script src="js/script_ts.js"></script>

    <script>
        // Fungsi pencarian
        document.getElementById('search-input').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                const keyword = event.target.value;
                window.location.href = `search.php?search=${encodeURIComponent(keyword)}`;
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const noResults = <?php echo empty($products) ? 'true' : 'false'; ?>;
            const popup = document.getElementById('popup-error');
            const closePopup = document.getElementById('close-popup');

            if (noResults) {
                popup.style.display = 'flex';
            }

            closePopup.addEventListener('click', function () {
                popup.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });

            function displayProducts(filteredProducts, page = 1) {
                productContainer.innerHTML = ''; // Hapus produk lama
                const start = (page - 1) * itemsPerPage; // Hitung index awal
                const paginatedProducts = filteredProducts.slice(start, start + itemsPerPage); // Potong array produk
            
                paginatedProducts.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.className = 'col-md-4 product-card';
                    productCard.setAttribute('data-product', product.name);
                    productCard.innerHTML = `
                        <div class="product-image">
                            <img src="${product.image}" alt="${product.name}">
                        </div>
                        <button onclick="window.location.href='${product.url}'">${product.name}</button>
                    `;
                    productContainer.appendChild(productCard);
                });
            
                // Update pagination setelah memuat produk
                updatePagination(filteredProducts.length, page);
            }
        });

    </script>
</body>
</html>