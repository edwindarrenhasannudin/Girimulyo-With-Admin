const text = "DESA GIRIMULYO"; // Teks yang ingin ditampilkan
const judulElement = document.getElementById("judul");
let index = 0;
function type() {
    if (index < text.length) {
        judulElement.innerHTML += text.charAt(index); // Tambahkan karakter satu per satu
        index++;
        setTimeout(type, 100); // Ulangi setiap 100 ms
    } else {
        // Setelah semua karakter ditampilkan, tunggu sebentar dan hapus
        setTimeout(() => {
            erase(); // Panggil fungsi erase setelah 1 detik
        }, 1000);
    }
}

function erase() {
    if (index > 0) {
        judulElement.innerHTML = text.substring(0, index - 1); // Hapus karakter satu per satu
        index--;
        setTimeout(erase, 100); // Ulangi setiap 100 ms
    } else {
        // Setelah semua karakter dihapus, mulai lagi mengetik
        setTimeout(() => {
            index = 0; // Reset index
            type(); // Mulai mengetik lagi
        }, 500); // Tunggu sebentar sebelum mulai mengetik lagi
    }
}
// Mulai efek mengetik saat halaman dimuat
window.onload = type;

// BAGIAN FOTO BERGERAK
const images = [
    'Asset/Foto Kantor Desa Girimulyo.jpg', 
    'Asset/FOTO BERJALAN (1).jpg', 
    'Asset/FOTO BERJALAN (2).jpg',
    'Asset/FOTO BERJALAN (3).jpg',
    'Asset/FOTO BERJALAN (4).jpg',
    'Asset/FOTO BERJALAN (5).jpg',
    'Asset/FOTO BERJALAN (6).jpg',
    'Asset/FOTO BERJALAN (7).jpg',
    'Asset/FOTO BERJALAN (8).jpg',
    'Asset/FOTO BERJALAN (9).jpg',
    'Asset/FOTO BERJALAN (10).jpg',
    'Asset/FOTO BERJALAN (11).jpg',
    'Asset/FOTO BERJALAN (12).jpg',
    'Asset/FOTO BERJALAN (13).jpg',
    'Asset/FOTO BERJALAN (14).jpg',
    'Asset/FOTO BERJALAN (15).jpg',
    'Asset/FOTO BERJALAN (16).jpg',
    'Asset/FOTO BERJALAN (17).jpg',
    'Asset/FOTO BERJALAN (18).jpg',
];

let currentIndex = 0;

function changeBackgroundImage() {
    const mainContent = document.getElementById('main-content');
    mainContent.style.backgroundImage = `url('${images[currentIndex]}')`;
    currentIndex = (currentIndex + 1) % images.length; // Mengubah index untuk gambar selanjutnya
}

// Set gambar pertama saat halaman dimuat
changeBackgroundImage();
// Ganti gambar setiap 3 detik (3000 ms)
setInterval(changeBackgroundImage, 3000);

// BAGIAN PENCARIAN SEARCH PRODUK
// Definisi produk dan konfigurasi per halaman
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector('.search-container input');
    const productContainer = document.querySelector('.row');
    const popupError = document.getElementById('popup-error');
    const closePopup = document.getElementById('close-popup');
    
    const itemsPerPage = 6;

    const allProducts = [
        { name: 'Alpukat', image: 'Asset/ALPUKAT.jpg', url: '../produk/alpukat.html'},
        { name: 'Jagung', image: 'Asset/JAGUNG.jpg', url: '../produk/jagung.html' },
        { name: 'Kelapa', image: 'Asset/KELAPA.jpg', url: '../produk/kelapa.html' },
        { name: 'Labu', image: 'Asset/LABU.jpg', url: '../produk/labu.html' },
        { name: 'Coklat', image: 'Asset/COKLAT.jpg', url: '../produk/cokelat.html' },
        { name: 'Singkong', image: 'Asset/SINGKONG.jpg', url: '../produk/singkong.html' },
        { name: 'Pisang', image: 'Asset/PISANG.jpg', url: '../produk/pisang.html' },
        { name: 'Durian', image: 'Asset/DURIAN.jpg', url: '../produk/durian.html' }
    ];

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

    
    // Pencarian produk berdasarkan input pengguna
    searchInput.addEventListener('keydown', function(event) {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredProducts = allProducts.filter(product =>
            product.name.toLowerCase().includes(searchTerm)
        );
    
        if (event.key === 'Enter') {
            if (filteredProducts.length > 0) {
                displayProducts(filteredProducts, 1); // Tampilkan produk hasil pencarian
                popupError.style.display = 'none'; // Sembunyikan popup error
            } else {
                popupError.style.display = 'flex'; // Tampilkan popup error
                paginationContainer.style.display = 'none'; // Sembunyikan pagination
            }
        } else {
            displayProducts(allProducts, 1); // Tampilkan semua produk jika input kosong
            popupError.style.display = 'none'; // Sembunyikan popup error
        }
    });
    
    // Menutup popup error
    closePopup.addEventListener('click', function() {
        popupError.style.display = 'none'; // Sembunyikan popup error
    });
    
    // Muat semua produk saat halaman dimuat
    displayProducts(allProducts, 1)}
)


document.querySelector('.close-btn').addEventListener('click', function() {
    window.location.href = '../index.html'; // Ganti 'dashboard.html' dengan URL halaman dashboard Anda
});

