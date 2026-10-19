<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <style>
:root {
  --bg:        #edcaffff;
  --surface:   #ffffffcc;
  --surface-2: #f5e1e6;
  --text:      #2c2c34;
  --muted:     #7a7a8c;
  --putih:     #fff;
  --primary:   #85555dff;
  --accent:    #d9a066;
  --border:    rgba(0,0,0,0.1);
  --shadow:    0 6px 20px rgba(0,0,0,.08);
  --radius:    16px;
}

body {
  margin: 0;
  font-family: 'Poppins', Arial, sans-serif;
  color: var(--text);
  background: linear-gradient(135deg, #ffdde1, #fcb7c2, #c8b6ff);
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
}

/* Hero Section */
.hero {
  max-width: 1000px;
  text-align: center;
  padding: 60px 20px 30px;
}
.hero img {
  max-width: 180px;
  margin-bottom: 20px;
}
.hero h1 {
  font-size: 36px;
  margin: 10px 0;
  color: var(--primary);
  font-weight: 800;
  text-shadow: 2px 2px 5px rgba(0,0,0,0.1);
}
.hero p {
  font-size: 16px;
  color: var(--muted);
  max-width: 600px;
  margin: auto;
}

/* Card menu */
.menu {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* fix 4 kolom */
  gap: 20px;
  max-width: 900px;
  width: 100%;
  padding: 20px;
}

.card {
  background: var(--surface);
  border-radius: var(--radius);
  padding: 25px 20px;
  text-align: center;
  box-shadow: var(--shadow);
  text-decoration: none;
  color: var(--text);
  font-weight: 600;
  transition: all 0.3s ease;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.15);
  background: #fff0f4;
}
.card span {
  font-size: 35px;
  display: block;
  margin-bottom: 12px;
}

/* Logout button */
.logout {
  position: fixed;
  top: 20px;
  right: 20px;
  background: var(--accent);
  color: white;
  padding: 8px 14px;
  border-radius: 10px;
  text-decoration: none;
  font-weight: bold;
  font-size: 14px;
  transition: 0.3s;
}
.logout:hover {
  background: var(--primary);
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

/* Footer */
footer {
  margin-top: auto;
  padding: 20px;
  text-align: center;
  color: var(--putih);
  font-size: 14px;
  background: linear-gradient(135deg, #fcb7c2, #c8b6ff); /* warna cantik */
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  box-shadow: 0 -4px 12px rgba(0,0,0,0.1);
}
footer p {
  margin: 5px 0;
}

/* Animasi bunga */
.butterfly {
  position: fixed;
  font-size: var(--size, 20px);
  animation: fall linear infinite;
  z-index: -1;
  pointer-events: none;
  opacity: 0.85;
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
  </style>
</head>
<body>

<a href="../logout.php" class="logout">Logout</a>

<div class="hero">
  <h1>Selamat Datang 🌸</h1>
  <p>Hai! Selamat datang di sistem informasi sekolah.  
     Yuk, kelola data guru, siswa, kelas, nilai, dan lainnya dengan mudah  
     ✨</p>
</div>

<div class="menu">
  <a href="tb_guru.php" class="card"><span>👩‍🏫</span>Guru</a>
  <a href="tb_siswa.php" class="card"><span>👨‍🎓</span>Siswa</a>
  <a href="tb_mapel.php" class="card"><span>📚</span>Mapel</a>
  <a href="tb_nilai.php" class="card"><span>📝</span>Nilai</a>
  <a href="tb_kelas.php" class="card"><span>🏫</span>Kelas</a>
  <a href="tb_absensi.php" class="card"><span>📅</span>Absensi</a>
  <a href="tb_ampu.php" class="card"><span>📖</span>Ampu</a>
  <a href="tb_berita.php" class="card"><span>📰</span>Berita</a>
</div>

<footer>
  <p>🌷 “Pendidikan adalah kunci menuju masa depan yang cerah.” 🌷</p>
  <p>&copy; 2025 Sistem Informasi Sekolah</p>
</footer>

<script>
  for (let i = 0; i < 25; i++) {
    let flower = document.createElement("div");
    flower.className = "butterfly";
    flower.textContent = Math.random() > 0.5 ? "🌸" : "🌼"; 
    flower.style.left = Math.random() * 100 + "vw";
    flower.style.setProperty("--size", (12 + Math.random() * 18) + "px");
    flower.style.animationDuration = (5 + Math.random() * 6) + "s";
    flower.style.setProperty("--x", (Math.random() * 200 - 100) + "px");
    flower.style.setProperty("--rEnd", (Math.random() * 720 - 360) + "deg");
    document.body.appendChild(flower);
  }
</script>

</body>
</html>
