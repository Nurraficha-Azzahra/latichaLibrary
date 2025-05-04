<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body style="font-family : Arial, serif;">
<script src="../assets/js/sweetalert2.all.min.js
"></script>
<link href="../assets/js/sweetalert2.min.css
" rel="stylesheet">


<?php
// proses_pengembalian.php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id_peminjaman"])) {
  $id_peminjaman = $_GET['id_peminjaman']??"";
  $tanggal_kembali = $_GET['tanggal_kembali']??"";

  include '../config.php';

  // Ambil data peminjaman (termasuk tanggal batas pengembalian)
  $query = "SELECT * FROM peminjaman WHERE peminjaman_id = $id_peminjaman";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    $tanggal_batas_kembali = $row['tgl_kembali']; // tanggal_kembali di sini adalah batas akhir
    $status = 'dikembalikan';

    // Hitung selisih hari
    $tgl_kembali = new DateTime();
    $tgl_batas = new DateTime($tanggal_batas_kembali);
    $selisih = $tgl_kembali->diff($tgl_batas)->days;

    // Cek apakah terlambat
    $terlambat = ($tgl_kembali > $tgl_batas) ? $selisih : 0;
    $denda = $terlambat * 5000;
    $kembali = $tgl_kembali->format('Y-m-d H:i:s');
    // Simpan pengembalian
    $update = "UPDATE peminjaman 
               SET tgl_dikembalikan = '$kembali', denda = $denda , status = '$status'
               WHERE peminjaman_id = $id_peminjaman";

    if (mysqli_query($conn, $update)) {
      echo "<script>
            async function confirm(){
              let confirm = await Swal.fire({
                title: 'Berhasil mengembalikan buku !',
                text: 'Buku berhasil dikembalikan. Keterlambatan: ".$terlambat." hari. Denda: Rp " . number_format($denda, 0, ',', '.') . "',
                icon: 'info'
              });

                window.location='daftar_peminjaman.php';

             }

             confirm();

              
              //alert('Buku berhasil dikembalikan. Keterlambatan: $terlambat hari. Denda: Rp ` . number_format($denda, 0, ',', '.') . `');
            </script>";
    } else {
      echo "<script>alert('Gagal mengupdate data.'); history.back();</script>";
    }
  } else {
    echo "<script>alert('Data peminjaman tidak ditemukan.'); history.back();</script>";
  }

  mysqli_close($conn);
}
?>

</body>
</html>