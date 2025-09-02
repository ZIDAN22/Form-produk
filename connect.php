<?php
$host     = "localhost";    // host database
$username = "root";         // username database
$password = "";             // password database
$dbname   = "store_db"; // nama database

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
