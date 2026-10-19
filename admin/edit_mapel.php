<?php
include 'koneksi.php';

// Ambil data mapel berdasarkan id_pelajaran
if (isset($_GET['id_pelajaran'])) {
    $id_pelajaran = $_GET['id_pelajaran'];
    $result = mysqli_query($koneksi, "SELECT * FROM tb_mapel WHERE id_pelajaran='$id_pelajaran'");
    $row = mysqli_fetch_assoc($result);
}

// Proses update
if (isset($_POST['update'])) {
    $id_pelajaran   = $_POST['id_pelajaran'];
    $nama_pelajaran = $_POST['nama_pelajaran'];
    $kategori       = $_POST['kategori'];
    $id_siswa       = $_POST['id_siswa'];
    $id_guru        = $_POST['id_guru'];

    $sql = "UPDATE tb_mapel 
            SET nama_pelajaran='$nama_pelajaran',
                kategori='$kategori',
                id_siswa='$id_siswa',
                id_guru='$id_guru'
            WHERE id_pelajaran='$id_pelajaran'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='tb_mapel.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Mata Pelajaran</title>
 <style>
:root {
  --bg: linear-gradient(135deg, #edcaff, #ffe4f1);
  --surface: #ffffff;
  --surface-2: #fbe8ef;
  --text: #2c2c34;
  --muted: #7a7a8c;
  --primary: #b9747f;
  --primary-dark: #91485a;
  --accent: #ff9eb3;
  --border: rgba(0,0,0,0.12);
  --ring: rgba(185,116,127,0.35);
  --shadow: 0 8px 25px rgba(0,0,0,0.1);
  --radius: 16px;
}

body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  color: var(--text);
  background: var(--bg);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px 20px;
}

h2 {
  text-align: center;
  color: var(--primary-dark);
  font-size: 22px;
  margin-bottom: 20px;
  letter-spacing: 1px;
}

a {
  text-decoration: none;
  color: var(--primary);
  font-weight: 600;
  margin: 10px 0;
  display: inline-block;
  transition: 0.3s;
}
a:hover {
  color: var(--accent);
  transform: translateX(-3px);
}

form {
  background: var(--surface);
  padding: 30px 35px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  border: 1px solid var(--border);
  width: 100%;
  max-width: 480px;
  display: flex;
  flex-direction: column;
  gap: 18px;
  animation: fadeIn 0.7s ease-in-out;
}

label {
  font-weight: 600;
  color: var(--primary-dark);
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
select {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid var(--border);
  border-radius: var(--radius);
  background: var(--surface-2);
  outline: none;
  transition: 0.25s;
  font-size: 14px;
}

input:focus,
select:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--ring);
  background: #fff;
}

button, input[type="submit"] {
  background: var(--primary);
  color: #fff;
  border: none;
  padding: 12px;
  border-radius: var(--radius);
  cursor: pointer;
  font-size: 15px;
  font-weight: 600;
  transition: 0.25s;
}

button:hover, input[type="submit"]:hover {
  background: var(--primary-dark);
  transform: translateY(-2px);
}

/* Animasi */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Navbar */
.navbar {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto 30px auto;
  padding: 14px 22px;
  background: var(--primary);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #fff;
  flex-wrap: wrap;
  animation: fadeIn 0.8s ease-in-out;
}

.navbar .brand {
  font-weight: 700;
  font-size: 20px;
  letter-spacing: 1px;
}

.navbar nav ul {
  display: flex;
  gap: 15px;
  list-style: none;
  margin: 0;
  padding: 0;
  flex-wrap: wrap;
}

.navbar nav a {
  padding: 8px 14px;
  border-radius: 10px;
  transition: 0.3s;
  color: #fff;
  font-weight: 600;
}

.navbar nav a:hover {
  background: var(--primary-dark);
  transform: translateY(-2px);
}
</style>
</head>
<body>
 <div class="navbar">
  <div class="brand">~ Data Mapel ~</div>
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

<h1>~ Edit Data Mapel ~</h1>
  <div style="text-align:center;">
    <a href="tb_mapel.php" class="link-back">← Kembali</a>
  </div>
<div class="form-card">
  <form method="POST">
    <label>ID Pelajaran</label>
    <input type="text" name="id_pelajaran" value="<?= $row['id_pelajaran'] ?>" readonly>

    <label>Nama Pelajaran</label>
    <input type="text" name="nama_pelajaran" value="<?= $row['nama_pelajaran'] ?>">

    <label>Kategori</label>
    <input type="text" name="kategori" value="<?= $row['kategori'] ?>">

    <label for="id_siswa">ID Siswa</label>
    <select id="id_siswa" name="id_siswa">
        <?php 
        $siswa = mysqli_query($koneksi,"SELECT * FROM tb_siswa");
        while($row_siswa = mysqli_fetch_array($siswa)){
            $selected = ($row['id_siswa'] == $row_siswa['id_siswa']) ? "selected" : "";
            echo "<option value='".$row_siswa['id_siswa']."' $selected>".$row_siswa['nama']."</option>";
        }
        ?>
    </select>

    <label for="id_guru">ID Guru</label>
    <select id="id_guru" name="id_guru">
        <?php 
        $guru = mysqli_query($koneksi,"SELECT * FROM tb_guru");
        while($row_guru = mysqli_fetch_array($guru)){
            $selected = ($row['id_guru'] == $row_guru['id_guru']) ? "selected" : "";
            echo "<option value='".$row_guru['id_guru']."' $selected>".$row_guru['nama']."</option>";
        }
        ?>
    </select>

    <button type="submit" name="update" class="btn">Update</button>
  </form>

</div>
</body>
</html>
<?php mysqli_close($koneksi); ?>
