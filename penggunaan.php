<?php
include("component/header.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Penggunaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                <li class="breadcrumb-item">Inventarisasi</li>
                <li class="breadcrumb-item active">Penggunaan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-xxl-3 col-md-4">
                <div class="card info-card kibd-card">
                    <a href="kendaraan.php">
                        <div class="card-body-kita">
                        <h5 class="card-title"></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bus-front"></i> <!-- Sesuaikan ukuran -->
                                </div>
                                <div class="ps-3">
                                    <h6>Kendaraan</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xxl-3 col-md-4">
                <div class="card info-card kibb-card">
                    <a href="elektronik.php">
                        <div class="card-body-kita">
                        <h5 class="card-title"></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-tv"></i> <!-- Sesuaikan ukuran -->
                                </div>
                                <div class="ps-3">
                                    <h6>Elektronik</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>

</main>
<?php include("component/footer.php"); ?>