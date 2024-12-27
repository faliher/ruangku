<?php
include('component/header.php');
include('koneksi/koneksi.php');

// Periksa apakah parameter 'id_barang_pemda' tersedia di URL
if (isset($_GET['id_barang_pemda'])) {
    $id_barang_pemda = $_GET['id_barang_pemda'];

    // Ambil data barang berdasarkan id_barang_pemda yang diterima
    $query_barang = "SELECT *FROM data_barang WHERE id_barang_pemda = ?";
    $stmt = $conn->prepare($query_barang);
    $stmt->bind_param("s", $id_barang_pemda);
    $stmt->execute();
    $result_barang = $stmt->get_result();
    $row = $result_barang->fetch_assoc();
} else {
    // Jika parameter tidak tersedia, arahkan pengguna kembali ke halaman lain atau tampilkan pesan error
    echo "ID Barang Pemda tidak ditemukan!";
    exit;
}
?>

<main id="main" class="main">
    <div class="card">
        <div class="card-body" style="padding-top: 10px;">
            <div class="card-title">
                <h1 style="font-size: 20px !important; margin: 0;">
                    Pindah SKPD - Keluar
                    <span style="font-size: 20px !important; margin: 0;"> | </span>
                    <span>
                        <?php
                        echo htmlspecialchars($row['no_regristrasi'] . ' ' . $row['nama_barang']);
                        ?>
                    </span>

                </h1>
            </div>
            <hr>

            <!-- form detail mutasi -->
            <form id="form1" method="POST" action="proses/pindah skpd/keluar.php" enctype="multipart/form-data">
                <div id="form1-container">
                    <div class="row">
                        <div class="col-md-6" style="padding-right: 10px;">
                            <input type="hidden" id="hidden_id_barang_pemda" name="id_barang_pemda">
                            <div class="row mb-2">
                                <label for="nama_skpd_tujuan" class="col-sm-3 col-form-label">SKPD tujuan<span style="color: red;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama_skpd_tujuan" class="form-control" id="nama_skpd_tujuan" required></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="ruang_tujuan" class="col-sm-3 col-form-label">Ruang Tujuan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ruang_tujuan" class="form-control" id="ruang_tujuan"></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="pj" class="col-sm-3 col-form-label">PJ</label>
                                <div class="col-sm-8">
                                    <input type="text" name="pj" class="form-control" id="pj"></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="alasan_mutasi" class="col-sm-3 col-form-label">Alasan Mutasi</label>
                                <div class="col-sm-8">
                                    <textarea name="alasan_mutasi" class="form-control" id="alasan_mutasi"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6" style="padding-right: 10px;">
                            <div class="row mb-2">
                                <label for="no_surat_mutasi" class="col-sm-3 col-form-label">No Surat Mutasi<span style="color: red;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_surat_mutasi" class="form-control" id="no_surat_mutasi" required></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="tgl_surat_mutasi" class="col-sm-3 col-form-label">Tgl Surat Mutasi<span style="color: red;">*</span></label>
                                <div class="col-sm-8">
                                    <input type="date" name="tgl_surat_mutasi" class="form-control" id="tgl_surat_mutasi" required></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="surat_mutasi" class="col-sm-3 col-form-label">Surat Mutasi</label>
                                <div class="col-sm-8">
                                    <input type="file" name="surat_mutasi" class="form-control" id="surat_mutasi"></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="bast" class="col-sm-3 col-form-label">BAST</label>
                                <div class="col-sm-8">
                                    <input type="file" name="bast" class="form-control" id="bast"></input>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="dokumen_lainnya" class="col-sm-3 col-form-label">Dokumen Lainnya</label>
                                <div class="col-sm-8">
                                    <input type="file" name="dokumen_lainnya" class="form-control" id="dokumen_lainnya"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12 text-end">
                            <button type="submit" class="btn btn-primary">Pindah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include ('component/footer.php'); ?>