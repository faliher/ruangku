<form>
    <div class="row" style="padding-top: 10px;">
        <div class="col-md-6" style="padding-right: 10px;">
            <div class="row mb-2">
                <!-- ID Pemda -->
                <label for="id_barang_pemda" class="col-sm-3 col-form-label">ID Pemda</label>
                <div class="col-sm-8">
                    <input type="text" id="id_barang_pemda" class="form-control" value="<?php echo $row['id_barang_pemda']; ?>" readonly style="font-weight: bold;">
                </div>
            </div>
            <!-- Nama Barang -->
            <div class="row mb-2">
                <label for="nama_barang" class="col-sm-3 col-form-label">Nama Aset</label>
                <div class="col-sm-8">
                    <input type="text" id="nama_barang" class="form-control" value="<?php echo $row['nama_barang']; ?>" readonly style="font-weight: bold;">
                </div>
            </div>
            <!-- Kode Barang -->
            <div class="row mb-2">
                <label for="kode_barang" class="col-sm-3 col-form-label">Kode Aset</label>
                <div class="col-sm-8">
                    <input type="text" id="kode_barang" class="form-control" value="<?php echo $row['kode_barang']; ?>" readonly>
                </div>
            </div>
            <!-- Kode Pemilik dan Nama Pemilik -->
            <div class="row mb-2">
                <label for="kode_pemilik" class="col-sm-3 col-form-label">Pemilik</label>
                <div class="col-sm-8">
                    <input type="text" id="pemilik" class="form-control readonly-input" value="<?php echo htmlspecialchars($row['kode_pemilik'] . ' - ' . $nama_pemilik); ?>" readonly>
                </div>
            </div>
            <!-- No. Registrasi -->
            <div class="row mb-2">
                <label for="no_regristrasi" class="col-sm-3 col-form-label">No. Reg</label>
                <div class="col-sm-8">
                    <input type="text" id="no_regristrasi" class="form-control" value="<?php echo $row['no_regristrasi']; ?>" readonly>
                </div>
            </div>
            <!-- Lokasi Asal -->
            <div class="row mb-2">
                <label for="lokasi_asal" class="col-sm-3 col-form-label">Ruang Asal</label>
                <div class="col-sm-8">
                    <input type="text" id="lokasi_asal" class="form-control" value="<?php echo $row['id_ruang_asal'] . ' - ' . $row['bidang_ruang_asal']; ?>" readonly>
                </div>
            </div>

            <!-- Lokasi Sekarang -->
            <div class="row mb-2">
                <label for="lokasi_sekarang" class="col-sm-3 col-form-label">Ruang Sekarang</label>
                <div class="col-sm-8">
                    <input type="text" id="lokasi_sekarang" class="form-control" value="<?php echo htmlspecialchars($id_ruang_sekarang . ' - ' . $row['bidang_ruang_sekarang']); ?>" readonly>
                </div>
            </div>
            <!-- Kategori -->
            <div class="row mb-2">
                <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-8">
                    <input type="text" id="kategori" class="form-control" value="<?php echo $row['kategori']; ?>" readonly>
                </div>
            </div>
            <!-- Harga -->
            <div class="row mb-2">
                <label for="harga_awal" class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" id="harga_awal" class="form-control" value="<?php echo number_format($row['harga_awal'], 2, ',', '.'); ?>" readonly>
                    </div>
                </div>
            </div>
            <!-- Tanggal Pembelian -->
            <div class="row mb-2">
                <label for="tgl_pembelian" class="col-sm-3 col-form-label">Tgl Pembelian</label>
                <div class="col-sm-8">
                    <input type="text" id="tgl_pembelian" class="form-control" value="<?php echo date('d/m/Y', strtotime($row['tgl_pembelian'])); ?>" readonly>
                </div>
            </div>
            <!-- Masa Manfaat -->
            <div class="row mb-2">
                <label for="masa_manfaat" class="col-sm-3 col-form-label">Masa Manfaat</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="text" id="masa_manfaat" class="form-control" value="<?php echo $row['masa_manfaat']; ?>" readonly>
                        <span class="input-group-text">Bulan</span>
                    </div>
                </div>
            </div>
            <!-- Kondisi Barang -->
            <div class="row mb-2">
                <label for="kondisi_barang" class="col-sm-3 col-form-label">Kondisi</label>
                <div class="col-sm-8">
                    <input type="text" id="kondisi_barang" class="form-control" value="<?php echo $row['kondisi_barang']; ?>" readonly>
                </div>
            </div>

        </div> <!-- end kolom -->

        <div class="col-md-6">
            <!-- Merk -->
            <div class="row mb-2">
                <label for="merk" class="col-sm-3 col-form-label">Merk</label>
                <div class="col-sm-8">
                    <input type="text" id="merk" class="form-control" value="<?php echo $row['merk']; ?>" readonly>
                </div>
            </div>
            <!-- tipe -->
            <div class="row mb-2">
                <label for="type" class="col-sm-3 col-form-label">Tipe</label>
                <div class="col-sm-8">
                    <input type="text" id="type" class="form-control" value="<?php echo $row['type']; ?>" readonly>
                </div>
            </div>
            <!-- bahan -->
            <div class="row mb-2">
                <label for="bahan" class="col-sm-3 col-form-label">Bahan</label>
                <div class="col-sm-8">
                    <input type="text" id="bahan" class="form-control" value="<?php echo $row['bahan']; ?>" readonly>
                </div>
            </div>
            <!-- ukuran -->
            <div class="row mb-2">
                <label for="ukuran_CC" class="col-sm-3 col-form-label">Ukuran / CC</label>
                <div class="col-sm-8">
                    <input type="text" id="ukuran_CC" class="form-control" value="<?php echo $row['ukuran_CC']; ?>" readonly>
                </div>
            </div>
            <!-- no pabrik -->
            <div class="row mb-2">
                <label for="no_pabrik" class="col-sm-3 col-form-label">No. Pabrik</label>
                <div class="col-sm-8">
                    <input type="text" id="no_pabrik" class="form-control" value="<?php echo $row['no_pabrik']; ?>" readonly>
                </div>
            </div>
            <!-- no rangka -->
            <div class="row mb-2">
                <label for="no_rangka" class="col-sm-3 col-form-label">No. Rangka</label>
                <div class="col-sm-8">
                    <input type="text" id="no_rangka" class="form-control" value="<?php echo $row['no_rangka']; ?>" readonly>
                </div>
            </div>
            <!-- no mesin -->
            <div class="row mb-2">
                <label for="no_mesin" class="col-sm-3 col-form-label">No. Mesin</label>
                <div class="col-sm-8">
                    <input type="text" id="no_mesin" class="form-control" value="<?php echo $row['no_mesin']; ?>" readonly>
                </div>
            </div>
            <!-- no bpkb -->
            <div class="row mb-2">
                <label for="no_bpkb" class="col-sm-3 col-form-label">No. BPKB</label>
                <div class="col-sm-8">
                    <input type="text" id="no_bpkb" class="form-control" value="<?php echo $row['no_bpkb']; ?>" readonly>
                </div>
            </div>
            <!-- no polisi -->
            <div class="row mb-2">
                <label for="no_polisi" class="col-sm-3 col-form-label">No. Polisi</label>
                <div class="col-sm-8">
                    <input type="text" id="no_polisi" class="form-control" value="<?php echo $row['no_polisi']; ?>" readonly>
                </div>
            </div>
            <!-- keterangan -->
            <div class="row mb-2">
                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan:</label>
                <div class="col-sm-8">
                    <textarea id="keterangan" class="form-control" rows="3" readonly><?php echo $row['keterangan']; ?></textarea>
                </div>
            </div>

            <!-- Foto -->
            <div class="row mb-4">
                <label class="col-sm-3 col-form-label">Foto:</label>
                <div class="col-sm-8" style="padding-top: 8px;">
                    <a href="javascript:void(0);" id="togglePhotoLink" onclick="togglePhoto()" style="font-size: 15px;">Lihat Foto...</a>
                </div>
            </div>
            <div id="photoSection" style="display:none;" class="row mb-4">
                <div class="col-sm-8 offset-sm-3">
                    <?php if (!empty($row['foto_barang'])) : ?>
                        <img src="assets/images/<?php echo $row['foto_barang']; ?>" alt="Foto Barang" class="img-fluid" style="max-width: 100%; height: auto; border: 1px solid #ddd;">
                    <?php else : ?>
                        <p style="font-size: 15px;">None</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12 text-end">
                    <a href="frm_edit_barang.php?id_barang_pemda=<?php echo $row['id_barang_pemda']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="frm_pindah_skpd_keluar.php?id_barang_pemda=<?php echo $row['id_barang_pemda']; ?>" class="btn btn-warning btn-sm" data-id_barang_pemda="<?php echo $row['id_barang_pemda']; ?>">Pindah SKPD</a>
                    <a href="hapus_barang.php?id_barang_pemda=<?php echo $row['id_barang_pemda']; ?>" class="btn btn-danger btn-sm btn-hapus" data-id_barang_pemda="<?php echo $row['id_barang_pemda']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
</form>