<?php
// index.php


include "../config.php";

$data = [];
$key = $_GET["key"]??"";
$page = max($_GET['page']??1, 1);
$query = "SELECT * FROM buku WHERE LOWER(judul_buku) LIKE LOWER(?) LIMIT 10 OFFSET ". ( ($page-1) * 10) . ";";
$count = "SELECT COUNT(id_buku) AS count from buku;";

$count = mysqli_query($conn, $count);
$count = mysqli_fetch_assoc($count);
$stmt = $conn->prepare($query);

// Menambahkan parameter untuk query
$key = "%" . $key . "%";
$stmt->bind_param("s", $key);

// Menjalankan query
$stmt->execute();

// Mendapatkan hasil
$result = $stmt->get_result();


$data = $result;


?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LatichaLibrary - Peminjaman Buku Online</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
      text-align: center;
    }

    .book-list{
      display : flex;
      width : 75%;
      gap : 1rem;
      margin : 4rem 0;
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
        width: 20%;
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

    .pagination{
      width : 75%;
      justify-content : start;
      align-items : center;
      gap : 1rem;
      padding : 1rem;
      margin-bottom : 5rem;

    }

    .pagination button{
      border-color : #696cff;
      color : #696cff;
      background-color : white;
      border-radius: .2rem;
      font-weight : bold;
      padding : .5rem 2rem;
    }

    .pagination span{
      color : #696cff;
      font-weight : bold; 
      font-size : 1.2rem;
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

<!-- HERO SECTION -->
<section class="hero" style="padding-top : 10rem;">
  <h1 style="color : #696cff; font-weight : bold;">Selamat Datang di LatichaLibrary</h1>
  <p>Pinjam mudah, baca puas, kembali tepat!</p>

  <h3 style="color : #696cff; margin-top : 1rem;"> Cari buku :  </h3>
  <form action="search.php" method="GET" style="width : 15%;">
    <input class="form-control" type="text" name="key" placeholder="Tekan enter untuk mencari " value="<?=$_GET["key"]??""?>">
  </form>

  <div class="book-list">
    <?php

    foreach( $data as $row){

      ?>
      <div class="card">
          <img src="../uploads/<?= $row['sampul'] ?>" alt="Sampul Buku" style="object-fit: cover; height: 20vh;">
          <h3 style="color  : #696cff; font-weight : bold; font-size : 1.5rem;" ><?= htmlspecialchars($row['judul_buku']) ?></h3>
          <p style="font-size : 1rem;" >Penulis: <?= htmlspecialchars($row['penulis']) ?></p>
          <a href="pinjam.php?id_buku=<?= $row['id_buku'] ?>" class="btn">Pinjam</a>
      </div>

      <?php
    }
    ?>
  <div>

  
</section>
<center>
  <div class="pagination">
    <a href="search.php?page=<?=max(0, ($_GET['page']??0) -1)?>">
      <button>Prev</button>
    </a>
    <a href="search.php?page=<?=($_GET['page']??0) +1?>">
      <button>Next</button>
    </a>
    <span> Halaman : <?=$_GET["page"]??1?> </span>
  </div>
</center>

<section>


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