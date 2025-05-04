<?php
// Menyertakan keader halaman
include '.includes/header.php';
include '.includes/toast_notification.php';

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="card mb-4">
        <div class="card-body">
        <h2 class="card-title text-primary">Tambah Data Anggota</h2>
        <br>
            <form method="POST" action="proses_anggota.php" enctype="multipart/form-data">
                <!-- Input untuk judul postingan -->
                <div class="mb-3">
                    <label for="books_title" class="form-tabel">Nama Lengkap</label>
                    <input type="text" class="form-control"name="namaLengkap" required>
                </div>
                <!-- Input untuk mengunggah gambar -->
                <div class="mb-3">
                    <label for="formFile" class="form-tabel">Email</label>
                    <input class="form-control" type="text" name="email" accept="image/*">
                </div>
            
                <!-- Textarea untuk konten postingan -->
                <div class="mb-3">
                    <label for="formFile" class="form-tabel">Password</label>
                    <input class="form-control" type="number" id="tahun_publikasi" name="password" required></textarea>
                </div>
                <!-- Tombol submit -->
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
       
</div>
<?php
// Menyertakan footer halaman
include '.includes/footer.php';
?>