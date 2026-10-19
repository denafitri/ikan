<?php
include 'koneksi.php';

// Ambil parameter aksi dan id_ampu
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$id   = isset($_GET['id']) ? $_GET['id'] : '';

// Ambil data guru, mapel, kelas untuk dropdown
$guru_query  = mysqli_query($koneksi, "SELECT id_guru, nama FROM tb_guru ORDER BY nama ASC");
$mapel_query = mysqli_query($koneksi, "SELECT id_pelajaran, nama_pelajaran FROM tb_mapel ORDER BY nama_pelajaran ASC");
$kelas_query = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM tb_kelas ORDER BY nama_kelas ASC");

if($aksi == "edit" && $id != ''){
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_diampu WHERE id='$id'"));

    if(isset($_POST['update'])){
        $id_guru      = $_POST['id_guru'];
        $id_pelajaran = $_POST['id_pelajaran'];
        $id_kelas     = $_POST['id_kelas'];

        $sql = "UPDATE tb_diampu 
                SET id_guru='$id_guru', id_pelajaran='$id_pelajaran', id_kelas='$id_kelas' 
                WHERE id='$id'";
        if(mysqli_query($koneksi, $sql)){
            header("Location: tb_diampu.php");
            exit;
        } else {
            echo "Error: ".mysqli_error($koneksi);
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Diampu</title>
        <style>
            body{font-family:Arial;background:#fcefee;padding:20px;text-align:center;}
            .form-card{max-width:400px;margin:auto;background:#fff;padding:20px;border-radius:14px;box-shadow:0 6px 20px rgba(0,0,0,.08);}
            select{width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:8px;}
            button{padding:10px 18px;background:#ac0c79;color:#fff;border:none;border-radius:8px;font-weight:bold;cursor:pointer;}
            button:hover{background:#7a094f;}
        </style>
    </head>
    <body>
    <div class="form-card">
        <h2>Edit Data Diampu</h2>
        <form method="POST">
            <label>Guru</label>
            <select name="id_guru" required>
                <?php while($g = mysqli_fetch_assoc($guru_query)){ ?>
                    <option value="<?= $g['id_guru']; ?>" <?= ($data['id_guru']==$g['id_guru']?'selected':'') ?>><?= $g['nama']; ?></option>
                <?php } ?>
            </select>

            <label>Mata Pelajaran</label>
            <select name="id_pelajaran" required>
                <?php mysqli_data_seek($mapel_query,0); ?>
                <?php while($m = mysqli_fetch_assoc($mapel_query)){ ?>
                    <option value="<?= $m['id_pelajaran']; ?>" <?= ($data['id_pelajaran']==$m['id_pelajaran']?'selected':'') ?>><?= $m['nama_pelajaran']; ?></option>
                <?php } ?>
            </select>

            <label>Kelas</label>
            <select name="id_kelas" required>
                <?php mysqli_data_seek($kelas_query,0); ?>
                <?php while($k = mysqli_fetch_assoc($kelas_query)){ ?>
                    <option value="<?= $k['id_kelas']; ?>" <?= ($data['id_kelas']==$k['id_kelas']?'selected':'') ?>><?= $k['nama_kelas']; ?></option>
                <?php } ?>
            </select>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
    </body>
    </html>
    <?php
} elseif($aksi == "hapus" && $id != ''){
    $sql = "DELETE FROM tb_diampu WHERE id='$id'";
    if(mysqli_query($koneksi, $sql)){
        header("Location: tb_diampu.php");
        exit;
    } else {
        echo "Error: ".mysqli_error($koneksi);
    }
} else {
    echo "Aksi tidak valid!";
}
?>
