<?php
include 'koneksi.php';

// header untuk Word
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Data_Berita.doc");

// ambil data
$sql = "SELECT * FROM tb_berita";
$result = mysqli_query($koneksi, $sql);

// mulai isi Word
echo "<html>";
echo "<head><meta charset='UTF-8'></head>";
echo "<body style='font-family:Tahoma, sans-serif;'>";

// Judul
echo "<h2 style='text-align:center; color:#6a3f63;'>Laporan Data Berita</h2>";

// Table dengan style rapih
echo "<table border='1' cellspacing='0' cellpadding='6' width='100%' 
        style='border-collapse:collapse; table-layout:fixed; font-size:13px;'>";

// ambil nama kolom secara dinamis
$fields = mysqli_fetch_fields($result);
echo "<tr style='background:#edcaff; color:#000; text-align:center; font-weight:bold;'>";
foreach ($fields as $field) {
    echo "<th>".$field->name."</th>";
}
echo "</tr>";

// isi data
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr style='background:#fff9fc;'>";
        foreach ($row as $data) {
            echo "<td>".$data."</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='".count($fields)."' style='text-align:center;'>Tidak ada data berita</td></tr>";
}

echo "</table>";
echo "</body></html>";

mysqli_close($koneksi);
?>
