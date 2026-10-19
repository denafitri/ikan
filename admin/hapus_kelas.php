<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_profiljurusan_syifa");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM tb_kelas WHERE id_kelas = $id";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='tb_kelas.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}

mysqli_close($koneksi);
?>
