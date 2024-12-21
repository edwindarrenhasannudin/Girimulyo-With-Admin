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


document.querySelector('.back-button').addEventListener('click', function() {
    window.history.back(); // Pindah ke halaman sebelumnya
});
