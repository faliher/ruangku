<?php
include("component/header.php");
include("proses/barang/get data/get_detail_barang.php");
?>
<main id="main" class="main">
  <div class="card">
    <div class="card-body" style="padding-top: 10px;">
      <div class="card-title">
        <h1 style="font-size: 20px !important; margin: 0;"><?php echo $row['nama_barang']; ?></h1>
      </div>
      <!-- Tab Navigation -->
      <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link w-100 active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="true">Detail</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link w-100" id="administrasi-tab" data-bs-toggle="tab" data-bs-target="#administrasi" type="button" role="tab" aria-controls="administrasi" aria-selected="false">Administrasi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link w-100" id="riwayat-tab" data-bs-toggle="tab" data-bs-target="#riwayat" type="button" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat</button>
        </li>
      </ul>
      <div class="tab-content pt-2" id="myTabContent">
        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
          <?php include('detail_barang.php'); ?>

        </div>
      </div>

      <div class="tab-pane fade" id="administrasi" role="tabpanel" aria-labelledby="administrasi-tab">
      <?php include('adm_pengadaan_kibb.php'); ?>
    </div>

      <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
      <?php include('riwayat_barang.php'); ?>
      </div>

    </div>
  </div><!-- End detail card -->
</main>
<?php include("component/footer.php"); ?>

