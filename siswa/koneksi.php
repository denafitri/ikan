<?php
$koneksi = mysqli_connect("localhost", "c6syifakhairun", "Katasandi", "c6syifakha");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
