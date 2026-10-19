<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelajaran   = $_POST['id_pelajaran'];
    $nama_pelajaran = $_POST['nama_pelajaran'];
    $kategori       = $_POST['kategori'];
    $id_siswa       = $_POST['id_siswa'];
    $id_guru        = $_POST['id_guru'];

    // Query insert
    $sql = "INSERT INTO tb_mapel (id_pelajaran, nama_pelajaran, kategori, id_siswa, id_guru) 
            VALUES ('$id_pelajaran', '$nama_pelajaran', '$kategori', '$id_siswa', '$id_guru')";

    if (mysqli_query($koneksi, $sql)) {
        // kalau sukses → redirect + status
        header("Location: tb_mapel.php?status=success");
        exit;
    } else {
        // kalau gagal → redirect + status
        header("Location: tb_mapel.php?status=error");
        exit;
    }
} else {
    header("Location: tambah_mapel.php");
    exit;
}
