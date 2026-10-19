<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    // Cek duplikat email
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE email='$email'");
    if(mysqli_num_rows($cek) > 0){
        header("Location: tb_guru.php?error=email");
        exit;
    }

    // Insert data
    $sql = "INSERT INTO tb_guru (nip, nama, jenis_kelamin, email, no_hp) VALUES ('$nip', '$nama', '$jenis_kelamin', '$email', '$no_hp')";
    if(mysqli_query($koneksi, $sql)){
        // Redirect ke tb_guru.php dengan notifikasi sukses
        header("Location: tb_guru.php?success=1");
        exit;
    } else {
        header("Location: tb_guru.php?error=insert");
        exit;
    }
}
?>
