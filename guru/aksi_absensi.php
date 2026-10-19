<?php
include 'koneksi.php';

// Ambil aksi baik dari GET maupun POST
$aksi = $_POST['aksi'] ?? ($_GET['aksi'] ?? '');

if ($aksi == "tambah") {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Ambil data dari form
        $id_siswa   = $_POST['id_siswa'];
        $id_kelas   = $_POST['id_kelas'];
        $tanggal    = $_POST['tanggal'];
        $status     = $_POST['status'];

        // Query insert tanpa id_absensi (biar AUTO_INCREMENT jalan otomatis)
        $query = "INSERT INTO tb_absensi (id_siswa, id_kelas, tanggal, status) 
                  VALUES ('$id_siswa','$id_kelas','$tanggal','$status')";
        $simpan = mysqli_query($koneksi, $query);

        if ($simpan) {
            header("Location: tb_absensi.php");
            exit;
        } else {
            echo "Error simpan: " . mysqli_error($koneksi);
        }
    }
} elseif ($aksi == "edit") {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Ambil data dari form edit
        $id_absensi = $_POST['id_absensi'];
        $id_siswa   = $_POST['id_siswa'];
        $id_kelas   = $_POST['id_kelas'];
        $tanggal    = $_POST['tanggal'];
        $status     = $_POST['status'];

        // Query update
        $query = "UPDATE tb_absensi SET 
                  id_siswa = '$id_siswa', 
                  id_kelas = '$id_kelas', 
                  tanggal = '$tanggal', 
                  status = '$status' 
                  WHERE id_absensi = '$id_absensi'";
        $update = mysqli_query($koneksi, $query);

        if ($update) {
            header("Location: tb_absensi.php");
            exit;
        } else {
            echo "Error update: " . mysqli_error($koneksi);
        }
    }
} elseif ($aksi == "hapus") {
    $id = $_GET['id'] ?? '';
    if ($id != '') {
        $query = mysqli_query($koneksi, "DELETE FROM tb_absensi WHERE id_absensi='$id'");
        if ($query) {
            header("Location: tb_absensi.php");
            exit;
        } else {
            echo "Error hapus: " . mysqli_error($koneksi);
        }
    } else {
        header("Location: tb_absensi.php");
        exit;
    }
}
?>