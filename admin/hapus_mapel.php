<?php
include 'koneksi.php';

if (isset($_GET['id_pelajaran'])) {
    $id = intval($_GET['id_pelajaran']);
    $sql = "DELETE FROM tb_mapel WHERE id_pelajaran = $id";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='tb_mapel.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}

mysqli_close($koneksi);
?>
