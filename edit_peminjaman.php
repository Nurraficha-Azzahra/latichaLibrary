<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Memasukkan header halaman
include '.includes/header.php';

// Mengambil ID postingan yang akan diedit dari parameter URL
//../edit_post.php?post_id=
if(!isset($_GET["peminjaman_id"])){
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
$id = $_GET['peminjaman_id']; // Pastikan parameter 'post_id' ada di URL

// Query untuk mengambil data postingan berdasarkan ID
$query = "SELECT * FROM peminjaman WHERE peminjaman_id = $id";
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
                    <form method="POST" action="proses_peminjaman.php" enctype="multipart/form-data">
                        <!-- Input untuk id anggota -->
                        <input type="text" name="peminjaman_id" value="<?=$id?>" hidden>

                        <div class="mb-3">
                            <label for="books_title" class="form-tabel">ID Peminjaman</label>
                            <input type="text" class="form-control"name="" value="<?=$post["peminjaman_id"]?>" disabled required>
                        </div>

                        <div class="mb-3">
                            <label for="books_title" class="form-tabel">ID Anggota</label>
                            <input type="text" class="form-control"name="" value="<?=$post["anggota_id"]?>" disabled required>
                        </div>

                        <div class="mb-3">
                            <label for="books_title" class="form-tabel">ID Buku</label>
                            <input type="text" class="form-control"name="buku_id" value="<?=$post["buku_id"]?>" required>
                        </div>
                        <!-- Input untuk mengunggah gambar -->
                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Tanggal Peminjaman</label>
                            <input class="form-control" type="date" name="tgl_peminjaman" value="<?=$post["tgl_peminjaman"]?>"  required>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Tanggal Pengembalian</label>
                            <input class="form-control" type="date" name="tgl_kembali" value="<?=$post["tgl_kembali"]?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Tanggal DiKembalikan</label>
                            <input class="form-control" type="datetime-local" name="tgl_dikembalikan" value="<?=$post["tgl_dikembalikan"]?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Denda</label>
                            <input class="form-control" type="number" name="denda" value="<?=$post["denda"]?>">
                        </div>
                    
                        <!-- Textarea untuk konten postingan -->
                        <div class="mb-3">
                            <label for="formFile" class="form-tabel">Status</label>
                            <select class="form-control" name="status" value="<?=$post['status']?>" >
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>   
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