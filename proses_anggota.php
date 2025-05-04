<?php
// Menghubungkan file konfigurasi database
include 'config.php';

// Memulai sesi PHP
session_start();

// Mendapatkan ID pengguna dari sesi
$userId = $_SESSION["anggota_id"];

// Mendapatkan form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    // Mendapatkan data dari form
    $nama = $_POST["namaLengkap"]; // Judul postingan
    $email = $_POST["email"]; // Konten postingan
    $pass = $_POST["password"]; // ID aktivitas
    $pass = password_hash($pass, PASSWORD_DEFAULT);


    try {
        // Periksa apakah email sudah terdaftar
        $checkEmailQuery = "SELECT * FROM anggota WHERE email='$email'";
        $result = $conn->query($checkEmailQuery);
  
        if ($result->num_rows > 0) {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Email sudah terdaftar!'
            ];
            header('Location: tambah_anggota.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ];
        header('Location: tambah_anggota.php');
        exit();
    }

    // Jika unggahan berhasil, masukkan
    // data postingan ke dalam database
    $query = "INSERT INTO anggota VALUES (NULL, '$nama', '$email', '$pass')";
    if ($conn->query($query) === TRUE) {
        // Notifikasi berhasil jika postingan berhasil ditambahkan
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'books successfully added.'
        ];
    } else {
        // Notifikasi error jika gagal menambahkan postingan
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'error adding books: ' . $conn->error
        ];
   
        return;
    }

    // Arahkan ke halaman dashboard setelah selesai
    header('Location: anggota.php');
    exit();
}

// Proses penghapusan postingan
if (isset($_GET['anggota_id'])) {
    // Mengambil ID books dari paramenter URL
    $id = $_GET['anggota_id'];

    // Query untuk menghapus post berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM anggota WHERE anggota_id='$id'");

    // Menyimpan notifikasi kerberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'books successfully deleted.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting post: ' . mysqli_error($conn)
        ];
    }

    // Redirect kembali ke dalam halaman dashboard
    header('Location: anggota.php');
    exit();
}

// Menangani pembaruan data postingan
if (isset($_POST['update'])) {
    // Mendapatkan data dart form
    $id = $_POST['anggota_id'];
    $nama = $_POST["namaLengkap"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    
    // Update data postingan di database
    if($pass != ""){
        $queryUpdate = "UPDATE anggota SET namaLengkap = '$nama', email = '$email'
        password = '$pass' WHERE anggota_id = $id";
    }else{
        $queryUpdate = "UPDATE anggota SET namaLengkap = '$nama', email = '$email'
        WHERE anggota_id = $id";
    }
        
    if ($conn->query($queryUpdate) === TRUE) {
        // Notifikasi berhasil
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Postingan berhasil diperbarui.'
        ];
    } else {
        // Notifikasi gagal
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui postingan.'
        ];
    }

    // Arahkan ke halaman dashboard
    header('Location: anggota.php');
    exit();
}