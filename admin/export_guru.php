<?php
include 'koneksi.php';

// header untuk Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Guru.doc");

// ambil data
$sql = "SELECT * FROM tb_guru";
$result = mysqli_query($koneksi, $sql);

// mulai isi Word
echo "<html>";
echo "<head><meta charset='UTF-8'></head>";
echo "<body style='font-family:Tahoma, sans-serif;'>";

// Judul
echo "<h2 style='text-align:center; color:#85555d;'>Laporan Data Guru</h2>";

// Table dengan style rapih
echo "<table border='1' cellspacing='0' cellpadding='6' width='100%' 
        style='border-collapse:collapse; table-layout:fixed; font-size:13px;'>";

echo "<tr style='background:#edcaff; color:#000; text-align:center; font-weight:bold;'>
        <th style='width:120px;'>NIP</th>
        <th style='width:180px;'>Nama</th>
        <th style='width:100px;'>Jenis Kelamin</th>
        <th style='width:200px;'>Email</th>
        <th style='width:120px;'>No HP</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr style='background:#fffafc;'>";
        echo "<td>".$row['nip']."</td>";
        echo "<td>".$row['nama']."</td>";
        echo "<td>".$row['jenis_kelamin']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['no_hp']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data guru</td></tr>";
}

echo "</table>";
echo "</body></html>";

mysqli_close($koneksi);
?>
