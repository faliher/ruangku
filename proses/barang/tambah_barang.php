<?php
session_start();
include('../../koneksi/koneksi.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize POST data
    $id_barang_pemda = $_POST['id_barang_pemda'];
    $nama_barang = $_POST['nama_barang'];
    $no_regristrasi = $_POST['no_regristrasi'];
    $kode_pemilik = $_POST['kode_pemilik'];
    $kode_barang = $_POST['kode_barang'];
    $id_ruang_asal = $_POST['id_ruang_sekarang'];
    $nama_ruang_asal = $_POST['nama_ruang_sekarang'];
    $bidang_ruang_asal = $_POST['bidang_ruang_sekarang'];
    $tempat_ruang_asal = $_POST['tempat_ruang_sekarang'];
    $id_ruang_sekarang = $_POST['id_ruang_sekarang'];
    $nama_ruang_sekarang = $_POST['nama_ruang_sekarang'];
    $bidang_ruang_sekarang = $_POST['bidang_ruang_sekarang'];
    $tempat_ruang_sekarang = $_POST['tempat_ruang_sekarang'];
    $tgl_pembelian = $_POST['tgl_pembelian'];
    $tgl_pembukuan = $_POST['tgl_pembelian'];
    $merk = $_POST['merk'];
    $type = $_POST['type'];
    $ukuran_CC = $_POST['ukuran_CC'];
    $no_pabrik = $_POST['no_pabrik'];
    $no_rangka = $_POST['no_rangka'];
    $no_bpkb = $_POST['no_bpkb'];
    $bahan = $_POST['bahan'];
    $no_mesin = $_POST['no_mesin'];
    $no_polisi = $_POST['no_polisi'];
    $kondisi_barang = $_POST['kondisi_barang'];
    $masa_manfaat = $_POST['masa_manfaat'];
    $harga_awal = $_POST['harga_awal'];
    $harga_total = $_POST['harga_total'];
    if (empty($harga_total)) {
        $harga_total = 0; // atau bisa juga null jika kolom mendukung NULL
    }
    $keterangan = $_POST['keterangan'];
    $kategori = $_POST['kategori'] ?? null;

    // Handle file upload
    $file_name = null;
    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto_barang']['tmp_name'];
        $file_name = basename($_FILES['foto_barang']['name']);
        $upload_dir = '../../images/';
        if (!move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $_SESSION['error'] = 'Gagal mengunggah foto barang.';
            header('Location: ../../frm_tambah_barang.php');
            exit();
        }
    }

    // adm
    $no_sk = $_POST['no_sk'];
    $tgl_sk = $_POST['tgl_sk'];
    $sk = $_POST['sk'];
    $kwitansi = $_POST['kwitansi'];
    $bast = $_POST['bast'];
    $sttb = $_POST['sttb'];

    mysqli_begin_transaction($conn);
    try {
        $insert_barang_sql = "INSERT INTO data_barang (
            id_barang_pemda, kode_barang, nama_barang, no_regristrasi, kode_pemilik, 
            id_ruang_asal, nama_ruang_asal, bidang_ruang_asal, tempat_ruang_asal, 
            id_ruang_sekarang, nama_ruang_sekarang, bidang_ruang_sekarang, tempat_ruang_sekarang, 
            tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, 
            no_rangka, no_bpkb, bahan, no_mesin, no_polisi, masa_stnk, masa_no_polisi, tgl_bayar_stnk, tgl_bayar_no_polisi, status_stnk, status_no_polisi, pengguna, kondisi_barang, masa_manfaat, 
            harga_awal, harga_total, keterangan, foto_barang
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

        $stmt1 = mysqli_prepare($conn, $insert_barang_sql);
        mysqli_stmt_bind_param(
            $stmt1,
            "ssssssssssssssssssssssssssssssssssssss",
            $id_barang_pemda,
            $kode_barang,
            $nama_barang,
            $no_regristrasi,
            $kode_pemilik,
            $id_ruang_asal,
            $nama_ruang_asal,
            $bidang_ruang_asal,
            $tempat_ruang_asal,
            $id_ruang_sekarang,
            $nama_ruang_sekarang,
            $bidang_ruang_sekarang,
            $tempat_ruang_sekarang,
            $tgl_pembelian,
            $tgl_pembukuan,
            $merk,
            $type,
            $kategori,
            $ukuran_CC,
            $no_pabrik,
            $no_rangka,
            $no_bpkb,
            $bahan,
            $no_mesin,
            $no_polisi,
            $masa_stnk,
            $masa_no_polisi,
            $tgl_bayar_stnk,
            $tgl_bayar_no_polisi,
            $status_stnk,
            $status_no_polisi,
            $pengguna,
            $kondisi_barang,
            $masa_manfaat,
            $harga_awal,
            $harga_total,
            $keterangan,
            $file_name
        );
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);

        $insert_adm_kibb = "INSERT INTO adm_pengadaan_kibb (
            id_barang_pemda, no_sk, tgl_sk, sk, kwitansi, bast, sttb ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt2 = mysqli_prepare($conn, $insert_adm_kibb);
        mysqli_stmt_bind_param(
            $stmt2,
            "sssssss",
            $id_barang_pemda,
            $no_sk,
            $tgl_sk,
            $sk,
            $kwitansi,
            $bast,
            $sttb
        );

        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);

        $insert_adm_penghapusan = "INSERT INTO adm_penghapusan (
            id_barang_pemda, no_sk, tgl_sk, sk) VALUES (?, ?, ?, ?)";

        $stmt3 = mysqli_prepare($conn, $insert_adm_penghapusan);
        mysqli_stmt_bind_param(
            $stmt3,
            "ssss",
            $id_barang_pemda,
            $no_sk,
            $tgl_sk,
            $sk
        );

        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);

        // Commit Transaksi
        mysqli_commit($conn);

        $_SESSION['success'] = 'Data berhasil disimpan!';
        header('Location: ../../daftar_barang.php');
        exit();
    } catch (Exception $e) {
        // Rollback jika terjadi error
        mysqli_rollback($conn);

        $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        header('Location: ../../frm_tambah_barang.php');
        exit();
    }
}
