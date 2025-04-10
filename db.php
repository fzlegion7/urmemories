<?php
$servername = "localhost";
$username = "root";  // Default username untuk XAMPP
$password = "";      // Default password kosong untuk XAMPP
$dbname = "urmemories_db";  // Nama database yang baru dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
