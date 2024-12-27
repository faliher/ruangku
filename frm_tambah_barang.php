<?php
include('component/header.php');
include('proses/barang/get data/get_data_tambah_barang.php');
?>

<main id="main" class="main">
    <div class="card">
        <div class="card-body" style="padding-top: 15px; position: relative;">
            <div class="card-title">
                <h1 style="font-size: 20px !important; margin: 0;">Tambah Aset/Barang</h1>
                <hr>
                <!-- Dropdown Pilihan -->
                <div class="row mb-2">
                    <label for="formSelector" class="col-sm-2 col-form-label" style="text-align: end;">Pilih Form </label>
                    <div class="col-sm-8">
                        <select id="formSelector" class="form-select" style="width: auto;" onchange="toggleContent()">
                            <option value="">Pilih</option>
                            <option value="asetBaru">Aset Baru</option>
                            <option value="pindahSKPD">Pindah SKPD - Masuk</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Default Watermark -->
            <div id="defaultWatermark" style="text-align: center; margin-top: 130px; margin-bottom:130px;">
                <img src="assets/images/logo.png" alt="Logo" style="max-width: 100px; opacity: 0.5;">
            </div>
            <!-- Form Tambah Barang Baru -->
            <div id="asetBaruForm" style="display: none;">
                <?php include('frm_tambah_barang_baru.php'); ?>
            </div>
            <!-- Form Tambah Barang Pindah SKPD Masuk -->
            <div id="pindahSKPDForm" style="display: none;">
                <?php include('frm_tambah_skpd_masuk.php'); ?>
            </div>
        </div>
    </div> <!-- End form -->
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<script>
    // Fungsi untuk menampilkan form atau watermark berdasarkan pilihan
    function toggleContent() {
        const formSelector = document.getElementById('formSelector');
        const defaultWatermark = document.getElementById('defaultWatermark');
        const asetBaruForm = document.getElementById('asetBaruForm');
        const pindahSKPDForm = document.getElementById('pindahSKPDForm');

        // Reset semua tampilan
        defaultWatermark.style.display = 'none';
        asetBaruForm.style.display = 'none';
        pindahSKPDForm.style.display = 'none';

        // Tampilkan sesuai pilihan
        if (formSelector.value === 'asetBaru') {
            asetBaruForm.style.display = 'block';
        } else if (formSelector.value === 'pindahSKPD') {
            pindahSKPDForm.style.display = 'block';
        } else {
            // Jika belum ada pilihan
            defaultWatermark.style.display = 'block';
        }
    }
</script>