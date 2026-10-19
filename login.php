<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Multi User</title>
  <style>
    :root {
      --primary: #ff85a2;
      --secondary: #c8b6ff;
      --dark: #2c2c34;
      --white: #ffffff;
      --border: rgba(0,0,0,0.15);
      --ring: rgba(184,107,119,0.35);
      --shadow: 0 8px 25px rgba(0,0,0,.15);
      --radius: 16px;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #ffdde1, #ee9ca7, #c8b6ff);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: var(--dark);
      overflow: hidden;
    }

    h1 {
      margin-bottom: 20px;
      color: var(--white);
      text-shadow: 0 3px 8px rgba(0,0,0,0.25);
      animation: fadeInDown 1s ease;
      z-index: 2;
      position: relative;
    }

    /* Card Login */
    .kotak_login {
      width: 100%;
      max-width: 400px;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(18px);
      padding: 40px 30px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
      animation: fadeInUp 1s ease;
      position: relative;
      overflow: hidden;
      z-index: 2;
    }

    .kotak_login::before {
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
      animation: glow 5s linear infinite;
    }

    .tulisan_login {
      text-align: center;
      font-size: 22px;
      font-weight: 700;
      color: var(--white);
      margin-bottom: 25px;
      text-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    label {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 6px;
      display: block;
      color: var(--white);
    }

    /* Input group with icon */
    .input_group {
      position: relative;
      margin-bottom: 18px;
    }

    .input_group i {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      font-size: 16px;
      color: #777;
    }

  .form_login {
  width: 85%;   /* coba 80-90% sesuai selera */
  margin: 0 auto; /* biar inputnya center */
  padding: 12px 14px 12px 44px;
  border: 1px solid var(--border);
  border-radius: 12px;
  font-size: 14px;
  background: rgba(255,255,255,0.85);
  transition: 0.2s;
  display: block; /* biar margin auto jalan */
}



    .form_login:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px var(--ring);
    }

    /* Tombol login */
    .tombol_login {
      width: 100%;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: var(--white);
      border: none;
      padding: 12px;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 15px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    }

    .tombol_login:hover {
      transform: scale(1.05) translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }

    /* Link kembali */
    .link {
      font-size: 14px;
      color: var(--white);
      text-decoration: none;
      font-weight: 600;
      transition: 0.2s;
    }

    .link:hover {
      text-decoration: underline;
    }

    /* Alert pesan error */
    .alert {
      background: #ff6b6b;
      padding: 12px;
      border-radius: var(--radius);
      color: #fff;
      font-weight: 600;
      margin-bottom: 15px;
      text-align: center;
      animation: shake 0.5s ease;
      z-index: 2;
      position: relative;
    }

    /* Sakura falling */
    .sakura {
      position: absolute;
      top: -50px;
      font-size: 20px;
      animation: fall linear forwards;
      opacity: 0.9;
      z-index: 1;
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
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes glow {
      0% { filter: hue-rotate(0deg); }
      100% { filter: hue-rotate(360deg); }
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      50% { transform: translateX(5px); }
      75% { transform: translateX(-5px); }
    }
  </style>
</head>
<body>
 
  <h1>Membuat Login Multi User Level</h1>
 
  <?php 
  if(isset($_GET['pesan'])){
    if($_GET['pesan']=="gagal"){
      echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
    }
  }
  ?>
 
  <div class="kotak_login">
  <p class="tulisan_login">Silahkan login</p>

  <form action="aksi_login.php" method="post">
    <div class="input_group">
      <i>👤</i>
      <input type="text" name="user" class="form_login" placeholder="user .." required>
    </div>

    <div class="input_group">
      <i>🔑</i>
      <input type="password" name="pass" class="form_login" placeholder="Pass .." required>
    </div>

    <div class="input_group">
            <select name="role" class="form_login" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="guru">guru</option>
        <option value="siswa">siswa</option>
      </select>
    </div>

    <input type="submit" class="tombol_login" value="LOGIN" style="position:relative; z-index:5;">
    
    <br><br>
    <center>
      <a class="link" href="index.php" style="position:relative; z-index:5;">← Kembali</a>
    </center>
  </form>
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
  </script>
 
</body>
</html>
