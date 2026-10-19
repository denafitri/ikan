<?php
include 'koneksi.php';

// header untuk Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Mapel.doc");

// ambil data
$sql = "SELECT * FROM tb_mapel";
$result = mysqli_query($koneksi, $sql);

// mulai isi Word
echo "<html>";
echo "<head><meta charset='UTF-8'></head>";
echo "<body style='font-family:Tahoma, sans-serif;'>";

// Judul
echo "<h2 style='text-align:center; color:#6a3f63;'>Laporan Data Mata Pelajaran</h2>";

// Table dengan style rapih
echo "<table border='1' cellspacing='0' cellpadding='6' width='100%' 
        style='border-collapse:collapse; table-layout:fixed; font-size:13px;'>";

echo "<tr style='background:#edcaff; color:#000; text-align:center; font-weight:bold;'>
        <th style='width:90px;'>ID Pelajaran</th>
        <th style='width:180px;'>Nama Pelajaran</th>
        <th style='width:120px;'>Kategori</th>
        <th style='width:100px;'>ID Siswa</th>
        <th style='width:100px;'>ID Guru</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr style='background:#fff9fc;'>";
        echo "<td>".$row['id_pelajaran']."</td>";
        echo "<td>".$row['nama_pelajaran']."</td>";
        echo "<td>".$row['kategori']."</td>";
        echo "<td>".$row['id_siswa']."</td>";
        echo "<td>".$row['id_guru']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data mapel</td></tr>";
}

echo "</table>";
echo "</body></html>";

mysqli_close($koneksi);
?>
