<?php
session_start();
$nama_admin = $_SESSION['nama_admin'];
$foto_admin = $_SESSION['foto_admin'];

include('koneksi/koneksi.php');

$query = "SELECT * FROM data_barang WHERE kategori = 'Barang Bergerak (Kendaraan)' AND (status_no_polisi = 'Tidak Aktif' OR status_stnk = 'Belum Lunas')";
$result = mysqli_query($conn, $query);

$notification_count = 0; // Inisialisasi jumlah notifikasi

// Loop untuk menghitung jumlah notifikasi
while ($row = mysqli_fetch_assoc($result)) {
  if ($row['status_no_polisi'] == 'Tidak Aktif') {
    $notification_count++;
  }
  if ($row['status_stnk'] == 'Belum Lunas') {
    $notification_count++;
  }
}

// Reset pointer hasil query untuk digunakan lagi
mysqli_data_seek($result, 0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ruangku - Dinkominfotik</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="http://localhost/Ruangku/assets/images/logo.png">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.6.min.css" />
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/kita.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <style>
    .card-body * {
      font-size: 12px !important;
    }

    .floating-button {
      position: fixed;
      bottom: 60px;
      /* Jarak dari bawah */
      right: 25px;
      /* Jarak dari kanan */
      z-index: 1000;
      /* Pastikan di atas elemen lain */
      background-color: #007bff;
      /* Warna tombol */
      border-radius: 50%;
      /* Membuat tombol bulat */
      width: 60px;
      /* Lebar tombol */
      height: 60px;
      /* Tinggi tombol */
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
      /* Efek bayangan */
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .floating-button:hover {
      background-color: #0056b3;
      /* Warna saat hover */
      transform: scale(1.1);
      /* Perbesar sedikit saat hover */
    }

    .floating-button i {
      font-size: 24px;
      /* Ukuran ikon */
      color: white;
      /* Warna ikon */
    }

    .tab-content {
      position: relative;
      z-index: 1;
    }

    .tab-pane {
      display: none;
    }

    .tab-pane.show {
      display: block;
    }

    .notifications {
      width: 320px;
      /* Mengatur lebar dropdown */
      max-height: 400px;
      /* Membatasi tinggi dropdown */
      overflow-y: auto;
      /* Tambahkan scroll jika item terlalu banyak */
    }

    .dashboard .kiba-card .card-icon {
      color: #8d3800;
      background: #fcbf97;
    }

    .dashboard .kibb-card .card-icon {
      color: #251f1b;
      background: #ddd9d6;
    }

    .dashboard .kibc-card .card-icon {
      color: #da1b1b;
      background: #fdb0b0;
    }

    .dashboard .kibd-card .card-icon {
      color: #4154f1;
      background: #f6f6fe;
    }

    .dashboard .kibe-card .card-icon {
      color: #5e0066;
      background: #f1c7fa;
    }

    .dashboard .kibf-card .card-icon {
      color: #00ad17;
      background: #c8f7c7;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="#" class="logo d-flex align-items-center" style="margin-left: 20px;">
        <img src="assets/images/logo.png" alt="" style="width:auto; height:40px;">
        <span class="d-inline-block">Ruang<span style="color: #72a7df;">Ku</span></span>
      </a>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <!-- Notification Icon -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge rounded-pill bg-warning badge-number"><?php echo $notification_count; ?></span> <!-- Menampilkan jumlah notifikasi -->
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              <?php echo "Anda memiliki $notification_count notifikasi baru"; ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              $id_barang_pemda = $row['id_barang_pemda'];
              $nama_barang = $row['nama_barang'];
              $no_polisi = $row['no_polisi'];

              // Kondisi pertama: status_no_polisi = 'Tidak Aktif'
              if ($row['status_no_polisi'] == 'Tidak Aktif') {
                echo "<li class='notification-item'>
            <a href='frm_edit_kendaraan.php?id_barang_pemda={$id_barang_pemda}' class='d-flex align-items-start text-decoration-none'>
                <i class='bi bi-exclamation-circle text-warning'></i>
                <div>
                    <h4>Perpanjangan No Polisi</h4>
                    <p><b>{$nama_barang} - {$no_polisi}</b> <br>Segera lakukan perpanjangan No Polisi.</p>
                </div>
            </a>
        </li>";
              }

              // Kondisi kedua: status_stnk = 'Belum Lunas'
              if ($row['status_stnk'] == 'Belum Lunas') {
                echo "<li class='notification-item'>
            <a href='frm_edit_kendaraan.php?id_barang_pemda={$id_barang_pemda}' class='d-flex align-items-start text-decoration-none'>
                <i class='bi bi-exclamation-circle text-warning'></i>
                <div>
                    <h4>Perpanjangan STNK</h4>
                    <p><b>{$nama_barang} - {$no_polisi}</b><br>Segera lakukan perpanjangan STNK.</p>
                </div>
            </a>
        </li>";
              }
            }
            ?>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#"></a>
            </li>
          </ul><!-- End Notification Dropdown Items -->
        </li><!-- End Notification -->

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <?php if (empty($foto_admin)) : ?>
              <i class="bi bi-person-circle rounded-circle" style="font-size: 24px;"></i>
            <?php else : ?>
              <img src="images/<?php echo $foto_admin; ?>" alt="Profile" class="rounded-circle">
            <?php endif; ?>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nama_admin; ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                <?php
                if (empty($nama_admin)) :
                  echo 'admin dinkominfotik';
                else :
                  echo $nama_admin;
                endif;
                ?>
              </h6>
              <span>Admin</span>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" id="logoutBtn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>
          </ul>
        </li>

    </nav>
  </header>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="daftar_barang.php">
          <i class="bi bi-clipboard-data"></i>
          <span>Data KIB B</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#jadwal-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive"></i><span>Inventaris</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="jadwal-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li><a href="lokasi.php"><i class="bi bi-circle"></i><span>UPB dan Ruang</span></a></li>
          <li><a href="inventaris.php"><i class="bi bi-circle"></i><span>Inventaris Ruangan</span></a></li>
          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#barang-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-activity"></i><span>Penggunaan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="barang-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li><a href="kendaraan.php"><i class="bi bi-circle"></i><span>Kendaraan</span></a></li>
          <li><a href="elektronik.php"><i class="bi bi-circle"></i><span>Elektronik</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Riwayat</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li><a href="Data_mutasi_barang.php"><i class="bi bi-circle"></i><span>Pindah Ruang</span></a></li>
          <li><a href="pindah_skpd.php"><i class="bi bi-circle"></i><span>Pindah SKPD</span></a></li>
          <li><a href="Data_pemeliharaan.php"><i class="bi bi-circle"></i><span>Pemeliharaan</span></a></li>
          <li><a href="penghapusan.php"><i class="bi bi-circle"></i><span>Penghapusan</span></a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="panduan_umum.php">
          <i class="bi bi-question-circle"></i>
          <span>Panduan Penggunaan</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- Vendor JS Files -->
  <script src="vendor/apexcharts/apexcharts.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/chart.umd.js"></script>
  <script src="vendor/echarts/echarts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Notiflix JS -->
  <script src="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.6.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap Bundle (JavaScript + Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
        document.querySelector('#sidebar').classList.toggle('collapsed');
      });
      document.querySelectorAll('.sidebar-nav .nav-link[data-bs-toggle="collapse"]').forEach(function(link) {
        link.addEventListener('click', function() {
          var target = document.querySelector(this.getAttribute('data-bs-target'));
          document.querySelectorAll('.sidebar-nav .collapse.show').forEach(function(collapse) {
            if (collapse !== target) {
              var bsCollapse = new bootstrap.Collapse(collapse, {
                toggle: false
              });
              bsCollapse.hide();
            }
          });
          var bsCollapse = new bootstrap.Collapse(target);
          bsCollapse.toggle();
        });
      });
    });
  </script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
      e.preventDefault();

      Notiflix.Confirm.show(
        'Konfirmasi',
        'Apakah Anda yakin ingin logout?',
        'Ya, Logout',
        'Batal',
        function() {
          window.location.href = 'proses/logout.php';
        },
        function() {}, {
          width: '320px',
          borderRadius: '8px',
          titleColor: '#000',
          messageColor: '#000',
          okButtonBackground: '#0068ff',
          cancelButtonBackground: '#ff2f7a',
          okButtonColor: '#ffffff',
          cancelButtonColor: '#ffffff',
          backOverlay: true,
        }
      );
    });
  </script>

</body>

</html>