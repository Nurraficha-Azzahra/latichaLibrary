<?php
// Menghubungkan file konfigurasi database
include 'config.php';

// Memulai sesi PHP
session_start();

// Mendapatkan ID pengguna dari sesi
$userId = $_SESSION["anggota_id"];

// Mendapatkan form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    $judulBuku = $_POST["judulBuku"];
    $penulis = $_POST["penulis"];
    $tahun_publikasi = $_POST["tahun_publikasi"];
    $uploadOk = 1;
    $targetDir = "uploads/";

    // Ekstensi file
    $fileName = $_FILES["sampul"]["name"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Nama file baru dengan timestamp
    $newFileName = date("Ymd_His") . '.' . $fileExtension;
    $targetFile = $targetDir . $newFileName;

    // Upload file
    if (move_uploaded_file($_FILES["sampul"]["tmp_name"], $targetFile)) {
        // Masukkan ke database, sertakan nama file
        $query = "INSERT INTO buku (judul_buku, penulis, tahun_publikasi, sampul)
                  VALUES ('$judulBuku', '$penulis', '$tahun_publikasi', '$newFileName')";
        if ($conn->query($query) === TRUE) {
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Books successfully added.'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Database error: ' . $conn->error
            ];
        }

    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Failed to upload file.'
        ];
    }

    header('Location: buku.php');
    exit();
}


// Proses penghapusan postingan
if (isset($_GET['id_buku'])) {
    $booksID = $_GET['id_buku'];

    // Ambil nama file terlebih dahulu
    $result = mysqli_query($conn, "SELECT sampul FROM buku WHERE id_buku='$booksID'");
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $filename = $row['sampul'];
        $filepath = 'uploads/' . $filename;

        // Hapus file jika ada
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

    // Hapus data dari DB
    $exec = mysqli_query($conn, "DELETE FROM buku WHERE id_buku='$booksID'");
    $_SESSION['notification'] = [
        'type' => $exec ? 'primary' : 'danger',
        'message' => $exec ? 'Books successfully deleted.' : 'Error deleting post: ' . mysqli_error($conn)
    ];

    header('Location: buku.php');
    exit();
}


// Menangani pembaruan data postingan
if (isset($_POST['update'])) {
    $id = $_POST['id_buku'];
    $judul = $_POST["judul_buku"];
    $penulis = $_POST["penulis"];
    $tahun_publikasi = $_POST["tahun_publikasi"];

    $updateQuery = "UPDATE buku SET judul_buku = '$judul', penulis = '$penulis', tahun_publikasi = '$tahun_publikasi'";

    // Jika ada file baru
    if (!empty($_FILES["sampul"]["name"])) {
        // Ambil file lama
        $res = mysqli_query($conn, "SELECT sampul FROM buku WHERE id_buku='$id'");
        $old = mysqli_fetch_assoc($res);
        if ($old && file_exists('uploads/' . $old['sampul'])) {
            unlink('uploads/' . $old['sampul']);
        }

        // Simpan file baru
        $fileExtension = strtolower(pathinfo($_FILES["sampul"]["name"], PATHINFO_EXTENSION));
        $newFileName = date("Ymd_His") . '.' . $fileExtension;
        $targetFile = "uploads/" . $newFileName;

        if (move_uploaded_file($_FILES["sampul"]["tmp_name"], $targetFile)) {
            $updateQuery .= ", sampul = '$newFileName'";
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'File upload failed.'
            ];
            header('Location: buku.php');
            exit();
        }
    }

    $updateQuery .= " WHERE id_buku = $id";

    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Postingan berhasil diperbarui.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui postingan.'
        ];
    }

    header('Location: buku.php');
    exit();
}