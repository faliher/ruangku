<?php
// Koneksi ke database
include('../../koneksi/koneksi.php');

// Ambil ID Barang dari URL
if (isset($_GET['id_barang_pemda'])) {
    $id_barang_pemda = $_GET['id_barang_pemda'];

    // Ambil data barang dari tabel data_barang
    $query_barang = "SELECT * FROM data_barang WHERE id_barang_pemda = '$id_barang_pemda'";
    $result = mysqli_query($conn, $query_barang);

    if (mysqli_num_rows($result) > 0) {
        // Ambil data barang
        $barang = mysqli_fetch_assoc($result);

        // Escape data untuk menghindari karakter spesial dalam SQL
        $id_barang_pemda = mysqli_real_escape_string($conn, $barang['id_barang_pemda']);
        $kode_barang = mysqli_real_escape_string($conn, $barang['kode_barang']);
        $nama_barang = mysqli_real_escape_string($conn, $barang['nama_barang']);
        $no_regristrasi = mysqli_real_escape_string($conn, $barang['no_regristrasi']);
        $kode_pemilik = mysqli_real_escape_string($conn, $barang['kode_pemilik']);
        $id_ruang_asal = mysqli_real_escape_string($conn, $barang['id_ruang_asal']);
        $nama_ruang_asal = mysqli_real_escape_string($conn, $barang['nama_ruang_asal']);
        $bidang_ruang_asal = mysqli_real_escape_string($conn, $barang['bidang_ruang_asal']);
        $tempat_ruang_asal = mysqli_real_escape_string($conn, $barang['tempat_ruang_asal']);
        $id_ruang_sekarang = mysqli_real_escape_string($conn, $barang['id_ruang_sekarang']);
        $nama_ruang_sekarang = mysqli_real_escape_string($conn, $barang['nama_ruang_sekarang']);
        $bidang_ruang_sekarang = mysqli_real_escape_string($conn, $barang['bidang_ruang_sekarang']);
        $tempat_ruang_sekarang = mysqli_real_escape_string($conn, $barang['tempat_ruang_sekarang']);
        $tgl_pembelian = mysqli_real_escape_string($conn, $barang['tgl_pembelian']);
        $tgl_pembukuan = mysqli_real_escape_string($conn, $barang['tgl_pembukuan']);
        $merk = mysqli_real_escape_string($conn, $barang['merk']);
        $type = mysqli_real_escape_string($conn, $barang['type']);
        $kategori = mysqli_real_escape_string($conn, $barang['kategori']);
        $ukuran_CC = mysqli_real_escape_string($conn, $barang['ukuran_CC']);
        $no_pabrik = mysqli_real_escape_string($conn, $barang['no_pabrik']);
        $no_rangka = mysqli_real_escape_string($conn, $barang['no_rangka']);
        $no_bpkb = mysqli_real_escape_string($conn, $barang['no_bpkb']);
        $bahan = mysqli_real_escape_string($conn, $barang['bahan']);
        $no_mesin = mysqli_real_escape_string($conn, $barang['no_mesin']);
        $no_polisi = mysqli_real_escape_string($conn, $barang['no_polisi']);
        $masa_stnk = mysqli_real_escape_string($conn, $barang['masa_stnk']);
        $masa_no_polisi = mysqli_real_escape_string($conn, $barang['masa_no_polisi']);
        $status_stnk = mysqli_real_escape_string($conn, $barang['status_stnk']);
        $status_no_polisi = mysqli_real_escape_string($conn, $barang['status_no_polisi']);
        $tgl_bayar_stnk = mysqli_real_escape_string($conn, $barang['tgl_bayar_stnk']);
        $tgl_bayar_no_polisi = mysqli_real_escape_string($conn, $barang['tgl_bayar_no_polisi']);
        $pengguna = mysqli_real_escape_string($conn, $barang['pengguna']);
        $kondisi_barang = mysqli_real_escape_string($conn, $barang['kondisi_barang']);
        $masa_manfaat = mysqli_real_escape_string($conn, $barang['masa_manfaat']);
        $harga_awal = mysqli_real_escape_string($conn, $barang['harga_awal']);
        $harga_total = mysqli_real_escape_string($conn, $barang['harga_total']);
        $keterangan = mysqli_real_escape_string($conn, $barang['keterangan']);
        $foto_barang = mysqli_real_escape_string($conn, $barang['foto_barang']);

        // Siapkan query untuk memasukkan data ke tabel penghapusan
        $query_insert = "INSERT INTO penghapusan (
            id_barang_pemda, kode_barang, nama_barang, no_regristrasi, kode_pemilik,
            id_ruang_asal, nama_ruang_asal, bidang_ruang_asal, tempat_ruang_asal,
            id_ruang_sekarang, bidang_ruang_sekarang, tempat_ruang_sekarang, tgl_pembelian,
            tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, no_rangka, no_bpkb,
            bahan, no_mesin, no_polisi, masa_stnk, masa_no_polisi, status_stnk, status_no_polisi,
            tgl_bayar_stnk, tgl_bayar_no_polisi, pengguna, kondisi_barang, masa_manfaat,
            harga_awal, harga_total, keterangan, foto_barang, nama_ruang_sekarang
        ) VALUES (
            '$id_barang_pemda', '$kode_barang', '$nama_barang',
            '$no_regristrasi', '$kode_pemilik', '$id_ruang_asal',
            '$nama_ruang_asal', '$bidang_ruang_asal', '$tempat_ruang_asal',
            '$id_ruang_sekarang', '$bidang_ruang_sekarang', '$tempat_ruang_sekarang',
            '$tgl_pembelian', '$tgl_pembukuan', '$merk', '$type',
            '$kategori', '$ukuran_CC', '$no_pabrik', '$no_rangka',
            '$no_bpkb', '$bahan', '$no_mesin', '$no_polisi',
            '$masa_stnk', '$masa_no_polisi', '$status_stnk', '$status_no_polisi',
            '$tgl_bayar_stnk', '$tgl_bayar_no_polisi', '$pengguna', '$kondisi_barang',
            '$masa_manfaat', '$harga_awal', '$harga_total', '$keterangan',
            '$foto_barang', '$nama_ruang_sekarang'
        )";

        // Eksekusi query untuk memasukkan data ke penghapusan
        if (mysqli_query($conn, $query_insert)) {
            // Jika berhasil memasukkan data, hapus data dari tabel data_barang
            $query_delete = "DELETE FROM data_barang WHERE id_barang_pemda = '$id_barang_pemda'";
            if (mysqli_query($conn, $query_delete)) {
                // Redirect atau tampilkan pesan sukses
                echo "<script>alert('Barang berhasil dipindahkan ke penghapusan dan dihapus dari KIB B'); window.location.href='data_barang.php?id_barang_pemda=$id_barang_pemda&tab=administrasi';</script>";
            } else {
                echo "<script>alert('Gagal menghapus data barang dari KIB B'); window.location.href='data_barang.php?id_barang_pemda=$id_barang_pemda&tab=administrasi';</script>";
            }
        } else {
            echo "<script>alert('Gagal memindahkan barang ke penghapusan'); window.location.href='data_barang.php?id_barang_pemda=$id_barang_pemda&tab=administrasi';</script>";
        }
    } else {
        echo "<script>alert('Barang tidak ditemukan'); window.location.href='data_barang.php?id_barang_pemda=$id_barang_pemda&tab=administrasi';</script>";
    }
} else {
    echo "<script>alert('ID barang tidak ditemukan'); window.location.href='data_barang.php?tab=administrasi';</script>";
}

// Tutup koneksi
mysqli_close($conn);
?>
