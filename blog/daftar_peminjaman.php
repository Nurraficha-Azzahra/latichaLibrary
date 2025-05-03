<?php

include ".includes/session.php";
include "../config.php";
date_default_timezone_set('Asia/Jakarta');


// Menyaring dan mengambil data buku berdasarkan id_buku (misalnya dari URL)
$id_anggota = isset($_SESSION['anggota_id']) ? $_SESSION['anggota_id'] : 1; // Ganti dengan ID buku yang sesuai

$sql = "SELECT * FROM peminjaman 
INNER JOIN buku ON peminjaman.buku_id = buku.id_buku
WHERE anggota_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_anggota);
$stmt->execute();
$result = $stmt->get_result();


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
<body>

<?php
include "navbar.php"
?>

<!-- CONTENT -->
  <div  style="margin : 10rem 5rem;">
    <h2 style="color : #696cff; font-weight : bold;">Daftar Buku yang Dipinjam</h2>
    <p>Harap kembalikan buku tepat waktu, pengembalian yang melewati batas waktu akan dikenakan denda sebesar 5000 perhari</p>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle" style="width : 100%;">
        <thead class="table-primary text-center">
          <tr>
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Pengembalian</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $data): ?>
            <tr>
              <td><?= htmlspecialchars($data['peminjaman_id']) ?></td>
              <td><?= htmlspecialchars($data['judul_buku']) ?></td>
              <td><?= htmlspecialchars($data['penulis']) ?></td>
              <td><?= htmlspecialchars($data['tgl_peminjaman']) ?></td>
              <td><?= htmlspecialchars($data['tgl_kembali']) ?></td>
              <td style="display : flex; align-items : center; justify-content : center;">
               <?php
               if($data['status'] == "dipinjam"){
                ?>
                <a href="pengembalian.php?id_peminjaman=<?=$data['peminjaman_id']?>&tanggal=<?=$data['tgl_kembali']?>">
                  <button>Kembalikan</button>
                </a>
                <?php
                }
                else {
                  ?>
                    <button style="background-color : grey" disabled>Dikembalikan</button>
                  <?php
                }?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>


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