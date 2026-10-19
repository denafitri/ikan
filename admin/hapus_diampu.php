<?php
include 'koneksi.php';

// Pastikan parameter id dikirim
if(isset($_GET['id'])){
    $id = intval($_GET['id']); // ambil id sebagai integer
    $delete = mysqli_query($koneksi, "DELETE FROM tb_ampu WHERE id=$id");

    if($delete){
        echo "<script>alert('Data berhasil dihapus!');window.location.href='tb_ampu.php';</script>";
    } else {
        echo "Error: ".mysqli_error($koneksi);
    }
} else {
    echo "<script>alert('ID diampu tidak ditemukan!');window.location.href='tb_ampu.php';</script>";
}
?>
