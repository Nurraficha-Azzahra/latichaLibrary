<?php
session_start();
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"]  ;

    $sql = "SELECT * FROM anggota WHERE email='$email'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row["password"])) {
  
          $_SESSION["email"] = $email;
          $_SESSION["namaLengkap"] = $row["namaLengkap"];
          // $_SESSION["role"] = $row["role"];
          $_SESSION["anggota_id"] = $row["anggota_id"];
          // Set notifikasi selamat datang
          $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Selamat Datang Kembali di LatichaLibrary!'
          ];
          // Redirect ke dashboard
          header('Location: ../dashboard.php');
          exit ();
        } else {
          $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'email atau Password salah'
          ];
        }
      } else {
        // email tidak ditemukan
          $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'email atau Password salah'
          ];
        }
        // Redirect kembali ke halaman login jika gagal
        header('Location: login.php');
        exit();
    }
    $conn->close();
    ?>