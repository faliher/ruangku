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
