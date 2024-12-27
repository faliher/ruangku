<?php
// Cek apakah id_barang_pemda ada di tabel pindah_skpd_masuk
$query_skpd = "SELECT COUNT(*) as count FROM pindah_skpd_masuk WHERE id_barang_pemda = $id_barang_pemda";
$result_skpd = mysqli_query($conn, $query_skpd);
$row_skpd = mysqli_fetch_assoc($result_skpd);
$show_pindah_skpd_tab = $row_skpd['count'] > 0; // Tab hanya ditampilkan jika ada data
?>

<!-- Tab Navigation -->
<ul class="nav nav-pills mb-4" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link w-100 active" id="pindah_ruang-tab" data-bs-toggle="tab" data-bs-target="#pindah_ruang" type="button" role="tab" aria-controls="pindah_ruang" aria-selected="true">Pindah Ruang</button>
    </li>
    <?php if ($show_pindah_skpd_tab) : ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link w-100" id="pindah_skpd-tab" data-bs-toggle="tab" data-bs-target="#pindah_skpd" type="button" role="tab" aria-controls="pindah_skpd" aria-selected="false">Pindah SKPD</button>
        </li>
    <?php endif; ?>
    <li class="nav-item" role="presentation">
        <button class="nav-link w-100" id="pemeliharaan-tab" data-bs-toggle="tab" data-bs-target="#pemeliharaan" type="button" role="tab" aria-controls="pemeliharaan" aria-selected="false">Pemeliharaan</button>
    </li>
</ul>

<div class="tab-pane fade" id="pindah_ruang" role="tabpanel" aria-labelledby="pindah_ruang-tab">
    <div class="card-body" style="background-color: #f7faff; border: 1px;">
        <h5 class="card-title">
            Riwayat Perpindahan <span>| <?php echo $row['nama_barang']; ?></span>
        </h5>
        <div class="activity position-relative">
            <?php
            $query_mutasi = "SELECT * FROM mutasi_barang WHERE id_barang_pemda = $id_barang_pemda";
            $result_mutasi = mysqli_query($conn, $query_mutasi);
            $total_mutasi = mysqli_num_rows($result_mutasi);
            $index = 1;
            ?>
            <?php if (mysqli_num_rows($result_mutasi) > 0) : ?>
                <?php
                $index = 1;
                $total_mutasi = mysqli_num_rows($result_mutasi);
                ?>
                <?php while ($row_mutasi = mysqli_fetch_assoc($result_mutasi)) : ?>
                    <div class="activity-item d-flex mb-2 position-relative">
                        <div class="activity-label" style="width: 100px;">
                            <?php
                            $formatted_date = date('d-m-Y', strtotime($row_mutasi['tgl_mutasi']));
                            ?>
                            <a href="frm_edit_mutasi.php?id_mutasi=<?php echo $row_mutasi['id_mutasi']; ?>" title="Lihat" style="text-decoration: none; color: blue;">
                                <?php echo $formatted_date; ?>
                            </a>
                        </div>

                        <i class="bi bi-circle-fill activity-badge text-secondary align-self-start mx-2" style="position: relative; left: -30px;"></i>
                        <div class="activity-content">
                            <div style="position: relative; left: -20px;">
                                <?php
                                $parts = explode(' - ', $row_mutasi['ruang_tujuan']);
                                if (isset($parts[1])) {
                                    $result = trim($parts[1]);
                                    echo $result;
                                }
                                ?>
                            </div>
                        </div>

                        <?php if ($index < $total_mutasi) : ?>
                            <div class="timeline-line" style="position: absolute; left: 83px; top: 15px; width: 2px; height: 110%; 
                          background-color: #b8b8b9;">
                            </div>
                        <?php endif; ?>
                    </div><!-- End activity item -->
                    <?php $index++; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p style="text-align: center; color: #888;">Tidak ada data yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php if ($show_pindah_skpd_tab) : ?>
    <div class="tab-pane fade" id="pindah_skpd" role="tabpanel" aria-labelledby="pindah_skpd-tab">
        <!-- Konten Pindah SKPD -->
    </div>
<?php endif; ?>

<div class="tab-pane fade" id="pemeliharaan" role="tabpanel" aria-labelledby="pemeliharaan-tab">
    <div class="card-body" style="font-size: 12px; background-color: #f7faff; border: 1px; padding-bottom:0;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title m-0">
                Riwayat Pemeliharaan <span>| <?php echo $row['no_regristrasi'] . ' - ' . $row['nama_barang']; ?></span>
            </h5>
            <a href="frm_tambah_pemeliharaan.php?id_barang_pemda=<?php echo $id_barang_pemda; ?>" class="btn btn-primary btn-sm" title="Tambah Pemeliharaan">+</a>
        </div>

        <div class="activity position-relative" style="margin-left: 20px;">
            <?php
            $query_pemeliharaan = "SELECT * FROM data_pemeliharaan WHERE id_barang_pemda = $id_barang_pemda";
            $result_pemeliharaan = mysqli_query($conn, $query_pemeliharaan);
            $total_pemeliharaan = mysqli_num_rows($result_pemeliharaan);
            $index = 1; // Inisialisasi penghitung
            ?>
            <?php if (mysqli_num_rows($result_pemeliharaan) > 0) : ?>
                <?php
                $index = 1;
                $total_pemeliharaan = mysqli_num_rows($result_pemeliharaan);
                ?>
                <?php while ($row_pemeliharaan = mysqli_fetch_assoc($result_pemeliharaan)) : ?>
                    <div class="activity-item d-flex mb-3 position-relative">
                        <div class="activity-label" style="width: 100px;">
                            <?php
                            $format_date = date('d-m-Y', strtotime($row_pemeliharaan['tgl_perbaikan']));
                            ?>
                            <a href="frm_edit_pemeliharaan.php?id_pemeliharaan=<?php echo $row_pemeliharaan['id_pemeliharaan']; ?>" title="Lihat" style="text-decoration: none; color: blue;">
                                <?php echo $format_date; ?>
                            </a>
                        </div>
                        <i class="bi bi-circle-fill activity-badge text-secondary align-self-start mx-2"></i>
                        <div class="activity-content">
                            <?php echo number_format($row_pemeliharaan['biaya_perbaikan'], 2, ',', '.'); ?>
                        </div>
                        <?php if ($index < $total_pemeliharaan) : ?>
                            <div class="timeline-line" style="position: absolute; left: 113px; top: 15px; width: 2px; height: 110%; background-color: #b8b8b9;">
                            </div>
                        <?php endif; ?>
                    </div><!-- End activity item -->
                    <?php $index++; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p style="text-align: center; color: #888;">Tidak ada data yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

</div>