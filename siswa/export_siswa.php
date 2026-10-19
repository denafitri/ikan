<?php
include 'koneksi.php';

// header untuk Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Siswa.doc");

// ambil data
$sql = "SELECT * FROM tb_siswa";
$result = mysqli_query($koneksi, $sql);

// mulai isi Word
echo "<html>";
echo "<head><meta charset='UTF-8'></head>";
echo "<body style='font-family:Tahoma, sans-serif;'>";

// Judul
echo "<h2 style='text-align:center; color:#85555d;'>Laporan Data Siswa</h2>";

// Table dengan style rapih
echo "<table border='1' cellspacing='0' cellpadding='6' width='100%' 
        style='border-collapse:collapse; table-layout:fixed; font-size:13px;'>";

echo "<tr style='background:#edcaff; color:#000; text-align:center; font-weight:bold;'>
        <th style='width:60px;'>ID</th>
        <th style='width:100px;'>NISN</th>
        <th style='width:150px;'>Nama</th>
        <th style='width:80px;'>JK</th>
        <th style='width:120px;'>Tanggal Lahir</th>
        <th style='width:200px;'>Alamat</th>
        <th style='width:100px;'>No HP</th>
        <th style='width:80px;'>ID Kelas</th>
        <th style='width:80px;'>Foto</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr style='background:#fffafc;'>";
        echo "<td>".$row['id_siswa']."</td>";
        echo "<td>".$row['nisn']."</td>";
        echo "<td>".$row['nama']."</td>";
        echo "<td>".$row['jenis_kelamin']."</td>";
        echo "<td>".$row['tanggal_lahir']."</td>";
        echo "<td>".$row['alamat']."</td>";
        echo "<td>".$row['no_hp']."</td>";
        echo "<td>".$row['id_kelas']."</td>";
       // FOTO kecil (langsung set width & height)
    echo "<td style='text-align:center;'>
            <img src='".$row['foto']."' width='60' height='60'>
          </td>";
    echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' style='text-align:center;'>Tidak ada data siswa</td></tr>";
}

echo "</table>";
echo "</body></html>";

mysqli_close($koneksi);
?>
