<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id_siswa = $_POST['id_siswa'];
$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$id_kelas = $_POST['id_kelas'];
$foto = $_POST['foto'];
 
// menginput data ke database
mysqli_query($conn,"insert into tb_siswa values
('$id_siswa','$nisn','$nama','$jenis_kelamin','$tanggal_lahir','$alamat','$no_hp','$id_kelas','$foto')");
 
// mengalihkan halaman kembali ke index.php
header("location:tbsiswa.php");
 
?>