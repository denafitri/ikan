<?php
include 'koneksi.php';

$sql = "SELECT a.id, g.nama, k.nama_kelas, m.nama_pelajaran
        FROM tb_ampu a
        JOIN tb_guru g ON a.id_guru = g.id_guru
        JOIN tb_kelas k ON a.id_kelas = k.id_kelas
        JOIN tb_mapel m ON a.id_pelajaran = m.id_pelajaran";

$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tabel Mapel Diampu</title>
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
}
.navbar:hover {
  background: #6e3f47;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
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

/* Card wrapper */
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
.table-card:hover {
  transform: translateY(-2px);
}

table {
  width: 100%;
  border-collapse: collapse;
}
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

tr {
  transition: background 0.3s ease;
}
tr:nth-child(even) {
  background: rgba(255, 255, 255, 0.3);
}
tr:hover td {
  background: #69484e5e;
}

/* Tombol Edit & Hapus */
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

/* Custom scrollbar */
::-webkit-scrollbar {
  height: 8px;
  width: 8px;
}
::-webkit-scrollbar-thumb {
  background: var(--primary);
  border-radius: 10px;
}
::-webkit-scrollbar-track {
  background: var(--surface);
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
  0% {
    transform: translateY(-10vh) translateX(0) rotate(0deg);
    opacity: 0;
  }
  10% { opacity: 1; }
  100% {
    transform: translateY(110vh) translateX(var(--x, 0))
               rotate(var(--rEnd, 360deg));
    opacity: 0;
  }
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
    <div class="brand">Data Ampu</div>
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
  <a href="export_ampu.php" class="add-btn">⬇ Export ke Word</a>
</div>

<h1>Tabel Mapel Diampu</h1>

<div class="search-box">
  <input type="text" id="searchInput" placeholder="🔍 Cari mapel diampu...">
</div>

<div class="table-card">
<table id="ampuTable">
    <tr>
        <th>ID Ampu</th>
        <th>Guru</th>
        <th>Kelas</th>
        <th>Mata Pelajaran</th>
     
    </tr>
    <?php
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['nama_kelas']."</td>";
            echo "<td>".$row['nama_pelajaran']."</td>";
          
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
    }
    ?>
</table>


</div>



<script>
  // animasi bunga tetap
  for(let i=0;i<30;i++){
    let flower = document.createElement("div");
    flower.className="butterfly";
    flower.textContent="🌸";
    flower.style.left=Math.random()*100+"vw";
    flower.style.setProperty("--size",(10+Math.random()*20)+"px");
    flower.style.animationDuration=(5+Math.random()*7)+"s";
    flower.style.setProperty("--x",(Math.random()*200-100)+"px");
    flower.style.setProperty("--rEnd",(Math.random()*720-360)+"deg");
    document.body.appendChild(flower);
  }

  // filter pencarian
  document.getElementById("searchInput").addEventListener("keyup",function(){
    let filter=this.value.toLowerCase();
    let rows=document.querySelectorAll("#ampuTable tr");
    rows.forEach((row,index)=>{
      if(index===0) return;
      let text=row.innerText.toLowerCase();
      row.style.display=text.includes(filter) ? "" : "none";
    });
  });
</script>
</body>
</html>

<?php mysqli_close($koneksi); ?>