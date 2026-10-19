<?php
include 'koneksi.php';

$aksi = $_GET['aksi'] ?? '';

if ($aksi == "tambah") {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id_berita = $_POST['id_berita'];
        $judul     = $_POST['judul'];
        $isi       = $_POST['isi'];
        $tanggal   = $_POST['tanggal_post'];
        $id_guru   = $_POST['id_guru'];

        mysqli_query($koneksi, "INSERT INTO tb_berita (id_berita, judul, isi, tanggal_post, id_guru) 
                                VALUES ('$id_berita','$judul','$isi','$tanggal','$id_guru')");

        header("Location: tb_berita.php");
        exit;
    }
} elseif ($aksi == "hapus") {
    $id = $_GET['id'] ?? '';
    if (!empty($id)) {
        mysqli_query($koneksi, "DELETE FROM tb_berita WHERE id_berita='$id'");
    }
    header("Location: tb_berita.php");
    exit;
}
?>
