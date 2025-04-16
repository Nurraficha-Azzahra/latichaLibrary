<?php
// Memamsukkan header halaman
include '.includes/header.php';
// Menyertakan filr untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tabel data kategori -->
     <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Aktivitas</h4>
            <!-- Tombol untuk menambah aktivitas baru -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addaktivitas">Tambah Aktivitas</button>
        </div>

             <div class="card-body">
                <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="50px">#</th>
                            <th>Nama</th>
                            <th width="150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- Mengambil data aktivitas dari database -->
                        <?php
                         $index = 1;
                         $query = "SELECT * FROM aktivitas";
                         $exec = mysqli_query($conn, $query);
                         while ($aktivitas =mysqli_fetch_assoc($exec)) :
                        ?>
                        <tr>
                            <!-- Menampilkan nomor, nama aktivitas, dan opsi -->
                            <td><?= $index++; ?></td>
                            <td><?= $category['aktivitas_name']; ?></td>
                            <td>
                                <!-- Dropdown untuk opsi Edit dan Delete -->
                                 <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle 
                                    hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a href="#"  data-bs-toggle="modal" 
                                            data-bs-target="#editaktivitas_<?= $aktivitas['aktivitas_id']; ?>">
                                            <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteaktivitas_<?= $aktivitas['aktivitas_id']; ?>">
                                            <i class="bx bx-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>    
                                </div>
                            </td>
                        </tr>
                        <!-- Modal untuk Hapus Data Aktivitas -->
                        <div class="modal fade" id="deleteaktivitas_<?= $aktivitas['aktivitas_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus aktivitasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses_aktivitas.php" method="POST">
                                            <div>
                                                <p>Tindakan ini tidak bisa dibatalkan.</p>
                                                <input type="hidden" name="catID" value="<?=$aktivitas['aktivitas_id']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal untuk Update Data aktivitas -->
                        <div id="editaktivitas_<?= $aktivitas['aktivitas_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Data aktivitas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses_aktivitas.php" method="POST">
                                        <!-- Input tersembunyi untuk menyimpan ID aktivitas -->
                                         <input type="hidden" name="catID" value="<?= $aktivitas['aktivitas_id']; ?>">
                                         <div class="form-group">
                                            <label>Nama aktivitas</label>
                                            <!-- Input untuk nama aktivitas -->
                                             <input type="text" value="<?= $aktivitas['aktivitas_name']; ?>" name="aktivitas_name" class="form-control">
                                         </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="update" class="btn btn-warning">Update</button>
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
<?php include '.includes/footer.php'; ?>

<!-- Modal untuk Tambah Data aktivitas -->
<div class="modal fade" id="addaktivitas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_aktivitas.php" method="POST">
                    <div>
                        <label for="namaaktivitas" class="form-label">Nama aktivitas</label>
                        <!-- Input untuk nama aktivitas baru -->
                         <input type="text" class="form-control" name="aktivitas_name"required/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">Batal</button> 
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>