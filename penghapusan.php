<?php
include("component/header.php");
include("koneksi/koneksi.php");

// Set batas per halaman dan halaman yang aktif
$limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$start = ($page - 1) * $limit;

// Inisialisasi variabel untuk pencarian
$search_query = "";
$search_params = [];
$param_types = "";

if (!empty($_GET['query'])) {
  $search = '%' . mysqli_real_escape_string($conn, $_GET['query']) . '%';
  $search_query = "WHERE id_barang_pemda LIKE ? OR id_barang_pemda LIKE ? OR kode_barang LIKE ? OR nama_barang LIKE ?";
  $search_params = [$search, $search, $search, $search];
  $param_types = "ssss";
}

// Query untuk mengambil data dengan pencarian dan filter
$sql = "SELECT * FROM penghapusan $search_query LIMIT ?, ?";
$count_sql = "SELECT COUNT(*) AS total FROM penghapusan $search_query";

// Menambahkan batas limit dan offset ke parameter
$search_params[] = $start;
$search_params[] = $limit;
$param_types .= "ii";

// Jalankan query utama
$stmt = mysqli_prepare($conn, $sql);
if ($param_types) {
  mysqli_stmt_bind_param($stmt, $param_types, ...$search_params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Query untuk menghitung total record
$count_stmt = mysqli_prepare($conn, $count_sql);
if ($param_types && strlen($param_types) > 2) {
  // Exclude last two 'i' types for limit and offset in count query
  mysqli_stmt_bind_param($count_stmt, substr($param_types, 0, -2), ...array_slice($search_params, 0, -2));
}
mysqli_stmt_execute($count_stmt);
$count_result = mysqli_stmt_get_result($count_stmt);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $limit);

// Range untuk pagination
$range = 2;
$start_page = max(1, $page - $range);
$end_page = min($total_pages, $page + $range);

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Daftar Penghapusan Aset</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
        <li class="breadcrumb-item">Pengelolaan</li>
        <li class="breadcrumb-item active">Penghapusan</li>
      </ol>
    </nav>
  </div>

  <div class="card">
    <div class="card-body" style="padding-top: 30px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="flex-grow-1 d-flex justify-content-center">
          <div class="search-bar position-relative">
            <form class="search-form d-flex align-items-center" method="GET" action="">
              <input type="text" id="search-input" name="query" placeholder="Cari" class="form-control pe-5" value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" oninput="toggleClearButton()">
              <button type="button" id="clear-button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-5" style="display: none; padding: 0 8px; margin-right: 8px; color: #6c757d;" onclick="clearSearch()">
                <i class="bi bi-x-circle-fill"></i>
              </button>
              <button type="submit" title="Cari" class="btn btn-outline-primary ms-2">
                <i class="bi bi-search"></i>
              </button>
            </form>
          </div>

          <script>
            function toggleClearButton() {
              const searchInput = document.getElementById('search-input');
              const clearButton = document.getElementById('clear-button');
              clearButton.style.display = searchInput.value ? 'inline' : 'none';
            }

            function clearSearch() {
              const searchInput = document.getElementById('search-input');
              searchInput.value = '';
              window.location.href = 'penghapusan.php?limit=<?= $limit; ?>&page=<?= $page; ?>';
            }
            document.addEventListener('DOMContentLoaded', toggleClearButton);
          </script>
        </div>
      </div>
      <div class="table-responsive" style="padding-top: 15px;">
        <!-- Tabel Data -->
        <table class="table table-bordered" style="font-size: 12px;">
          <thead class="table-secondary text-center">
            <tr>
              <th>ID Pemda</th>
              <th>Kode Barang</th>
              <th>Uraian</th>
              <th>No Reg</th>
              <th>Tgl Penghapusan</th>
              <th>SK</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($result)) :
                $id_barang_pemda = mysqli_real_escape_string($conn, $row['id_barang_pemda']); // Escape ID
                $sql_data_barang = "SELECT * FROM data_barang WHERE id_barang_pemda = '$id_barang_pemda'";
                $result_data_barang = mysqli_query($conn, $sql_data_barang);

                // Jika diperlukan data tambahan dari `data_barang`
                $row_data_barang = mysqli_fetch_assoc($result_data_barang);
                $sql_adm_penghapusan = "SELECT * FROM adm_penghapusan WHERE id_barang_pemda = '$id_barang_pemda'";
                $result_adm_penghapusan = mysqli_query($conn, $sql_adm_penghapusan);

                // Jika diperlukan data tambahan dari `adm_penghapusan`
                $row_adm_penghapusan = mysqli_fetch_assoc($result_adm_penghapusan);
              ?>
                <tr class="text-center">
                  <td><?= $row['id_barang_pemda'] ?></td>
                  <td><?= $row_data_barang['kode_barang'] ?></td>
                  <td><?= $row_data_barang['nama_barang'] ?></td>
                  <td><?= $row_data_barang['no_regristrasi'] ?></td>
                  <td><?= $row_adm_penghapusan['tgl_sk'] ?></td>
                  <td>
                    <?php
                    // Misalkan no_sk berbentuk '123/sk/apus'
                    $no_sk = $row_adm_penghapusan['no_sk'];
                    // Nama file SK yang sebenarnya
                    $nama_file_sk = $row_adm_penghapusan['sk']; // Misalnya '123.pdf'
                    // Path lengkap menuju file SK
                    $file_path = 'assets/upload/adm_barang/penghapusan/' . $nama_file_sk; // Path yang sesuai dengan lokasi file Anda
                    ?>
                    <!-- Link yang ditampilkan adalah no_sk, namun membuka file SK yang sesuai -->
                    <a href="<?= $file_path ?>" target="_blank"><?= $no_sk ?></a>
                  </td>
                </tr>

              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="10" class="text-center">Tidak ada data yang ditemukan</td>
              </tr>
            <?php endif; ?>
            <?php mysqli_close($conn); ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <?php if ($total_pages > 1) : ?>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= max(1, $page - 1) ?>&limit=<?= $limit ?>" aria-label="Previous">&laquo;</a>
            </li>
            <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
              <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>&limit=<?= $limit ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= min($total_pages, $page + 1) ?>&limit=<?= $limit ?>" aria-label="Next">&raquo;</a>
            </li>
          </ul>
        </nav>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php include("component/footer.php"); ?>