<?php

// Konfigurasi koneksi database
$host = "localhost"; // Nama host server databse
$email = "root"; // Email untuk akses database
$password = ""; // Password untuk akses database
$database = "latichalibrary"; // Nama database yang digunakan

// Membuat koneksi ke databse menggunakan MYSQL i
$conn = mysqli_connect($host, $email, $password, $database);

// Mengecek apakah koneksi berhasil
If ($conn->connect_error) {
    // Menampilkan pesan error jika koneksi gagal
    die("Database gagal terkoneksi: " . $conn->connect_eror);
}

// Jika koneksi berhasil, script akan terus berjalan tanpa pesan eror
?>