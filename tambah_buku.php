<?php
// Menyertakan keader halaman
include '.includes/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="card mb-4">
        <div class="card-body">
        <h2 class="card-title text-primary">Tambah Data Buku</h2>
        <br>
            <form method="POST" action="proses_books.php" enctype="multipart/form-data">
                <!-- Input untuk judul postingan -->
                <div class="mb-3">
                    <label for="books_title" class="form-tabel">Judul Buku</label>
                    <input type="text" class="form-control"name="judulBuku" placeholder="Masukkan judul buku" required>
                </div>
                <!-- Input untuk mengunggah gambar -->
                <div class="mb-3">
                    <label for="formFile" class="form-tabel">Penulis</label>
                    <input class="form-control" type="text" name="penulis" placeholder="Masukkan nama penulis" required>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-tabel">Sampul Buku</label>
                    <input class="form-control" type="file" name="sampul" placeholder="Upload gambar sampul buku" accept="image/*" required>
                </div>
            
                <!-- Textarea untuk konten postingan -->
                <div class="mb-3">
                    <label for="formFile" class="form-tabel">Tahun Publikasi</label>
                    <input class="form-control" type="number" id="tahun_publikasi" name="tahun_publikasi"  placeholder="Masukkan tahun terbit" required></textarea>
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