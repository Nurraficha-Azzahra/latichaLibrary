<?php
include (".includes/header.php");
$title = "Dashboard";
// Menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk menampilkan tabel peminjaman -->
    <div class="card">
        <!-- Tabel dengan baris yang dapat di-hover -->
        <div class="card">
            <!-- Header Tabel -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Semua Aktivitas</h4>
            </div>
            <div class="card-body">
                <!-- Tabel responsif -->
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>ID Peminjaman</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th with="150px">Pilihan</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- Menampilkan data dari tabel database -->
                            <?php
                                $index = 1; // Variabel untuk nomor urut
                                /* Query untuk mengambil data dari tabel buku, anggota, dan peminjaman */
                                $query = "SELECT peminjaman.*, anggota.anggota_id, anggota.namaLengkap,
                                peminjaman.peminjaman_id, buku.* FROM peminjaman
                                INNER JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id
                                INNER JOIN buku ON peminjaman.buku_id = buku.id_buku";
                                // Eksekusi query
                                $exec = mysqli_query($conn, $query);

                                // Perulangan untuk menampilkan setiap baris query
                                while ($row = mysqli_fetch_assoc($exec)) :
                            ?>
                                <tr>
                                    <td><?= $row['peminjaman_id']; ?></td>
                                    <td><?= $row['namaLengkap']; ?></td>
                                    <td><?= $row['judul_buku']; ?></td>
                                    <td><?= $row['tgl_peminjaman']; ?></td>
                                    <td><?= $row['tgl_dikembalikan']; ?></td>
                                    <td><?= $row['denda']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <!-- Tombol dropdown untuk Pilihan -->
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <!-- Menu dropdown -->
                                            <div class="dropdown-menu">
                                                <!-- Pilihan Edit -->
                                                <a href="edit_peminjaman.php?peminjaman_id=<?= $row['peminjaman_id']; ?>" class="dropdown-item">
                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                </a>
                                                <!-- Pilihan Delete -->
                                                <a href="proses_peminjaman.php?peminjaman_id=<?= $row['peminjaman_id']?> " class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletebooks_<?= $bookst['id_books']; ?>">
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
        <!-- Akhir tabel dengan baris yang dapat di-hover -->
    </div>
</div>

<?php
include (".includes/footer.php");
?>