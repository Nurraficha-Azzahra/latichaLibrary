<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Memasukkan header halaman
include '.includes/header.php';

// Mengambil ID postingan yang akan diedit dari parameter URL
//../edit_post.php?post_id=
if(!isset($_GET["id_buku"])){
    echo "
    <div style='margin : 2rem 3rem'>
        <h3>Buku tidak ditemukan </h3>
        <a href='buku.php'>
            <button class='btn btn-primary'>Kembali ke buku</button>
        </a>
    </div>
    ";
    return;
    exit();
}
$id = $_GET['id_buku']; // Pastikan parameter 'post_id' ada di URL

// Query untuk mengambil data postingan berdasarkan ID
$query = "SELECT * FROM buku WHERE id_buku = $id";
$result = $conn->query($query);

// Memeriksa apakah data postingan ditemukan
if ($result->num_rows > 0) {
    $post = $result->fetch_assoc(); // Mengambil data postingan ke dalam array
} else {
    // Menampilkan pesan jika postingan tidak ditemukan
    echo "Post not found.";
    exit(); // Menghentikan eksekust jika tidak ada postingas
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
     <div class="row">
        <!--. Form untuk mengedit postingan -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Formulir menggunakan metode POST untuk mengirim data -->
                    <form method="POST" action="proses_books.php" enctype="multipart/form-data">
                        <!-- Input untuk judul postingan -->
                        <input type="text" name="id_buku" value="<?=$id?>" hidden>

                        <div class="mb-3">
                            <label for="books_title" class="form-tabel">Judul Buku</label>
                            <input type="text" class="form-control"name="judul_buku" value="<?=$post["judul_buku"]?>" required>
                        </div>
                        <!-- Input untuk mengunggah gambar -->
                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Penulis</label>
                            <input class="form-control" type="text" name="penulis" value="<?=$post["penulis"]?>">
                        </div>


                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Sampul Buku</label>
                            <input class="form-control" type="file" name="sampul" placeholder="Upload gambar sampul buku" accept="image/*" required>
                        </div>
                    
                        <!-- Textarea untuk konten postingan -->
                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Tahun Publikasi</label>
                            <input class="form-control" type="number" id="tahun_publikasi" name="tahun_publikasi" value="<?=$post["tahun_publikasi"]?>" required></textarea>
                        </div>
                        <!-- Tombol submit -->
                        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
// Memasukkan footer halaman
include '.includes/footer.php';
?>