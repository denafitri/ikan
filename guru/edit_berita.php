<?php
include 'koneksi.php';

if(!isset($_GET['id'])){
    echo "<script>alert('ID berita tidak ditemukan!');window.location.href='tb_berita.php';</script>";
    exit;
}

$id_berita = $_GET['id'];

// Ambil data berita yang akan diedit
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE id_berita='$id_berita'"));

// Ambil daftar guru
$guru_query  = mysqli_query($koneksi, "SELECT id_guru, nama FROM tb_guru ORDER BY nama ASC");

// Cek apakah form disubmit
if(isset($_POST['update'])){
    $judul = $_POST['judul'];
    $Isi   = $_POST['Isi'];
    $id_guru = $_POST['id_guru'];

    $sql = "UPDATE tb_berita SET judul='$judul', Isi='$Isi', id_guru='$id_guru' WHERE id_berita='$id_berita'";
    if(mysqli_query($koneksi, $sql)){
        echo "<script>alert('Berita berhasil diperbarui!');window.location.href='tb_berita.php';</script>";
    } else {
        echo "Error: ".mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Berita</title>
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
  <div class="brand">Data Pengguna</div>
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
<div class="form-card">
    <h2>Edit Berita</h2>
     <h1>Tambah Berita</h1>
     <div style="text-align:center;">
    <a href="tb_berita.php" class="link-back">← Kembali</a>
  </div>
    <form method="POST">
        <label for="judul">Judul Berita:</label>
        <input type="text" name="judul" id="judul" value="<?= htmlspecialchars($data['judul']); ?>" required>

        <label for="Isi">Isi Berita:</label>
        <textarea name="Isi" id="Isi" required><?= htmlspecialchars($data['Isi']); ?></textarea>

        <label>Guru</label>
        <select name="id_guru" required>
            <option value="">-- Pilih Guru --</option>
            <?php while($guru = mysqli_fetch_assoc($guru_query)){ ?>
                <option value="<?= $guru['id_guru']; ?>" <?= ($data['id_guru']==$guru['id_guru']?'selected':''); ?>>
                    <?= $guru['nama']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit" name="update">Update</button>
    </form>
    
</div>

</body>
</html>
<?php mysqli_close($koneksi); ?>
