<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatichaLibrary - Sistem Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: white;
            text-align: center;
            padding: 50px 20px;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .feature-box {
            background: #4b6cb7;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 30%;
            font-size: 1.2em;
        }
        .feature-box i {
            font-size: 2em;
        }
        .cta {
            margin-top: 30px;
        }
        .btn {
            background: #182848;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2em;
        }
        .btn:hover {
            background: #4b6cb7;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background: #182848;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Selamat Datang di LatichaLibrary</h1>
    <p>Sistem Peminjaman dan Pengembalian Buku Online</p>
</header>

<div class="container">
    <h2>Tentang LatichaLibrary</h2>
    <p>LatichaLibrary adalah platform digital yang dirancang untuk memudahkan proses peminjaman dan pengembalian buku secara online. Dengan sistem ini, pengguna dapat dengan mudah mengakses informasi mengenai buku yang tersedia, melakukan peminjaman, dan mengembalikan buku tanpa harus datang ke perpustakaan.</p>

    <div class="features">
        <div class="feature-box">
            📚 <br> Peminjaman Buku Mudah
        </div>
        <div class="feature-box">
            🔄 <br> Pengembalian Cepat
        </div>
        <div class="feature-box">
            📖 <br> Tanpa Antrian
        </div>
    </div>

    <div class="cta">
        <a href="Location: ./auth/login.php;" class="btn">Mulai Sekarang</a>
    </div>
</div>

<div class="footer">
    <p>&copy; 2025 LatichaLibrary | Sistem Peminjaman Buku Online</p>
</div>

</body>
</html>