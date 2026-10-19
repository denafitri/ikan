<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_profiljurusan_syifa");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM tb_kelas";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabel Kelas</title>
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
.navbar:hover { background: #6e3f47; }
.navbar .brand { font-weight: 700; font-size: 18px; }
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
.navbar nav a:hover { background: var(--primary-2); }
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

/* Table */
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

/* Tombol Edit & Hapus */
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

/* Tombol Tambah */
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

/* Animasi bunga jatuh */
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
  box-shadow: 0 0 12px rgba(200, 150, 255, 0.6);
  transform: translateY(-2px);
}

.search-box input::placeholder {
  color: var(--muted);
  font-style: italic;
}
</style>

</head>
<body>
 <div class="navbar">
  <div class="brand">Data Kelas</div>
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
  <a href="export_kelas.php" class="add-btn">⬇️ Export ke Word</a>
</div>

<h1>Tabel Kelas</h1>

<!-- Search Box -->
<div class="search-box">
  <input type="text" id="searchInput" placeholder="🔍 Cari kelas...">
</div>

<div class="table-card">
<table id="kelasTable">
    <tr>
       <?php
        if (mysqli_num_rows($result) > 0) {
            $fields = mysqli_fetch_fields($result);
            foreach ($fields as $field) {
                echo "<th>" . $field->name . "</th>";
            }
            
        ?>
    </tr>
    <?php
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $data) {
                    echo "<td>" . $data . "</td>";
                }
                
                echo "</tr>";
            }
        } else {
            echo "<td colspan='100%'>Tidak ada data</td>";
        }
        ?>
    </tr>
</table>
</div>



</body>
<script>
  // Filter table sesuai input
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#kelasTable tr:not(:first-child)");

    rows.forEach(row => {
      let text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });

  // Animasi bunga jatuh
  for (let i = 0; i < 25; i++) {
    let bfly = document.createElement("div");
    bfly.className = "butterfly";
    bfly.textContent = "🌸";
    bfly.style.left = Math.random() * 100 + "vw";
    bfly.style.animationDuration = 5 + Math.random() * 5 + "s";
    bfly.style.setProperty("--x", (Math.random() * 200 - 100) + "px");
    bfly.style.setProperty("--rEnd", (Math.random() * 720 - 360) + "deg");
    document.body.appendChild(bfly);
  }
</script>

</html>

<?php mysqli_close($koneksi); ?>
