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
if (isset($_GET['peminjaman_id'])) {
    // Mengambil ID books dari paramenter URL
    $id = $_GET['peminjaman_id'];

    // Query untuk menghapus post berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM peminjaman WHERE peminjaman_id='$id'");

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
    header('Location: peminjaman.php');
    exit();
}

// Menangani pembaruan data postingan
if (isset($_POST['update'])) {
    // Mendapatkan data dart form
    $id = $_POST['peminjaman_id'];
    $buku_id = $_POST["buku_id"];
    $tgl_peminjaman = $_POST["tgl_peminjaman"];
    $tgl_kembali = $_POST["tgl_kembali"];
    $tgl_dikembalikan = $_POST["tgl_dikembalikan"];
    $denda = $_POST["denda"];
    $status = $_POST["status"];

    

    $queryUpdate = "UPDATE peminjaman SET buku_id = '$buku_id', tgl_peminjaman = '$tgl_peminjaman', tgl_kembali = '$tgl_kembali', tgl_dikembalikan = '$tgl_dikembalikan', denda = '$denda', status = '$status'
    WHERE peminjaman_id = $id";
    
        
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
    header('Location: peminjaman.php');
    exit();
}