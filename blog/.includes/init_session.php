<?php
session_start();

$namaLengkap = $_SESSION["namaLengkap"]??"";
$role = $_SESSION["role"]??"";
// Ambil notifikasi jika ada, kemudian hapus dari sesi
$notification = $_SESSION['notification'] ?? null;
if ($notification) {
  unset($_SESSION['notification']);
}

/* Periksa apakah sesi email dan role sudah ada,
jika tidak arahkan ke halaman login */
if (empty($_SESSION["email"]) ) {
  $_SESSION['notification'] = [
    'type' => 'danger',
    'message' => 'Silakan Login Terlebih Dahulu!'
  ];
  header('Location: ./auth/login.php');
  exit(); // Pastikan scribe berhenti setelah pengalihan
}