<?php
include 'koneksi.php';

// Query gabungan supaya tampil nama siswa, kelas, dan mapel (bukan ID)
$sql = "SELECT n.id_nilai,
               s.nama AS nama_siswa,
               k.nama_kelas,
               m.nama_pelajaran,
               n.semester,
               n.nilai_tugas,
               n.nilai_uts,
               n.nilai_akhir
        FROM tb_nilai n
        JOIN tb_siswa s ON n.id_siswa = s.id_siswa
        JOIN tb_ampu a ON n.id_ampu = a.id
        JOIN tb_kelas k ON s.id_kelas = k.id_kelas
        JOIN tb_mapel m ON a.id_pelajaran = m.id_pelajaran
        ORDER BY n.id_nilai DESC";

$data = mysqli_query($koneksi, $sql);

// Jika query gagal, tampilkan error (opsional: bisa dihapus)
if ($data === false) {
    die("Query error: " . mysqli_error($koneksi));
}

// Cek parameter error
$error_message = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'add':
            $error_message = '❌ Gagal menambahkan data nilai!';
            break;
        case 'edit':
            $error_message = '❌ Gagal memperbarui data nilai!';
            break;
        case 'delete':
            $error_message = '❌ Gagal menghapus data nilai!';
            break;
    }
}

// Cek parameter success dari URL
$success_message = '';
if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'add':
            $success_message = '✅ Data nilai berhasil ditambahkan!';
            break;
        case 'edit':
            $success_message = '✏️ Data nilai berhasil diperbarui!';
            break;
        case 'delete':
            $success_message = '🗑️ Data nilai berhasil dihapus!';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tabel Nilai</title>
  <style>
:root{
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
}
.navbar .brand {
  font-weight: 700;
  font-size: 18px;
}
.navbar nav ul {
  display: flex;
  gap: 12px;
  list-style: none;
  margin: 0;
  padding: 0;
}
.navbar nav a {
  padding: 8px 14px;
  border-radius: 10px;
  transition: all 0.25s ease-in-out;
  color: #fff;
  font-weight: 600;
}
.navbar nav a:hover {
  background: var(--primary-2);
}
.tombol_login {
  background: var(--accent);
  padding: 8px 14px;
  border-radius: 10px;
  font-weight: bold;
  color: #fff;
  text-decoration: none;
  transition: all 0.25s ease-in-out;
}
.tombol_login:hover {
  background: var(--primary-2);
  box-shadow: 0 0 10px rgba(255,200,150,0.7);
}

/* Search box */
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
  box-shadow: 0 0 12px rgba(200,150,255,0.6);
  transform: translateY(-2px);
}
.search-box input::placeholder {
  color: var(--muted);
  font-style: italic;
}

/* Table card */
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
tr:nth-child(even) { background: rgba(255,255,255,0.3); }
tr:hover td { background: #69484e5e; }

/* Aksi buttons */
.aksi a {
  padding: 6px 12px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  font-size: 13px;
  margin-right: 5px;
  transition: all 0.25s ease-in-out;
  display: inline-block;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}
.aksi a.edit {
  background-color: #ac0c79ff;
  color: #fff;
}
.aksi a.edit:hover {
  background-color: #2980b9;
  transform: translateY(-2px);
}
.aksi a.hapus {
  background-color: #611444ff;
  color: #fff;
}
.aksi a.hapus:hover {
  background-color: #c51616ff;
  transform: translateY(-2px);
}

/* Tambah button */
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
  box-shadow: 0 0 12px rgba(200,150,255,0.6);
}

/* Bunga jatuh */
.butterfly {
  position: fixed;
  font-size: var(--size, 20px);
  animation: fall linear infinite;
  z-index: -1;
  opacity: 0.85;
}
@keyframes fall {
  0% { transform: translateY(-10vh) translateX(0) rotate(0); opacity: 0; }
  10% { opacity: 1; }
  100% { transform: translateY(110vh) translateX(var(--x,0)) rotate(var(--rEnd,360deg)); opacity: 0; }
}

/* Custom Alert Styles */
.custom-alert {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  z-index: 1000;
  justify-content: center;
  align-items: center;
}

.alert-content {
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  text-align: center;
  max-width: 400px;
  width: 90%;
  animation: alertPop 0.3s ease-out;
}

@keyframes alertPop {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.alert-buttons {
  margin-top: 20px;
  display: flex;
  gap: 10px;
  justify-content: center;
}

.alert-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  transition: all 0.3s ease;
}

.alert-btn.confirm {
  background: #e74c3c;
  color: white;
}

.alert-btn.confirm:hover {
  background: #c0392b;
  transform: translateY(-2px);
}

.alert-btn.cancel {
  background: #95a5a6;
  color: white;
}

.alert-btn.cancel:hover {
  background: #7f8c8d;
  transform: translateY(-2px);
}

/* Success/Error Notification */
.notification {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 15px 25px;
  border-radius: 10px;
  color: white;
  font-weight: bold;
  z-index: 1001;
  animation: slideIn 0.5s ease-out, slideOut 0.5s ease-in 2.5s forwards;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.notification.success {
  background: linear-gradient(135deg, #2ecc71, #27ae60);
}

.notification.error {
  background: linear-gradient(135deg, #e74c3c, #c0392b);
}

@keyframes slideIn {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOut {
  from { transform: translateX(0); opacity: 1; }
  to { transform: translateX(100%); opacity: 0; }
}
  </style>
</head>
<body>

<!-- Notifikasi Success/Error -->
<?php if ($success_message): ?>
<div class="notification success" id="successNotification">
  <?php echo $success_message; ?>
</div>
<?php endif; ?>

<?php if ($error_message): ?>
<div class="notification error" id="errorNotification">
  <?php echo $error_message; ?>
</div>
<?php endif; ?>

<div class="navbar">
    <div class="brand">Data Nilai</div>
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
  <a href="export_nilai.php" class="add-btn">⬇️ Export ke Word</a>
</div>

<h1>Tabel Nilai</h1>

<!-- Search -->
<div class="search-box">
  <input type="text" id="searchInput" placeholder="🔍 Cari nilai...">
</div>

<!-- Custom Alert untuk Hapus -->
<div class="custom-alert" id="customAlert">
  <div class="alert-content">
    <h3 style="margin:0 0 15px 0; color:#e74c3c;">⚠️ Konfirmasi Hapus</h3>
    <p style="margin:0; font-size:16px; line-height:1.5;" id="alertMessage">Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan!</p>
    <div class="alert-buttons">
      <button class="alert-btn cancel" onclick="hideAlert()">Batal</button>
      <button class="alert-btn confirm" onclick="confirmDelete()">Ya, Hapus</button>
    </div>
  </div>
</div>

<!-- Card tabel -->
<div class="table-card">
  <table id="nilaiTable">
    <tr>
      <th>ID Nilai</th>
      <th>Nama Siswa</th>
      <th>Kelas</th>
      <th>Mata Pelajaran</th>
      <th>Semester</th>
      <th>Nilai Tugas</th>
      <th>Nilai UTS</th>
      <th>Nilai Akhir</th>
    
    </tr>
    <?php while($d = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?php echo $d['id_nilai']; ?></td>
      <td><?php echo htmlspecialchars($d['nama_siswa']); ?></td>
      <td><?php echo htmlspecialchars($d['nama_kelas']); ?></td>
      <td><?php echo htmlspecialchars($d['nama_pelajaran']); ?></td>
      <td><?php echo $d['semester']; ?></td>
      <td><?php echo $d['nilai_tugas']; ?></td>
      <td><?php echo $d['nilai_uts']; ?></td>
      <td><?php echo $d['nilai_akhir']; ?></td>
   
    </tr>
    <?php } ?>
  </table>
</div>


<script>
  // Variabel global untuk menyimpan ID yang akan dihapus
  let deleteId = null;
  let deleteUrl = null;

  // Fungsi untuk menampilkan alert custom
  function showDeleteAlert(id, siswaNama, semester) {
    deleteId = id;
    deleteUrl = `hapus_nilai.php?id=${id}`;

    // Set pesan alert yang lebih informatif
    document.getElementById('alertMessage').innerHTML =
      `Yakin ingin menghapus nilai untuk:<br>
       <strong>Siswa: ${siswaNama}</strong><br>
       <strong>Semester: ${semester}</strong><br><br>
       Tindakan ini tidak dapat dibatalkan!`;

    // Tampilkan alert custom
    document.getElementById('customAlert').style.display = 'flex';
  }

  // Fungsi untuk menyembunyikan alert
  function hideAlert() {
    document.getElementById('customAlert').style.display = 'none';
    deleteId = null;
    deleteUrl = null;
  }

  // Fungsi konfirmasi hapus
  function confirmDelete() {
    if (deleteUrl) {
      // Tampilkan alert konfirmasi akhir sebelum benar-benar menghapus
      if (confirm('⚠️ DATA AKAN DIHAPUS PERMANEN!\nKlik OK untuk melanjutkan atau Cancel untuk membatalkan.')) {
        window.location.href = deleteUrl;
      }
    }
    hideAlert();
  }

  // Tutup alert ketika klik di luar area alert
  document.getElementById('customAlert').addEventListener('click', function(e) {
    if (e.target === this) {
      hideAlert();
    }
  });

  // Animasi bunga
  for (let i = 0; i < 25; i++) {
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

  // Fitur search
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#nilaiTable tr");
    rows.forEach((row, index) => {
      if (index === 0) return;
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });

  // Auto-hide notifikasi setelah 3 detik
  setTimeout(() => {
    const notifications = document.querySelectorAll('.notification');
    notifications.forEach(notification => {
      if (notification) {
        notification.style.display = 'none';
      }
    });
  }, 3000);

  // Konfirmasi sebelum meninggalkan halaman edit/tambah (opsional)
  window.addEventListener('beforeunload', function(e) {
    const forms = document.querySelectorAll('form');
    let hasUnsavedData = false;

    forms.forEach(form => {
      if (form.querySelector('input[value], textarea[value]')) {
        hasUnsavedData = true;
      }
    });

    if (hasUnsavedData) {
      e.preventDefault();
      e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
    }
  });
</script>

<?php mysqli_close($koneksi); ?>
</body>
</html>
