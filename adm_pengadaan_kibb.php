<?php if ($row['kondisi_barang'] !== 'Rusak Berat') { ?>
    <div class="card" style="box-shadow: none; border: 1px solid #dee2e6;">
        <div class="card-body" style="padding-top: 10px;">
            <h5>Berkas Pengadaan</h5>
            <hr>
            <form>
                <div class="row" style="padding-top: 10px;">
                    <div class="row mb-2">
                        <!-- ID Pemda -->
                        <label for="no_sk" class="col-sm-3 col-form-label">No SK</label>
                        <div class="col-sm-8">
                            <input type="text" id="no_sk" class="form-control" value="<?php echo $row_adm['no_sk']; ?>" readonly style="font-weight: bold;">
                        </div>
                    </div>
                    <!-- Tanggal SK -->
                    <div class="row mb-2">
                        <label for="tgl_sk" class="col-sm-3 col-form-label">Tgl SK</label>
                        <div class="col-sm-8">
                            <input type="date" id="tgl_sk" class="form-control" value="<?php echo $row_adm['tgl_sk']; ?>" readonly>
                        </div>
                    </div>
                    <!-- Upload SK -->
                    <div class="row mb-2">
                        <label for="sk" class="col-sm-3 col-form-label">SK</label>
                        <div class="col-sm-8">
                            <?php if (!empty($row_adm['sk'])) { ?>
                                <a href="uploads/<?php echo $row_adm['sk']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                            <?php } else { ?>
                                <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <h6>Berkas Lainnya</h6>
                    <div class="row mb-2">
                        <label for="kwitansi" class="col-sm-3 col-form-label">Faktur</label>
                        <div class="col-sm-8">
                            <?php if (!empty($row_adm['kwitansi'])) { ?>
                                <a href="uploads/<?php echo $row_adm['kwitansi']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                            <?php } else { ?>
                                <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="bast" class="col-sm-3 col-form-label">BAST</label>
                        <div class="col-sm-8">
                            <?php if (!empty($row_adm['bast'])) { ?>
                                <a href="uploads/<?php echo $row_adm['bast']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                            <?php } else { ?>
                                <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="sttb" class="col-sm-3 col-form-label">STTB</label>
                        <div class="col-sm-8">
                            <?php if (!empty($row_adm['sttb'])) { ?>
                                <a href="upload/adm_barang/<?php echo $row_adm['sttb']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                            <?php } else { ?>
                                <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-11 text-end">
                            <?php
                            // Periksa apakah salah satu file kosong
                            if (empty($row_adm['sk']) || empty($row_adm['bast']) || empty($row_adm['sttb']) || empty($row_adm['kwitansi'])) {
                                // Jika ada file yang kosong
                                echo '<a href="frm_edit_barang.php?id_barang_pemda=' . $row_adm['id_barang_pemda'] . '" class="btn btn-info btn-sm">Lengkapi Berkas</a>';
                            } else {
                                // Jika semua file ada
                                echo '<a href="frm_edit_barang.php?id_barang_pemda=' . $row_adm['id_barang_pemda'] . '" class="btn btn-success btn-sm">Ubah Berkas</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php } else { ?>
    <form>
        <div class="row" style="padding-top: 10px;">
            <div class="col-md-6" style="padding-right: 10px;">
                <div class="card" style="box-shadow: none; border: 1px solid #dee2e6;">
                    <div class="card-body" style="padding-top: 10px;">
                        <h5>Berkas Pengadaan</h5>
                        <div class="row mb-2">
                            <!-- ID Pemda -->
                            <label for="no_sk" class="col-sm-3 col-form-label">No SK</label>
                            <div class="col-sm-8">
                                <input type="text" id="no_sk" class="form-control" value="<?php echo $row_adm['no_sk']; ?>" readonly style="font-weight: bold;">
                            </div>
                        </div>
                        <!-- Tanggal SK -->
                        <div class="row mb-2">
                            <label for="tgl_sk" class="col-sm-3 col-form-label">Tgl SK</label>
                            <div class="col-sm-8">
                                <input type="date" id="tgl_sk" class="form-control" value="<?php echo $row_adm['tgl_sk']; ?>" readonly>
                            </div>
                        </div>
                        <!-- Upload SK -->
                        <div class="row mb-2">
                            <label for="sk" class="col-sm-3 col-form-label">SK</label>
                            <div class="col-sm-8">
                                <?php if (!empty($row_adm['sk'])) { ?>
                                    <a href="uploads/<?php echo $row_adm['sk']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="section-title" style="padding-bottom: 20px;">
                            <span>Berkas Lainnya</span>
                        </div>

                        <style>
                            .section-title {
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                position: relative;
                            }

                            .section-title::before,
                            .section-title::after {
                                content: '';
                                flex: 1;
                                border-bottom: 1px solid #ddd;
                                /* Warna garis */
                                margin: 0 10px;
                                /* Jarak antara teks dan garis */
                            }

                            .section-title span {
                                font-weight: bold;
                                font-size: 16px;
                                /* Ukuran teks */
                                color: #333;
                                /* Warna teks */
                            }
                        </style>

                        <div class="row mb-2">
                            <label for="kwitansi" class="col-sm-3 col-form-label">Faktur</label>
                            <div class="col-sm-8">
                                <?php if (!empty($row_adm['kwitansi'])) { ?>
                                    <a href="uploads/<?php echo $row_adm['kwitansi']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="bast" class="col-sm-3 col-form-label">BAST</label>
                            <div class="col-sm-8">
                                <?php if (!empty($row_adm['bast'])) { ?>
                                    <a href="uploads/<?php echo $row_adm['bast']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="sttb" class="col-sm-3 col-form-label">STTB</label>
                            <div class="col-sm-8">
                                <?php if (!empty($row_adm['sttb'])) { ?>
                                    <a href="upload/adm_barang/<?php echo $row_adm['sttb']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-11 text-end">
                                <?php
                                // Periksa apakah salah satu file kosong
                                if (empty($row_adm['sk']) || empty($row_adm['bast']) || empty($row_adm['sttb']) || empty($row_adm['kwitansi'])) {
                                    // Jika ada file yang kosong
                                    echo '<a href="frm_edit_barang.php?id_barang_pemda=' . $row_adm['id_barang_pemda'] . '" class="btn btn-info btn-sm">Lengkapi Berkas</a>';
                                } else {
                                    // Jika semua file ada
                                    echo '<a href="frm_edit_barang.php?id_barang_pemda=' . $row_adm['id_barang_pemda'] . '" class="btn btn-success btn-sm">Ubah Berkas</a>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="box-shadow: none; border: 1px solid #dee2e6;">
                    <div class="card-body" style="padding-top: 10px;">
                        <h5>Penghapusan</h5>
                        <div class="row mb-2">
                            <label for="no_sk" class="col-sm-3 col-form-label">No SK</label>
                            <div class="col-sm-8">
                                <input type="text" id="no_sk" class="form-control" value="<?php echo $row_hapus['no_sk']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="tgl_sk" class="col-sm-3 col-form-label">Tgl SK</label>
                            <div class="col-sm-8">
                                <input type="date" id="tgl_sk" class="form-control" value="<?php echo $row_hapus['tgl_sk']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="sk" class="col-sm-3 col-form-label">SK</label>
                            <div class="col-sm-8">
                                <?php if (!empty($row_adm['sttb'])) { ?>
                                    <a href="upload/riwayat/penghapusan/<?php echo $row_hapus['sk']; ?>" target="_blank" class="btn btn-link">Lihat File</a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada file/berkas/dokumen yang diunggah</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-11 text-end">
                                <?php
                                // Periksa apakah salah satu file kosong
                                if (empty($row_hapus['sk'])) {
                                    // Jika ada file yang kosong
                                    echo '<a href="proses/barang/edit-adm_barang.php?id_barang_pemda=' . $row_hapus['id_barang_pemda'] . '" class="btn btn-info btn-sm">Lengkapi Berkas</a>';
                                } else {
                                    // Jika semua file ada
                                    echo '<a href="proses/barang/edit-adm_barang.php?id_barang_pemda=' . $row_hapus['id_barang_pemda'] . '" class="btn btn-success btn-sm">Ubah Berkas</a>';
                                }
                                ?>
                                <a href="proses/barang/penghapusan_barang.php?php echo $row['id_barang_pemda']; ?>" class="btn btn-danger btn-sm btn-hapus" data-id_barang_pemda="<?php echo $row['id_barang_pemda']; ?>">Hapus dari KIB B</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>