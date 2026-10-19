<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Selamat Datang</title>
  <style>
    :root {
      --primary: #ff85a2;
      --secondary: #c8b6ff;
      --white: #ffffff;
      --text-dark: #2c2c34;
      --shadow: 0 8px 25px rgba(0,0,0,.12);
      --radius: 22px;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #ffdde1, #ee9ca7, #c8b6ff);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: var(--text-dark);
      overflow: hidden;
      transition: 0.5s;
    }

    body.dark {
      background: linear-gradient(135deg, #1e1e2e, #2a2a40, #3e2f5b);
      color: #eee;
    }

    /* Navbar */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(15px);
      border-bottom: 1px solid rgba(255,255,255,0.4);
      z-index: 1000;
      animation: slideDown 1s ease;
      transition: background 0.5s;
    }

    body.dark .navbar {
      background: rgba(30,30,40,0.6);
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .navbar .brand {
      font-size: 22px;
      font-weight: 700;
      color: var(--white);
      letter-spacing: 1px;
      text-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .navbar nav a {
      margin-left: 20px;
      text-decoration: none;
      color: var(--white);
      font-weight: 500;
      transition: 0.3s;
      padding: 6px 10px;
      border-radius: 6px;
    }

    .navbar nav a:hover {
      background: rgba(255,255,255,0.25);
    }

    /* Dark mode toggle */
    .toggle {
      cursor: pointer;
      font-size: 22px;
      margin-left: 20px;
      user-select: none;
    }

    /* Container */
    .container {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(18px);
      padding: 50px 35px;
      border-radius: var(--radius);
      text-align: center;
      max-width: 500px;
      width: 90%;
      margin-top: 100px;
      animation: fadeInUp 1.2s ease;
      border: 2px solid transparent;
      background-clip: padding-box;
      box-shadow: var(--shadow);
    }

    .container::before {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: var(--radius);
      padding: 2px;
      background: linear-gradient(135deg, var(--primary), var(--secondary), #fff);
      -webkit-mask: 
        linear-gradient(#fff 0 0) content-box, 
        linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      animation: glow 4s linear infinite;
    }

    /* Icon lucu */
    .icon {
      font-size: 50px;
      margin-bottom: 15px;
      animation: bounce 2s infinite;
    }

    .container h1 {
      margin-bottom: 15px;
      color: var(--white);
      font-size: 32px;
      text-shadow: 0 3px 8px rgba(0,0,0,0.25);
    }

   .container {
  position: relative;
  z-index: 10; /* biar di atas sakura */
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(18px);
  padding: 50px 35px;
  border-radius: var(--radius);
  text-align: center;
  max-width: 500px;
  width: 90%;
  margin-top: 100px;
  animation: fadeInUp 1.2s ease;
  border: 2px solid transparent;
  background-clip: padding-box;
  box-shadow: var(--shadow);
}

.btn {
  display: inline-block;
  padding: 14px 30px;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  color: var(--white);
  text-decoration: none;
  border-radius: 12px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 14px rgba(0,0,0,0.2);
  position: relative;
  z-index: 11; /* tombol lebih tinggi lagi */
}


    .btn:hover {
      transform: scale(1.08) translateY(-3px);
      box-shadow: 0 6px 18px rgba(0,0,0,0.3);
    }

    /* Sakura falling */
    .sakura {
      position: absolute;
      top: -50px;
      font-size: 24px;
      animation: fall linear forwards;
      opacity: 0.9;
      z-index: 0;
    }

    @keyframes fall {
      0% { transform: translateY(0) rotate(0deg); opacity: 1; }
      100% { transform: translateY(110vh) rotate(360deg); opacity: 0.7; }
    }

    /* Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideDown {
      from { transform: translateY(-100%); }
      to { transform: translateY(0); }
    }
    @keyframes glow {
      0% { filter: hue-rotate(0deg); }
      100% { filter: hue-rotate(360deg); }
    }
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">🌸 MyWebsite</div>
    <nav>
      
      <span class="toggle" onclick="toggleDark()">🌙</span>
    </nav>
  </div>

  <!-- Content -->
  <div class="container">
    <div class="icon">🐰</div> <!-- Bisa ganti jadi 🌷 atau 🦋 -->
    <h1>Selamat Datang 👋</h1>
    <p>Silakan masuk ke sistem dengan login terlebih dahulu.</p>
    <a href="login.php" class="btn">Login</a>
  </div>

  <!-- Script Sakura -->
  <script>
    function createSakura() {
      const sakura = document.createElement("div");
      sakura.classList.add("sakura");
      sakura.textContent = "🌸";

      sakura.style.left = Math.random() * 100 + "vw";
      sakura.style.fontSize = Math.random() * 16 + 16 + "px";
      sakura.style.animationDuration = Math.random() * 5 + 5 + "s";

      document.body.appendChild(sakura);
      setTimeout(() => sakura.remove(), 10000);
    }
    setInterval(createSakura, 500);

    // Toggle dark mode
    function toggleDark() {
      document.body.classList.toggle("dark");
      const toggle = document.querySelector(".toggle");
      toggle.textContent = document.body.classList.contains("dark") ? "☀️" : "🌙";
    }
  </script>
</body>
</html>
