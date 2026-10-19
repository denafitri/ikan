<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM tb_nilai WHERE id_nilai='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: tb_nilai.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>