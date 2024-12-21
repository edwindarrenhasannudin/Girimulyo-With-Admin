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


// Array berisi daftar gambar yang akan ditampilkan
const images = [
    "asset/FOTO BERJALAN-1.jpg",
    "asset/FOTO BERJALAN-2.jpg",
    "asset/FOTO BERJALAN-3.jpg",
    "asset/FOTO BERJALAN-4.jpg",
    "asset/FOTO BERJALAN-5.jpg",
    "asset/FOTO BERJALAN-6.jpg",
    "asset/FOTO BERJALAN-7.jpg",
    "asset/FOTO BERJALAN-8.jpg",
    "asset/FOTO BERJALAN-9.jpg",
    "asset/FOTO BERJALAN-10.jpg",
    "asset/FOTO BERJALAN-11.jpg",
    "asset/FOTO BERJALAN-12.jpg",
    "asset/FOTO BERJALAN-13.jpg",
    "asset/FOTO BERJALAN-14.jpg",
    "asset/FOTO BERJALAN-15.jpg",
    "asset/FOTO BERJALAN-16.jpg",
    "asset/FOTO BERJALAN-17.jpg",
    "asset/FOTO BERJALAN-18.jpg"
];

// Mendapatkan elemen gambar dari HTML
const profileImage = document.querySelector(".background-image");

// Indeks untuk melacak gambar saat ini
let currentIndex = 0;

// Fungsi untuk mengubah gambar
function changeImage() {
    currentIndex = (currentIndex + 1) % images.length; // Memperbarui indeks ke gambar berikutnya
    profileImage.src = images[currentIndex]; // Mengubah src gambar
}

// Interval untuk mengganti gambar setiap 5 detik
setInterval(changeImage, 2000); 

