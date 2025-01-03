<?php
include('koneksi/koneksi.php');

// Halaman
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search_query = "";
$search_params = [];
$param_types = "";

// Mengecek apakah ada input pencarian
if (!empty($_GET['query'])) {
    $search = '%' . mysqli_real_escape_string($conn, $_GET['query']) . '%';
    $search_query = "WHERE id_lokasi LIKE ? OR nama_lokasi LIKE ? OR bid_lokasi LIKE ? OR tempat_lokasi LIKE ?";
    array_push($search_params, $search, $search, $search, $search);
    $param_types .= "ssss"; // Tambahkan empat "s" untuk empat LIKE parameter
}

// Query SQL utama
$sql = "SELECT * FROM lokasi $search_query LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $sql);

// Tambahkan tipe untuk dua parameter limit dan offset
$param_types .= "ii";
array_push($search_params, $start, $limit);

// Bind parameter sesuai dengan tipe dan jumlah
mysqli_stmt_bind_param($stmt, $param_types, ...$search_params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


$count_sql = "SELECT COUNT(*) AS total FROM lokasi $search_query";
$count_stmt = mysqli_prepare($conn, $count_sql);

if (!empty($search_query)) {
    mysqli_stmt_bind_param($count_stmt, substr($param_types, 0, -2), ...array_slice($search_params, 0, -2)); // Only bind search params
}

mysqli_stmt_execute($count_stmt);
$count_result = mysqli_stmt_get_result($count_stmt);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $limit);

$end = min($start + $limit, $total_records);
$showing_text = "Showing " . ($start + 1) . " to " . $end . " of " . $total_records . " entries";

$offset = $start;
$no = $offset + 1;

$visible_pages = 3;
$start_page = max(1, $page - floor($visible_pages / 2));
$end_page = min($total_pages, $page + floor($visible_pages / 2));

if ($page <= ceil($visible_pages / 2)) {
    $end_page = min($total_pages, $visible_pages);
}
if ($page > $total_pages - floor($visible_pages / 2)) {
    $start_page = max(1, $total_pages - $visible_pages + 1);
}
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Event handler untuk tombol hapus
        $('.btn-hapus').on('click', function() {
            // Ambil id_lokasi dari atribut data
            var id_lokasi = $(this).data('id_lokasi');

            // Tampilkan popup SweetAlert2
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke halaman hapus
                    window.location.href = 'proses/lokasi/hapus_lokasi.php?id_lokasi=' + id_lokasi;
                }
            });
        });
    });
</script>