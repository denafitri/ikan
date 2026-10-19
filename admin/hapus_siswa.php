<?php
include 'koneksi.php';

if(isset($_GET['id_siswa'])){
    $id = intval($_GET['id_siswa']);
    $sql = "DELETE FROM tb_siswa WHERE id_siswa=$id";
    if(mysqli_query($koneksi, $sql)){
        echo "<script>alert('Data berhasil dihapus!');window.location.href='tb_siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal hapus: ".mysqli_error($koneksi)."');window.location.href='tb_siswa.php';</script>";
    }
} else {
    echo "<script>alert('ID siswa tidak ditemukan!');window.location.href='tb_siswa.php';</script>";
}

mysqli_close($koneksi);
?>
