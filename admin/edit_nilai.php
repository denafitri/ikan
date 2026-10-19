<?php
include "koneksi.php";

// --- Ambil data berdasarkan id (sanitasi dan cek) ---
if (isset($_GET['id'])) {
    // sanitasi (asumsikan id numerik; jika non-numeric, ganti sanitasi sesuai kebutuhan)
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $result = mysqli_query($koneksi, "SELECT * FROM tb_nilai WHERE id_nilai='$id' LIMIT 1");

    if ($result && mysqli_num_rows($result) > 0) {
        $row_nilai = mysqli_fetch_assoc($result);
    } else {
        // kalau data nggak ada, balik ke daftar
        echo "<script>alert('Data nilai tidak ditemukan.'); window.location='tb_nilai.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID nilai tidak disertakan.'); window.location='tb_nilai.php';</script>";
    exit;
}

// --- Ambil data siswa & mapel diampu (cek error) ---
$siswa = mysqli_query($koneksi, "SELECT id_siswa, nama FROM tb_siswa");
$ampu  = mysqli_query($koneksi, "SELECT * FROM tb_ampu");

// --- Proses update ---
if (isset($_POST['update'])) {
    $id_nilai    = mysqli_real_escape_string($koneksi, $_POST['id_nilai']);
    $id_siswa    = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
    $id_ampu     = mysqli_real_escape_string($koneksi, $_POST['id_ampu']);
    $semester    = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $nilai_tugas = floatval($_POST['nilai_tugas']);
    $nilai_uts   = floatval($_POST['nilai_uts']);
    $nilai_akhir = ($nilai_tugas + $nilai_uts) / 2;

    $sql = "UPDATE tb_nilai SET 
                id_siswa='". $id_siswa ."',
                id_ampu='". $id_ampu ."',
                semester='". $semester ."',
                nilai_tugas='". $nilai_tugas ."',
                nilai_uts='". $nilai_uts ."',
                nilai_akhir='". $nilai_akhir ."'
            WHERE id_nilai='". $id_nilai ."'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='tb_nilai.php';</script>";
        exit;
    } else {
        echo "Error update: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Nilai</title>
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
  <div class="brand">~ Data Nilai ~</div>
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


<h2>~ Edit Data Nilai ~</h2>
  <div style="text-align:center;">
    <a href="tb_nilai.php" class="link-back">← Kembali</a>
  </div>
<form method="POST">
  <input type="hidden" name="id_nilai" value="<?= htmlspecialchars($row_nilai['id_nilai']); ?>">

  <label for="id_siswa">Siswa</label>
  <select id="id_siswa" name="id_siswa" required>
    <?php
    if ($siswa && mysqli_num_rows($siswa) > 0) {
        // set pointer kembali? not necessary here
        while ($row_siswa = mysqli_fetch_assoc($siswa)) {
            $sel = ($row_nilai['id_siswa'] == $row_siswa['id_siswa']) ? 'selected' : '';
            echo '<option value="'.htmlspecialchars($row_siswa['id_siswa']).'" '.$sel.'>'.htmlspecialchars($row_siswa['nama']).'</option>';
        }
    } else {
        echo '<option value="">-- Tidak ada data siswa --</option>';
    }
    ?>
  </select>

  <label for="id_ampu">Mapel Diampu</label>
  <select id="id_ampu" name="id_ampu" required>
    <?php
    if ($ampu && mysqli_num_rows($ampu) > 0) {
        while ($row_ampu = mysqli_fetch_assoc($ampu)) {
            // fallback kolom id (id_ampu atau id)
            $val_id = $row_ampu['id_ampu'] ?? ($row_ampu['id'] ?? '');
            // buat label informatif: mapel - guru jika tersedia
            $label_parts = [];
            if (!empty($row_ampu['nama_mapel'])) $label_parts[] = $row_ampu['nama_mapel'];
            elseif (!empty($row_ampu['mapel'])) $label_parts[] = $row_ampu['mapel'];

            if (!empty($row_ampu['nama_guru'])) $label_parts[] = $row_ampu['nama_guru'];
            elseif (!empty($row_ampu['guru'])) $label_parts[] = $row_ampu['guru'];

            $label = $label_parts ? implode(' - ', $label_parts) : ($val_id ?: '[data tidak lengkap]');

            // tampilkan option (skip jika id kosong)
            if ($val_id === '') continue;
            $sel = ($row_nilai['id_ampu'] == $val_id) ? 'selected' : '';
            echo '<option value="'.htmlspecialchars($val_id).'" '.$sel.'>'.htmlspecialchars($label).'</option>';
        }
    } else {
        echo '<option value="">-- Tidak ada data mapel diampu --</option>';
    }
    ?>
  </select>

  <label for="semester">Semester</label>
  <input type="text" name="semester" value="<?= htmlspecialchars($row_nilai['semester']); ?>" required>

  <label for="nilai_tugas">Nilai Tugas</label>
  <input type="number" name="nilai_tugas" value="<?= htmlspecialchars($row_nilai['nilai_tugas']); ?>" required>

  <label for="nilai_uts">Nilai UTS</label>
  <input type="number" name="nilai_uts" value="<?= htmlspecialchars($row_nilai['nilai_uts']); ?>" required>

  <button type="submit" name="update">Simpan Perubahan</button>
</form>


</body>
</html>
