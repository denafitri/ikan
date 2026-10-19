<?php
include 'koneksi.php';

// validasi id
if (!isset($_GET['id'])) {
    echo "ID absensi tidak ditemukan.";
    exit;
}
$id = intval($_GET['id']);

// ambil data absensi
$data = mysqli_query($koneksi, "SELECT * FROM tb_absensi WHERE id_absensi='$id'");
if (!$data || mysqli_num_rows($data) == 0) {
    echo "Data absensi tidak ditemukan.";
    exit;
}
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Absensi</title>
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
  <div class="brand">~ Data Absensi ~</div>
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
<h2>~ Edit Data Absensi ~</h2>
  <div style="text-align:center;">
    <a href="tb_absensi.php" class="link-back">← Kembali</a>
  </div>
<form action="aksi_absensi.php" method="post" class="form-card">
  <input type="hidden" name="aksi" value="edit">
  <input type="hidden" name="id_absensi" value="<?php echo htmlspecialchars($row['id_absensi']); ?>">

  <label for="id_siswa">Siswa:</label>
  <select name="id_siswa" id="id_siswa" required>
    <?php
    $siswa = mysqli_query($koneksi,"SELECT id_siswa, nama FROM tb_siswa");
    while($s = mysqli_fetch_assoc($siswa)){
        $sel = ($row['id_siswa'] == $s['id_siswa']) ? ' selected="selected"' : '';
        echo '<option value="'.htmlspecialchars($s['id_siswa']).'"'.$sel.'>'.htmlspecialchars($s['nama']).'</option>';
    }
    ?>
  </select>

  <label for="id_kelas">Kelas:</label>
  <select name="id_kelas" id="id_kelas" required>
    <?php
    // pastikan tb_kelas punya kolom nama_kelas dan tingkat
    $kelas = mysqli_query($koneksi,"SELECT id_kelas, nama_kelas, tingkat FROM tb_kelas");
    while($k = mysqli_fetch_assoc($kelas)){
        $sel = ($row['id_kelas'] == $k['id_kelas']) ? ' selected="selected"' : '';
        $label = $k['nama_kelas'];
        if (isset($k['tingkat']) && $k['tingkat'] !== '') {
            $label .= ' (Tingkat '.$k['tingkat'].')';
        }
        echo '<option value="'.htmlspecialchars($k['id_kelas']).'"'.$sel.'>'.htmlspecialchars($label).'</option>';
    }
    ?>
  </select>

  <label for="tanggal">Tanggal:</label>
  <input type="date" name="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>

<label for="status">Status:</label>
<select name="status" id="status" required>
  <?php
  $statuses = ['hadir','izin','sakit','alpha'];
  foreach ($statuses as $st) {
      $sel = (strtolower(trim($row['status'])) == $st) ? ' selected="selected"' : '';
      echo '<option value="'.$st.'"'.$sel.'>'.ucfirst($st).'</option>';
  }
  ?>
</select>



  <button type="submit">Update</button>
</form>

</body>
</html>
