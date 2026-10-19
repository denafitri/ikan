<?php
include 'koneksi.php';

// header untuk Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Nilai.doc");

// ambil data
$sql = "SELECT * FROM tb_nilai";
$result = mysqli_query($koneksi, $sql);

// mulai isi Word
echo "<html>";
echo "<head><meta charset='UTF-8'></head>";
echo "<body style='font-family:Tahoma, sans-serif;'>";

// Judul
echo "<h2 style='text-align:center; color:#6a3f63;'>Laporan Data Nilai</h2>";

// Table dengan style rapih
echo "<table border='1' cellspacing='0' cellpadding='6' width='100%' 
        style='border-collapse:collapse; table-layout:fixed; font-size:13px;'>";

echo "<tr style='background:#edcaff; color:#000; text-align:center; font-weight:bold;'>
        <th style='width:80px;'>ID Nilai</th>
        <th style='width:100px;'>ID Siswa</th>
        <th style='width:100px;'>ID Ampu</th>
        <th style='width:100px;'>Semester</th>
        <th style='width:120px;'>Nilai Tugas</th>
        <th style='width:120px;'>Nilai UTS</th>
        <th style='width:120px;'>Nilai Akhir</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr style='background:#fff9fc;'>";
        echo "<td>".$row['id_nilai']."</td>";
        echo "<td>".$row['id_siswa']."</td>";
        echo "<td>".$row['id_ampu']."</td>";
        echo "<td>".$row['semester']."</td>";
        echo "<td>".$row['nilai_tugas']."</td>";
        echo "<td>".$row['nilai_uts']."</td>";
        echo "<td>".$row['nilai_akhir']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data nilai</td></tr>";
}

echo "</table>";
echo "</body></html>";

mysqli_close($koneksi);
?>
