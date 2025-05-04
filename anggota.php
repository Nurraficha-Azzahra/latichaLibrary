<?php
// Menyertakan keader halaman
include 'config.php';
include '.includes/header.php';

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
     <div class="card">
        <!-- Form untuk menambahkan postingan baru -->
            <div class="card-body" >
            <h2 class="card-title text-primary">Daftar Anggota</h2>
            <br>
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>ID Anggota</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th with="150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- Menampilkan data dari tabel database -->
                        <?php
                            $index = 1; // Variabel untuk nomor urut
                            /* Query untuk mengambil data dari tabel buku, anggota, dan peminjaman */
                            $query = "SELECT*FROM anggota";
                            // Eksekusi query
                            $exec = mysqli_query($conn, $query);

                            // Perulangan untuk menampilkan setiap baris query
                            while ($row = mysqli_fetch_assoc($exec)) :
                        ?>
                            <tr>
                                <td><?= $row['anggota_id']; ?></td>
                                <td><?= $row['namaLengkap']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <!-- Tombol dropdown untuk Pilihan -->
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <!-- Menu dropdown -->
                                        <div class="dropdown-menu">
                                            <!-- Pilihan Edit -->
                                            <a href="edit_anggota.php?anggota_id=<?= $row['anggota_id']; ?>" class="dropdown-item">
                                                <i class="bx bx-edit-alt me-2"></i> Edit
                                            </a>
                                            <!-- Pilihan Delete -->
                                            <a href="proses_anggota.php?anggota_id=<?= $row['anggota_id'];?>" class="dropdown-item" >
                                                <i class="bx bx-trash me-2"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal untuk Hapus Konten Blog -->
                            <div class="modal fade" id="deletebooks_<?= $books['id_books']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus books?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="proses_books.php" method="books">
                                                <div>
                                                    <p>Tindakan ini tidak bisa dibatalkan.</p>
                                                    <input type="hidden" name="booksID" value="<?= $books['id_books']; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            </div>

    </div>
</div>
<?php
// Menyertakan footer halaman
include '.includes/footer.php';
?>