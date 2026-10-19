<?php
include 'koneksi.php';

// Cek jika ada pesan sukses hapus
$pesan = "";
if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_hapus') {
    $pesan = '<div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                ✅ Data absensi berhasil dihapus!
              </div>';
}

// Query untuk mengambil data absensi
$data = mysqli_query($koneksi, "SELECT * FROM tb_absensi");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tabel Absensi</title>
  <style>
:root {
  --bg:        #edcaffff;
  --surface:   #a9727b50;
  --surface-2: #85555dff;
  --text:      #2c2c34;
  --muted:     #7a7a8c;
  --putih:     #ffffffff;
  --primary:   #85555dff;
  --primary-2: #000000ff;
  --accent:    #d9a066;
  --border:    rgba(0,0,0,0.15);
  --ring:      rgba(184,107,119,0.35);
  --shadow:    0 6px 20px rgba(0,0,0,.08);
  --radius:    14px;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
  color: var(--text);
  background: linear-gradient(135deg, #ffdde1, #ee9ca7, #c8b6ff);
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
  animation: fadeIn 0.6s ease-in;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}

h1 {
  margin: 20px 0;
  color: var(--primary-2);
  text-align: center;
  font-size: 28px;
  font-weight: 800;
  letter-spacing: 1px;
  text-shadow: 2px 2px 5px rgba(0,0,0,0.15);
}

/* Navbar */
.navbar {
  width: 100%;
  max-width: 1000px;
  margin-bottom: 20px;
  padding: 12px 18px;
  background: var(--primary);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #fff;
  transition: background 0.3s ease, box-shadow 0.3s ease;
}
.navbar:hover {
  background: #6e3f47;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
}
.navbar .brand { font-weight: 700; font-size: 18px; }
.navbar nav ul {
  display: flex; gap: 12px; list-style: none; margin: 0; padding: 0;
}
.navbar nav a {
  padding: 8px 14px;
  border-radius: 10px;
  transition: all 0.25s ease-in-out;
  color: #fff;
  font-weight: 600;
}
.navbar nav a:hover { background: var(--primary-2); }

/* Card */
.table-card {
  background: var(--surface);
  padding: 20px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  border: 1px solid var(--border);
  width: 100%;
  max-width: 1000px;
  overflow-x: auto;
  transition: transform 0.2s ease;
}
.table-card:hover { transform: translateY(-2px); }

table { width: 100%; border-collapse: collapse; }
th, td {
  padding: 12px 14px;
  border-bottom: 1px solid var(--border);
  text-align: left;
}
th {
  background: var(--primary);
  color: var(--putih);
  font-weight: 700;
}
th:first-child { border-top-left-radius: var(--radius); }
th:last-child  { border-top-right-radius: var(--radius); }

tr { transition: background 0.3s ease; }
tr:nth-child(even) { background: rgba(255, 255, 255, 0.3); }
tr:hover td { background: #69484e5e; }

/* Tombol Edit Hapus */
.aksi a {
  padding: 6px 12px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.25s ease-in-out;
  display: inline-block;
  font-size: 13px;
  margin-right: 5px;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}
.aksi a.edit {
  background-color: #ac0c79ff;
  color: #fff;
}
.aksi a.edit:hover {
  background-color: #2980b9;
  transform: translateY(-2px);
  box-shadow: 0 0 10px rgba(173, 216, 230, 0.7);
}
.aksi a.hapus {
  background-color: #611444ff;
  color: #fff;
}
.aksi a.hapus:hover {
  background-color: #c51616ff;
  transform: translateY(-2px);
  box-shadow: 0 0 10px rgba(255, 150, 150, 0.7);
}

/* Tombol tambah */
.add-btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #9b59b6;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-weight: bold;
  margin-top: 15px;
  transition: all 0.25s ease-in-out;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}
.add-btn:hover {
  background-color: #7d3cb5;
  transform: translateY(-2px);
  box-shadow: 0 0 12px rgba(200, 150, 255, 0.6);
}

/* Tombol logout */
.tombol_login {
  background: var(--accent);
  padding: 8px 14px;
  border-radius: 10px;
  font-weight: bold;
  transition: all 0.25s ease-in-out;
  color: #fff;
  text-decoration: none;
}
.tombol_login:hover {
  background: var(--primary-2);
  box-shadow: 0 0 10px rgba(255, 200, 150, 0.7);
  transform: translateY(-2px);
}

/* Search */
.search-box {
  width: 100%;
  max-width: 1000px;
  text-align: right;
  margin-bottom: 12px;
}
.search-box input {
  padding: 10px 14px;
  border-radius: 8px;
  border: 2px solid var(--primary);
  outline: none;
  width: 250px;
  font-size: 14px;
  transition: all 0.25s ease-in-out;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}
.search-box input:focus {
  border-color: var(--accent);
  box-shadow: 0 0 12px rgba(200, 150, 255, 0.6);
  transform: translateY(-2px);
}
.search-box input::placeholder {
  color: var(--muted);
  font-style: italic;
}

/* Animasi bunga */
.butterfly {
  position: fixed;
  font-size: var(--size, 20px);
  animation: fall linear infinite;
  z-index: -1;
  pointer-events: none;
  opacity: 0.85;
  transform: rotate(var(--r, 0deg));
}
@keyframes fall {
  0% { transform: translateY(-10vh) translateX(0) rotate(0deg); opacity: 0; }
  10% { opacity: 1; }
  100% { transform: translateY(110vh) translateX(var(--x, 0)) rotate(var(--rEnd, 360deg)); opacity: 0; }
}

/* Pesan notifikasi */
.pesan {
  width: 100%;
  max-width: 1000px;
  margin-bottom: 15px;
  animation: slideDown 0.5s ease-out;
}
@keyframes slideDown {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}
  </style>
</head>
<body>
<div class="navbar">
  <div class="brand">Data Absensi</div>
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
   
      <a href="../logout.php" class="tombol_login">Logout</a>
    </ul>
  </nav>
</div>

<div style="width:100%; max-width:1000px; text-align:right; margin-top:10px;">
  <a href="export_absensi.php" class="add-btn">⬇️ Export ke Word</a>
</div>
<h1>Tabel Absensi</h1>

<!-- Tampilkan pesan sukses -->
<?php if(!empty($pesan)): ?>
<div class="pesan">
  <?php echo $pesan; ?>
</div>
<?php endif; ?>

<!-- Search box -->
<div class="search-box">
  <input type="text" id="searchInput" placeholder="🔍 Cari absensi...">
</div>

<div class="table-card">
  <table id="absensiTable">
    <tr>
      <th>ID Absensi</th>
      <th>ID Siswa</th>
      <th>ID Kelas</th>
      <th>Tanggal</th>
      <th>Status</th>
    
    </tr>
    <?php 
    if(mysqli_num_rows($data) > 0) {
        while($row = mysqli_fetch_array($data)) { 
    ?>
    <tr>
      <td><?= $row['id_absensi']; ?></td>
      <td><?= $row['id_siswa']; ?></td>
      <td><?= $row['id_kelas']; ?></td>
      <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
      <td>
        <span style="padding: 4px 8px; border-radius: 4px; 
          <?php 
          if($row['status'] == 'Hadir') echo 'background: #d4edda; color: #155724;';
          elseif($row['status'] == 'Izin') echo 'background: #fff3cd; color: #856404;';
          elseif($row['status'] == 'Sakit') echo 'background: #d1ecf1; color: #0c5460;';
          else echo 'background: #f8d7da; color: #721c24;';
          ?>
        ">
          <?= $row['status']; ?>
        </span>
      </td>
    
    </tr>
    <?php 
        }
    } else { 
    ?>
    <tr>
      <td colspan="6" style="text-align: center; padding: 20px;">
        Tidak ada data absensi
      </td>
    </tr>
    <?php } ?>
  </table>
</div>



<script>
  // Bunga jatuh
  for (let i = 0; i < 30; i++) {
    let flower = document.createElement("div");
    flower.className = "butterfly";
    flower.textContent = "🌸"; 
    flower.style.left = Math.random() * 100 + "vw";
    flower.style.setProperty("--size", (10 + Math.random() * 20) + "px");
    flower.style.animationDuration = (5 + Math.random() * 7) + "s";
    flower.style.setProperty("--x", (Math.random() * 200 - 100) + "px");
    flower.style.setProperty("--rEnd", (Math.random() * 720 - 360) + "deg");
    document.body.appendChild(flower);
  }

  // Search
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#absensiTable tr");

    rows.forEach((row, index) => {
      if (index === 0) return;
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });
</script>
</body>
</html>
<?php mysqli_close($koneksi); ?>