<?php
include 'koneksi.php';

// Cek apakah parameter id ada
if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];
    
    // Validasi ID (harus angka)
    if (!is_numeric($id_absensi)) {
        die("ID tidak valid!");
    }
    
    // Query untuk menghapus data
    $query = "DELETE FROM tb_absensi WHERE id_absensi = '$id_absensi'";
    
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil dihapus, redirect ke halaman absensi dengan pesan sukses
        header("Location: tb_absensi.php?pesan=sukses_hapus");
        exit();
    } else {
        // Jika gagal, tampilkan error
        die("Error menghapus data: " . mysqli_error($koneksi));
    }
} else {
    // Jika tidak ada ID, redirect ke halaman absensi
    header("Location: tb_absensi.php");
    exit();
}

// Tutup koneksi
mysqli_close($koneksi);
?>