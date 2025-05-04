<?php

include ".includes/session.php";
include "../config.php";
date_default_timezone_set('Asia/Jakarta');


// Menyaring dan mengambil data buku berdasarkan id_buku (misalnya dari URL)
$id_buku = isset($_GET['id_buku']) ? $_GET['id_buku'] : 1; // Ganti dengan ID buku yang sesuai

$sql = "SELECT * FROM buku WHERE id_buku = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();

// Mengambil data buku
$buku = $result->fetch_assoc();

// Menutup koneksi
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LatichaLibrary - Peminjaman Buku Online</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/peminjaman.css">
  <!-- Custom CSS -->
  <style>
    /* Navbar */
    .navbar {
      background: rgba(70, 105, 187, 0.85);
    }
    .navbar-brand {
      font-size: 1.8rem;
      font-weight: bold;
    }
    /* Hero Section */
    .hero {
      background: url('assets/library-bg.jpg') no-repeat center center/cover;
      min-height: 95vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #rgba;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
      padding: 0 20px;
    }
    .hero h1 {
      font-size: 3rem;
    }
    .hero p {
      font-size: 1.3rem;
      margin-top: 20px;
    }
    .hero .btn {
      margin-top: 30px;
      padding: 10px 30px;
      font-size: 1.2rem;
      border-radius: 50px;
      background-color:rgb(229, 161, 165);
      color: #000;
      border: none;
    }
    .hero .btn:hover {
      background-color:rgb(185, 70, 97);
      color: #000;
    }
    /* Content Sections */
    .content-section {
      padding: 60px 20px;
      background-color: #fff;
    }
    .content-section h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }
    .content-section p {
      font-size: 1.2rem;
    }
    /* Features Section */
    .features .feature-box {
      background: #4b6cb7;
      color: #fff;
      padding: 30px 20px;
      border-radius: 10px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.15);
      transition: transform 0.3s;
    }
    .features .feature-box:hover {
      transform: translateY(-5px);
    }
    .features .feature-box img {
      width: 64px;
      height: 64px;
    }
    .features .feature-box h4 {
      margin-top: 15px;
      font-size: 1.5rem;
    }
    /* Footer */
    .footer {
      background-color : #696cff;
      color: #fff;
      padding: 20px;
      position : fixed ; 
      width : 100%;
      bottom : 0;
      text-align: center;
    }

    .book-list{
      display : flex;
      gap : 1rem;
      margin : 2rem 0;
    }
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 200px;
        overflow: hidden;
        text-align: center;
        padding: 10px;
    }

    .card img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .card h3 {
        font-size: 18px;
        margin: 10px 0;
    }

    .card p {
        font-size: 14px;
        color: #555;
    }

    .card .btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 10px;
    }

    .card .btn:hover {
        background-color: #0056b3;
    }


    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }
      .hero p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body style="min-height : 95vh;">

<?php
include "navbar.php"
?>


<section >
    <h2>Form Peminjaman Buku</h2>

    <form action="proses_peminjaman.php" method="POST">
        <table>
            <tr>
                <td style="width: 30%"><label for="id_buku">ID Buku:</label></td>
                <td><input type="text" id="id_buku" name="id_buku" value="<?= $buku['id_buku'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="judul_buku">Judul Buku:</label></td>
                <td><input type="text" id="judul_buku" name="judul_buku" value="<?= $buku['judul_buku'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="penulis">Penulis:</label></td>
                <td><input type="text" id="penulis" name="penulis" value="<?= $buku['penulis'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="tanggal_pinjam">Tanggal Pinjam:</label></td>
                <td><input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="tanggal_kembali">Tanggal Kembali:</label></td>
                <td><input type="date" id="tanggal_kembali" name="tanggal_pengembalian" required></td>
            </tr>
            <tr>
                <td></td>
                <td class="btn-row"><button type="submit" style="      background-color : #696cff;
 font-weight : bold; color : white;">Pinjam Buku</button></td>
            </tr>
        </table>
    </form>
</section>


<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <p>&copy; 2025 TIM LATICHA RPL SMKN 4 Tanjungpinang</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>