<?php
include 'koneksi.php';

// Cek apakah ada nip di URL
if (isset($_GET['nip'])) {
    $nip = mysqli_real_escape_string($koneksi, $_GET['nip']); // amankan input

    // Query hapus data dari tabel tb_guru
    $sql = "DELETE FROM tb_guru WHERE nip = '$nip'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        // Kalau berhasil, kembali ke halaman daftar guru
        header("Location: tb_guru.php?status=success");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "NIP tidak ditemukan di URL!";
}
?>
