<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Memasukkan header halaman
include '.includes/header.php';

// Mengambil ID postingan yang akan diedit dari parameter URL
//../edit_post.php?post_id=
if(!isset($_GET["anggota_id"])){
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
$id = $_GET['anggota_id']; // Pastikan parameter 'post_id' ada di URL

// Query untuk mengambil data postingan berdasarkan ID
$query = "SELECT * FROM anggota WHERE anggota_id = $id";
$result = $conn->query($query);

// Memeriksa apakah data postingan ditemukan
if ($result->num_rows > 0) {
    $post = $result->fetch_assoc(); // Mengambil data postingan ke dalam array
} else {
    // Menampilkan pesan jika postingan tidak ditemukan
    echo "Post not found.";
    exit(); // Menghentikan eksekusi jika tidak ada postingan
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
                    <form method="POST" action="proses_anggota.php" enctype="multipart/form-data">
                        <!-- Input untuk id anggota -->
                        <input type="text" name="anggota_id" value="<?=$id?>" hidden>

                        <div class="mb-3">
                            <label for="books_title" class="form-tabel">Nama Anggota</label>
                            <input type="text" class="form-control"name="namaLengkap" value="<?=$post["namaLengkap"]?>" required>
                        </div>
                        <!-- Input untuk mengunggah gambar -->
                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Email</label>
                            <input class="form-control" type="text" name="email" value="<?=$post["email"]?>">
                        </div>
                    
                        <!-- Textarea untuk konten postingan -->
                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Password</label>
                            <input class="form-control" type="number" id="tahun_publikasi" name="password" value="" placeholder="Isi untuk mengubah password" ></textarea>
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