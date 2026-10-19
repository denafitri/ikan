<?php
include "koneksi.php";

// Ambil data siswa berdasarkan id_siswa
if (isset($_GET['id_siswa'])) {
    $id_siswa = intval($_GET['id_siswa']);
    $result = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_siswa='$id_siswa'");
    $row_siswa = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('ID siswa tidak ditemukan!'); window.location='tb_siswa.php';</script>";
    exit;
}

// Ambil data kelas untuk select option
$kelas_query = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM tb_kelas ORDER BY nama_kelas ASC");

// Proses update data
if (isset($_POST['update'])) {
    $nisn           = $_POST['nisn'];
    $nama           = $_POST['nama'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];
    $no_hp          = $_POST['no_hp'];
    $id_kelas       = $_POST['id_kelas'];
    $foto           = $_POST['foto'];

    $sql = "UPDATE tb_siswa SET 
                nisn='$nisn',
                nama='$nama',
                jenis_kelamin='$jenis_kelamin',
                tanggal_lahir='$tanggal_lahir',
                alamat='$alamat',
                no_hp='$no_hp',
                id_kelas='$id_kelas',
                foto='$foto'
            WHERE id_siswa='$id_siswa'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data siswa berhasil diupdate!'); window.location='tb_siswa.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Siswa</title>
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
input[type="number"],
input[type="email"],
input[type="date"],
input[type="url"],
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

.navbar nav li {
  display: inline-block;
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

.tombol_login {
  background: var(--accent);
  padding: 8px 16px;
  border-radius: 10px;
  color: #fff;
  font-weight: 600;
}

.tombol_login:hover {
  background: #ff7a95;
}
</style>
</head>
<body>
  <div class="navbar">
    <div class="brand">~ Data Siswa ~</div>
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

<div class="container">
  <h2>~ Edit Data Siswa ~</h2>
  <div style="text-align:center;">
    <a href="tb_siswa.php" class="link-back">← Kembali</a>
  </div>

  <form method="POST">
    <label for="nisn">NISN:</label>
    <input type="text" id="nisn" name="nisn" value="<?= $row_siswa['nisn']; ?>" required>

    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?= $row_siswa['nama']; ?>" required>

    <label for="jenis_kelamin">Jenis Kelamin:</label>
    <select id="jenis_kelamin" name="jenis_kelamin" required>
      <option value="Laki-laki" <?= ($row_siswa['jenis_kelamin']=='Laki-laki')?'selected':''; ?>>Laki-Laki</option>
      <option value="Perempuan" <?= ($row_siswa['jenis_kelamin']=='Perempuan')?'selected':''; ?>>Perempuan</option>
    </select>

    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= $row_siswa['tanggal_lahir']; ?>" required>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat" value="<?= $row_siswa['alamat']; ?>" required>

    <label for="no_hp">No HP:</label>
    <input type="text" id="no_hp" name="no_hp" value="<?= $row_siswa['no_hp']; ?>" required>

    <label for="id_kelas">Kelas:</label>
    <select id="id_kelas" name="id_kelas" required>
      <option value="">-- Pilih Kelas --</option>
      <?php
      if(mysqli_num_rows($kelas_query) > 0){
          while($kelas = mysqli_fetch_assoc($kelas_query)){
              $selected = $row_siswa['id_kelas']==$kelas['id_kelas']?'selected':'';
              echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['nama_kelas']}</option>";
          }
      }
      ?>
    </select>

    <label for="foto">Link Foto:</label>
    <input type="url" id="foto" name="foto" value="<?= $row_siswa['foto']; ?>" placeholder="Masukkan link foto">

    <button type="submit" name="update">Update Siswa</button>
  </form>
</div>
</body>
</html>
