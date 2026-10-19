<?php
include 'koneksi.php';

// ambil id dari URL
if(!isset($_GET['id'])){
    echo "<script>alert('ID tidak ditemukan!');window.location.href='tb_pengguna.php';</script>";
    exit;
}
$id = $_GET['id'];

// ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna='$id'");
$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "<script>alert('Data tidak ditemukan!');window.location.href='tb_pengguna.php';</script>";
    exit;
}

// proses update
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    $update = mysqli_query($koneksi, "UPDATE pengguna SET 
                    nama='$nama', user='$user', pass='$pass', role='$role'
                    WHERE id_pengguna='$id'");
    if($update){
        echo "<script>alert('Data berhasil diupdate!');window.location.href='tb_pengguna.php';</script>";
    } else {
        echo "Error: ".mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Pengguna</title>
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
  <div class="brand">~ Data Pengguna ~</div>
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

<h2>~ Edit Data Pengguna ~</h2>
  <div style="text-align:center;">
    <a href="tb_pengguna.php" class="link-back">← Kembali</a>
  </div>
<form method="POST">
  <label>Nama:</label>
  <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

  <label>Username:</label>
  <input type="text" name="user" value="<?= $data['user']; ?>" required>

  <label>Password:</label>
  <input type="text" name="pass" value="<?= $data['pass']; ?>" required>

  <label>Role:</label>
  <select name="role" required>
    <option value="siswa" <?= $data['role']=='siswa'?'selected':''; ?>>Siswa</option>
    <option value="guru" <?= $data['role']=='guru'?'selected':''; ?>>Guru</option>
    <option value="admin" <?= $data['role']=='admin'?'selected':''; ?>>Admin</option>
  </select>

  <button type="submit" name="simpan">Simpan Perubahan</button>
</form>


</body>
</html>
<?php mysqli_close($koneksi); ?>
