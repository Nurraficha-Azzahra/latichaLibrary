<?php
session_start();
include "../config.php";

// Mengambil data dari form
$id_buku = $_POST['id_buku'];
$judul_buku = $_POST['judul_buku'];
$penulis = $_POST['penulis'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_pengembalian = $_POST['tanggal_pengembalian'];
$anggota_id = $_SESSION["anggota_id"];

// Menyimpan data peminjaman ke database
$sql = "INSERT INTO peminjaman (anggota_id, buku_id, tgl_peminjaman, tgl_kembali)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss",$anggota_id, $id_buku, $tanggal_pinjam, $tanggal_pengembalian);

if ($stmt->execute()) {
    echo "Peminjaman buku berhasil!";
    header('Location: daftar_peminjaman.php');

} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>