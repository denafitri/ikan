<?php
include 'koneksi.php';

$id_siswa = $_POST['id_siswa'];
$id_ampu = $_POST['id_ampu'];
$semester = $_POST['semester'];
$nilai_tugas = $_POST['nilai_tugas'];
$nilai_uts = $_POST['nilai_uts'];
$nilai_akhir = ($nilai_tugas+$nilai_uts)/2;

mysqli_query($koneksi, "INSERT INTO tb_nilai (id_siswa, id_ampu, semester, nilai_tugas, nilai_uts, nilai_akhir) 
VALUES ('$id_siswa', '$id_ampu', '$semester', '$nilai_tugas', '$nilai_uts', '$nilai_akhir')");

header("Location: tb_nilai.php");
?>
