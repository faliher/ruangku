<?php
session_start();
include('../../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data POST dan file
    $id_barang_pemda = $_POST['id_barang_pemda'];
    $no_surat_mutasi = $_POST['no_surat_mutasi'];
    $tgl_surat_mutasi = $_POST['tgl_surat_mutasi'];
    $alasan_mutasi = $_POST['alasan_mutasi'];
    $nama_skpd_asal = $_POST['nama_skpd_asal'];
    $ruang_asal = $_POST['ruang_asal'];
    $pj = $_POST['pj'];

    $upload_dir = '../../assets/upload/pindah_skpd/masuk/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $surat_mutasi = '';
    if (!empty($_FILES['surat_mutasi']['name'])) {
        $surat_mutasi = basename($_FILES['surat_mutasi']['name']);
        move_uploaded_file($_FILES['surat_mutasi']['tmp_name'], $upload_dir . $surat_mutasi);
    }

    $bast = '';
    if (!empty($_FILES['bast']['name'])) {
        $bast = basename($_FILES['bast']['name']);
        move_uploaded_file($_FILES['bast']['tmp_name'], $upload_dir . $bast);
    }

    $dokumen_lainnya = '';
    if (!empty($_FILES['dokumen_lainnya']['name'])) {
        $dokumen_lainnya = basename($_FILES['dokumen_lainnya']['name']);
        move_uploaded_file($_FILES['dokumen_lainnya']['tmp_name'], $upload_dir . $dokumen_lainnya);
    }

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
    $kategori = $_POST['kategori'] ?? null;
    $ukuran_CC = $_POST['ukuran_CC'];
    $no_pabrik = $_POST['no_pabrik'];
    $no_rangka = $_POST['no_rangka'];
    $no_bpkb = $_POST['no_bpkb'];
    $bahan = $_POST['bahan'];
    $no_mesin = $_POST['no_mesin'];
    $no_polisi = $_POST['no_polisi'];
    $masa_stnk = !empty($_POST['masa_stnk']) ? $_POST['masa_stnk'] : null;
    $masa_no_polisi = !empty($_POST['masa_no_polisi']) ? $_POST['masa_no_polisi'] : null;
    $tgl_bayar_stnk = !empty($_POST['tgl_bayar_stnk']) ? $_POST['tgl_bayar_stnk'] : null;
    $tgl_bayar_no_polisi = !empty($_POST['tgl_bayar_no_polisi']) ? $_POST['tgl_bayar_no_polisi'] : null;
    $status_stnk = $_POST['status_stnk'];
    $status_no_polisi = $_POST['status_no_polisi'];
    $pengguna = $_POST['pengguna'];
    $kondisi_barang = $_POST['kondisi_barang'];
    $masa_manfaat = $_POST['masa_manfaat'];
    $harga_awal = $_POST['harga_awal'];
    $harga_total = $_POST['harga_total'];
    if (empty($harga_total)) {
        $harga_total = 0;
    }
    $keterangan = $_POST['keterangan'];

    $file_name = null;
    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto_barang']['tmp_name'];
        $file_name = basename($_FILES['foto_barang']['name']);
        $upload_dir = '../../assets/images/';
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

    // Mulai Transaksi
    mysqli_begin_transaction($conn);

    try {
        // Query pertama: INSERT ke tabel pindah_skpd_masuk
        $insert_pindah_skpd = "INSERT INTO pindah_skpd_masuk (
            id_barang_pemda, no_surat_mutasi, tgl_surat_mutasi, surat_mutasi, nama_skpd_asal, ruang_asal, alasan_mutasi, pj, bast, dokumen_lainnya
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt1 = mysqli_prepare($conn, $insert_pindah_skpd);
        mysqli_stmt_bind_param(
            $stmt1,
            "ssssssssss",
            $id_barang_pemda,
            $no_surat_mutasi,
            $tgl_surat_mutasi,
            $surat_mutasi,
            $nama_skpd_asal,
            $ruang_asal,
            $alasan_mutasi,
            $pj,
            $bast,
            $dokumen_lainnya
        );
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);

        // Query kedua: INSERT ke tabel data_barang
        $insert_barang_sql = "INSERT INTO data_barang (
            id_barang_pemda, kode_barang, nama_barang, no_regristrasi, kode_pemilik, 
            id_ruang_asal, nama_ruang_asal, bidang_ruang_asal, tempat_ruang_asal, 
            id_ruang_sekarang, nama_ruang_sekarang, bidang_ruang_sekarang, tempat_ruang_sekarang, 
            tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, 
            no_rangka, no_bpkb, bahan, no_mesin, no_polisi, masa_stnk, masa_no_polisi, tgl_bayar_stnk, tgl_bayar_no_polisi, status_stnk, status_no_polisi, pengguna, kondisi_barang, masa_manfaat, 
            harga_awal, harga_total, keterangan, foto_barang
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

        $stmt2 = mysqli_prepare($conn, $insert_barang_sql);
        mysqli_stmt_bind_param(
            $stmt2,
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
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);

        $insert_adm_kibb = "INSERT INTO adm_pengadaan_kibb (
            id_barang_pemda, no_sk, tgl_sk, sk, kwitansi, bast, sttb ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt3 = mysqli_prepare($conn, $insert_adm_kibb);
        mysqli_stmt_bind_param(
            $stmt3,
            "sssssss",
            $id_barang_pemda,
            $no_sk,
            $tgl_sk,
            $sk,
            $kwitansi,
            $bast,
            $sttb
        );

        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);

        $insert_adm_penghapusan = "INSERT INTO adm_penghapusan (
            id_barang_pemda, no_sk, tgl_sk, sk) VALUES (?, ?, ?, ?)";

        $stmt4 = mysqli_prepare($conn, $insert_adm_penghapusan);
        mysqli_stmt_bind_param(
            $stmt4,
            "ssss",
            $id_barang_pemda,
            $no_sk,
            $tgl_sk,
            $sk
        );

        mysqli_stmt_execute($stmt4);
        mysqli_stmt_close($stmt4);

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
