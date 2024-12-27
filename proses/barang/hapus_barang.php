<?php
session_start();
include('../../koneksi/koneksi.php');

// Pastikan parameter id_barang_pemda ada di URL
if (isset($_GET['id_barang_pemda'])) {
    $id_barang_pemda = mysqli_real_escape_string($conn, $_GET['id_barang_pemda']);

    // Mulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Hapus data dari tabel adm_pengadaan_kibb
        $sql1 = "DELETE FROM adm_pengadaan_kibb WHERE id_barang_pemda = '$id_barang_pemda'";
        if (!mysqli_query($conn, $sql1)) {
            throw new Exception("Gagal menghapus data dari adm_pengadaan_kibb: " . mysqli_error($conn));
        }

        // Hapus data dari tabel adm_penghapusan
        $sql2 = "DELETE FROM adm_penghapusan WHERE id_barang_pemda = '$id_barang_pemda'";
        if (!mysqli_query($conn, $sql2)) {
            throw new Exception("Gagal menghapus data dari adm_penghapusan: " . mysqli_error($conn));
        }

        // Hapus data dari tabel data_barang
        $sql3 = "DELETE FROM data_barang WHERE id_barang_pemda = '$id_barang_pemda'";
        if (!mysqli_query($conn, $sql3)) {
            throw new Exception("Gagal menghapus data dari data_barang: " . mysqli_error($conn));
        }

        // Commit transaksi jika semua query berhasil
        mysqli_commit($conn);

        // Setelah berhasil menghapus, redirect ke halaman data_barang dengan pesan sukses
        $_SESSION['message'] = "Data barang berhasil dihapus.";
        header('Location: ../../daftar_barang.php');
        exit();
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi error
        mysqli_rollback($conn);

         // Simpan pesan error ke sesi dan redirect ke data_barang.php dengan membawa id_barang_pemda
         $_SESSION['error'] = $e->getMessage();
         header("Location: ../../daftar_barang.php?id_barang_pemda=$id_barang_pemda");
         exit();
     }
 } else {
     // Jika id_barang_pemda tidak ditemukan, redirect dengan pesan error
     $_SESSION['error'] = "ID data_barang tidak ditemukan.";
     header('Location: ../../daftar_barang.php');
     exit();
 }
 ?>
