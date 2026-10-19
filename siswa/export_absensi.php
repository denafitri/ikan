<?php
include 'koneksi.php';

// header untuk Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Absensi.doc");

// ambil data
$sql = "SELECT * FROM tb_absensi";
$result = mysqli_query($koneksi, $sql);

// mulai isi Word
echo "<html>";
echo "<head><meta charset='UTF-8'></head>";
echo "<body style='font-family:Tahoma, sans-serif;'>";

// Judul
echo "<h2 style='text-align:center; color:#6a3f63;'>Laporan Data Absensi</h2>";

// Table dengan style rapih
echo "<table border='1' cellspacing='0' cellpadding='6' width='100%' 
        style='border-collapse:collapse; table-layout:fixed; font-size:13px;'>";

echo "<tr style='background:#edcaff; color:#000; text-align:center; font-weight:bold;'>
        <th style='width:100px;'>ID Absensi</th>
        <th style='width:100px;'>ID Siswa</th>
        <th style='width:100px;'>ID Kelas</th>
        <th style='width:120px;'>Tanggal</th>
        <th style='width:90px;'>Status</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr style='background:#fff9fc;'>";
        echo "<td>".$row['id_absensi']."</td>";
        echo "<td>".$row['id_siswa']."</td>";
        echo "<td>".$row['id_kelas']."</td>";
        echo "<td>".date('d-m-Y', strtotime($row['tanggal']))."</td>";
        echo "<td>".$row['status']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data absensi</td></tr>";
}

echo "</table>";
echo "</body></html>";

mysqli_close($koneksi);
?>
