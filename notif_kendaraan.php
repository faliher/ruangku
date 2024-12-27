<?php
include('koneksi/koneksi.php');
require 'vendor/autoload.php'; // Jika menggunakan PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$query = "SELECT *
          FROM data_barang 
          WHERE status_stnk = 'Belum Lunas'";
$result = mysqli_query($conn, $query);

$query_no_polisi = "SELECT *
          FROM data_barang 
          WHERE status_no_polisi = 'Tidak Aktif'";
$result_no_polisi = mysqli_query($conn, $query_no_polisi);

$query_admin = "SELECT username FROM admin"; // Pastikan kolom 'username' adalah email admin
$result_admin = mysqli_query($conn, $query_admin);

// Validasi hasil query
if (mysqli_num_rows($result_admin) > 0) {
    // Ambil semua email admin
    $admin_emails = [];
    while ($row_admin = mysqli_fetch_assoc($result_admin)) {
        $admin_emails[] = $row_admin['username']; // Simpan email admin dalam array
    }
} else {
    echo "Gagal mendapatkan email admin.\n";
    exit; // Keluar jika email admin tidak ditemukan
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id_barang = $row['id_barang_pemda'];
        $nama_barang = $row['nama_barang'];
        $masa_stnk = $row['masa_stnk'];
        $merk = $row['merk'];
        $no_polisi = $row['no_polisi'];

        // Hitung sisa hari
        $tanggal_sekarang = new DateTime();
        $tanggal_masa_stnk = new DateTime($masa_stnk);
        $selisih_hari = $tanggal_sekarang->diff($tanggal_masa_stnk)->days;

        // Periksa apakah notifikasi perlu dikirim
        if (in_array($selisih_hari, [30, 8, 7, 6, 5, 4, 3, 2, 1])) {
            // Buat pesan
            $subject = '(H-' . $selisih_hari . ') ' . 'Perpanjangan STNK';

            // Kirim email
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Server SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'brebesdinkominfotik@gmail.com'; // Ganti dengan email Anda
                $mail->Password = 'rzbf xcwp wxoh njsk'; // Ganti dengan App Password Anda
                $mail->SMTPSecure = 'tls'; // Gunakan TLS
                $mail->Port = 587; // Port SMTP untuk TLS

                // Recipients - Kirim email ke semua admin
                $mail->setFrom('brebesdinkominfotik@gmail.com', 'Ruangku - Notifikasi STNK');
                foreach ($admin_emails as $email_admin) {
                    $mail->addAddress($email_admin); // Tambahkan setiap email admin
                }

                // Content
                $mail->isHTML(true); // Format HTML
                $mail->Subject = $subject;
                $mail->Body = '
                    <h3>Pengingat Perpanjangan STNK</h3>
                    <table cellpadding="5" cellspacing="0" style="border: 1px solid #ddd; border-collapse: collapse;">
                        <tr>
                            <td style="width: 150px; font-weight: bold;">ID</td>
                            <td style="width: 20px;">:</td>
                            <td>' . $id_barang . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Nama</td>
                            <td>:</td>
                            <td>' . $nama_barang . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Merk</td>
                            <td>:</td>
                            <td>' . $merk . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">No Polisi</td>
                            <td>:</td>
                            <td>' . $no_polisi . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Masa Berlaku</td>
                            <td>:</td>
                            <td>' . $masa_stnk . '</td>
                        </tr>
                    </table>
                    <p>Segera lakukan pembayaran pajak sebelum habis masa berlaku.</p>
                    <p>Note : Setelah melakukan pembayaran harap mengisi bukti pembayaran di Ruangku.</p>
                ';

                $mail->send();
            } catch (Exception $e) {
            }
        }
    }
}

if (mysqli_num_rows($result_no_polisi) > 0) {
    while ($row_no_polisi = mysqli_fetch_assoc($result_no_polisi)) {
        $id_barang = $row_no_polisi['id_barang_pemda'];
        $nama_barang = $row_no_polisi['nama_barang'];
        $masa_stnk = $row_no_polisi['masa_no_polisi']; // Pastikan ini kolom yang benar
        $merk = $row_no_polisi['merk'];
        $no_polisi = $row_no_polisi['no_polisi'];

        // Hitung sisa hari
        $tanggal_sekarang = new DateTime();
        $tanggal_masa_stnk = new DateTime($masa_stnk);
        $selisih_hari = $tanggal_sekarang->diff($tanggal_masa_stnk)->days;

        // Periksa apakah notifikasi perlu dikirim
        if (in_array($selisih_hari, [30, 7, 6, 5, 4, 3, 2, 1])) {
            // Buat pesan
            $subject = '(H-' . $selisih_hari . ') ' . 'Perpanjangan No Polisi Kendaraan';

            // Kirim email
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Server SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'brebesdinkominfotik@gmail.com'; // Ganti dengan email Anda
                $mail->Password = 'rzbf xcwp wxoh njsk'; // Ganti dengan App Password Anda
                $mail->SMTPSecure = 'tls'; // Gunakan TLS
                $mail->Port = 587; // Port SMTP untuk TLS

                // Recipients - Kirim email ke semua admin
                $mail->setFrom('brebesdinkominfotik@gmail.com', 'Ruangku - Notifikasi Perpanjangan No Polisi');
                foreach ($admin_emails as $email_admin) {
                    $mail->addAddress($email_admin); // Tambahkan setiap email admin
                }

                // Content
                $mail->isHTML(true); // Format HTML
                $mail->Subject = $subject;
                $mail->Body = '
                    <h3>Pengingat Perpanjangan No Polisi</h3>
                    <table cellpadding="5" cellspacing="0" style="border: 1px solid #ddd; border-collapse: collapse;">
                        <tr>
                            <td style="width: 150px; font-weight: bold;">ID Pemda</td>
                            <td style="width: 20px;">:</td>
                            <td>' . $id_barang . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Nama</td>
                            <td>:</td>
                            <td>' . $nama_barang . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Merk</td>
                            <td>:</td>
                            <td>' . $merk . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">No Polisi</td>
                            <td>:</td>
                            <td>' . $no_polisi . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Masa Berlaku</td>
                            <td>:</td>
                            <td>' . $masa_stnk . '</td>
                        </tr>
                    </table>
                    <p>Segera lakukan perpanjangan sebelum habis masa berlaku.</p>
                    <p>Note : Setelah melakukan pembayaran harap mengisi bukti pembayaran di Ruangku.</p>
                ';

                // Kirim email
                $mail->send();
            } catch (Exception $e) {
            }
        }
    }
}
