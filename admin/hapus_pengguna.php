<?php
include 'koneksi.php';

if(!isset($_GET['id'])){
    echo "<script>alert('ID tidak ditemukan!');window.location.href='tb_pengguna.php';</script>";
    exit;
}

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna='$id'");

if($hapus){
    echo "<script>alert('Data berhasil dihapus!');window.location.href='tb_pengguna.php';</script>";
} else {
    echo "Error: ".mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>
