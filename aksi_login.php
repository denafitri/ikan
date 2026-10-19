<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'admin/koneksi.php';
 
// menangkap data yang dikirim dari form login
$user = $_POST['user'];
$pass = $_POST['pass'];
$role     = $_POST['role'];
 
// menyeleksi data user dengan username, password, dan role
// menyeleksi data user dengan username, password, dan role
$login = mysqli_query($koneksi, "SELECT * FROM pengguna 
    WHERE user='$user' AND pass='$pass' AND role='$role'");

// hitung jumlah baris
$cek = mysqli_num_rows($login);

// cek apakah username dan password ditemukan pada database
if($cek > 0){
    $data = mysqli_fetch_assoc($login);

    // cek role
    if($data['role']=="admin"){
        $_SESSION['user'] = $user;
        $_SESSION['role'] = "admin";
        header("location:admin/home.php");

    } else if($data['role']=="siswa"){
        $_SESSION['user'] = $user;
        $_SESSION['role'] = "siswa";
        header("location:siswa/home.php");

    } else if($data['role']=="guru"){
        $_SESSION['user'] = $user;
        $_SESSION['role'] = "guru"; // tadinya salah tulis "tb_guru"
        header("location:guru/home.php");

    } else {
        header("location:login.php?pesan=gagal");
    }
} else {
    header("location:login.php?pesan=gagal");
}

?>
