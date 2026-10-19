<?php
include 'koneksi.php';

// Ambil data guru, mapel, dan kelas
$guru_query  = mysqli_query($koneksi, "SELECT id_guru, nama FROM tb_guru ORDER BY nama ASC");
$mapel_query = mysqli_query($koneksi, "SELECT id_pelajaran, nama_pelajaran FROM tb_mapel ORDER BY nama_pelajaran ASC");
$kelas_query = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM tb_kelas ORDER BY nama_kelas ASC");

if(isset($_POST['submit'])){
    $id_guru      = $_POST['id_guru'];
    $id_pelajaran = $_POST['id_pelajaran'];
    $id_kelas     = $_POST['id_kelas'];

    $sql = "INSERT INTO tb_ampu (id_guru, id_pelajaran, id_kelas)
            VALUES ('$id_guru', '$id_pelajaran', '$id_kelas')";

    if(mysqli_query($koneksi, $sql)){
        echo "<script>alert('Data berhasil ditambahkan!');window.location.href='tb_ampu.php';</script>";
    } else {
        echo "Error: ".mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Diampu</title>
    <style>
:root {
    --bg: #edcaffff;             /* soft pastel pink */
    --surface: #ffffff;         /* form background */
    --surface-2: #ffe4f1;       /* input background */
    --text: #3a2c34;
    --muted: #8c7a8c;
    --primary: linear-gradient(135deg, #d18ca6, #b9747f); /* navbar gradient */
    --primary-2: #b46a86;      /* navbar hover */
    --kembali: #a34c7d;
    --accent: #f9c2a6;
    --border: rgba(0,0,0,0.08);
    --ring: rgba(209,140,166,0.3);
    --shadow: 0 12px 30px rgba(0,0,0,0.1);
    --radius: 20px;
    --font: 'Comic Sans MS', cursive, sans-serif;
}

body {
    margin: 0;
    font-family: var(--font);
    color: var(--text);
    background: var(--bg);
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Navbar */
.navbar {
    width: 100%;
    max-width: 1200px;
    margin-bottom: 30px;
    padding: 14px 20px;
    background: var(--primary);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.navbar nav ul {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.navbar nav a {
    padding: 8px 14px;
    border-radius: 14px;
    transition: all 0.3s;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    background: rgba(255,255,255,0.1);
}
.navbar nav a:hover {
    background: rgba(255,255,255,0.25);
    transform: scale(1.1);
}

/* Card */
.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

h1 {
    margin: 15px 0;
    color: #d18ca6;
    text-align: center;
    font-size: 32px;
    letter-spacing: 1px;
    background: linear-gradient(90deg, #d67097ff, #d18ca6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

a {
    text-decoration: none;
    color: var(--kembali);
    font-weight: bold;
    margin: 12px 0;
    display: inline-block;
    transition: all 0.3s;
}
a:hover {
    color: var(--accent);
    transform: scale(1.05);
}

/* Form */
form {
    background: var(--surface);
    padding: 45px 50px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    width: 100%;
    max-width: 500px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}
form:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

label {
    font-weight: 600;
    margin-bottom: 4px;
    font-size: 15px;
}

input[type="text"], input[type="email"], select {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface-2);
    outline: none;
    transition: all 0.3s;
    font-size: 15px;
}
input:focus, select:focus {
    border-color: #f9c2a6;
    box-shadow: 0 0 0 4px rgba(249,194,166,0.4);
    background: #fff;
}

/* Button */
button, input[type="submit"] {
    background: linear-gradient(135deg, #a34c7d, #f9c2a6);
    color: #fff;
    border: none;
    padding: 14px;
    border-radius: var(--radius);
    cursor: pointer;
    font-size: 16px;
    font-weight: 700;
    transition: all 0.3s;
}
button:hover, input[type="submit"]:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
</style>
</head>
<body>

<div class="navbar">
  <div class="brand">~ Data ampu ~</div>
   <nav>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="tb_guru.php">Guru</a></li>
        <li><a href="tb_siswa.php">Siswa</a></li>
        <li><a href="tb_mapel.php">Mapel</a></li>
        <li><a href="tb_nilai.php">Nilai</a></li>
        <li><a href="tb_kelas.php">Kelas</a></li>
        <li><a href="tb_absensi.php">Absensi</a></li>
        <li><a href="tb_ampu.php">Ampu</a></li>
        <li><a href="tb_berita.php">Berita</a></li>
        <li><a href="tb_pengguna.php">Pengguna</a></li>
        <li><a href="../logout.php" class="tombol_login">Logout</a></li>
      </ul>
    </nav>
</div> 

<h1>Tambah Data Diampu</h1>
 <div style="text-align:center;">
    <a href="tb_ampu.php" class="link-back">← Kembali</a>
  </div>
<div class="form-card">
<form method="POST">
    <label>Guru</label>
    <select name="id_guru" required>
        <option value="">-- Pilih Guru --</option>
        <?php while($guru = mysqli_fetch_assoc($guru_query)){ ?>
            <option value="<?= $guru['id_guru']; ?>"><?= $guru['nama']; ?></option>
        <?php } ?>
    </select>

    <label>Mata Pelajaran</label>
    <select name="id_pelajaran" required>
        <option value="">-- Pilih Mapel --</option>
        <?php while($mapel = mysqli_fetch_assoc($mapel_query)){ ?>
            <option value="<?= $mapel['id_pelajaran']; ?>"><?= $mapel['nama_pelajaran']; ?></option>
        <?php } ?>
    </select>

    <label>Kelas</label>
    <select name="id_kelas" required>
        <option value="">-- Pilih Kelas --</option>
        <?php while($kelas = mysqli_fetch_assoc($kelas_query)){ ?>
            <option value="<?= $kelas['id_kelas']; ?>"><?= $kelas['nama_kelas']; ?></option>
        <?php } ?>
    </select>

    <button type="submit" name="submit">Simpan</button>
</form>

</div>
</body>
</html>
