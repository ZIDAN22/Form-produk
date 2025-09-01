<?php
// Cek apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan
    $name = htmlspecialchars(trim($_POST['nama']));
    $harga = htmlspecialchars(trim($_POST['harga']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));

    // Validasi sederhana
    if (empty($name) || empty($harga) || empty($deskripsi)) {
        echo "semua field harus diisi.";
        exit;
    }

    // Tampilkan data yang diterima
    echo "<h1>Form Data Received</h1>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Harga:</strong> $harga</p>";
    echo "<p><strong>Deskripsi:</strong><br>" . nl2br($deskripsi) . "</p>";
} else {
    echo "No data received.";
}
?>
