<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kelas   = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $tingkat    = $_POST['tingkat'];

    $sql = "INSERT INTO tb_kelas (id_kelas, nama_kelas, tingkat) 
            VALUES ('$id_kelas', '$nama_kelas', '$tingkat')";

    if (mysqli_query($koneksi, $sql)) {
        // kalau berhasil simpan → balik ke tb_kelas.php
        header("Location: tb_kelas.php?status=success");
        exit;
    } else {
        // kalau gagal simpan
        header("Location: tb_kelas.php?status=error");
        exit;
    }
} else {
    header("Location: tambah_kelas.php");
    exit;
}
