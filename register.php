<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - PeachSocial</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #0d1117;
      color: #e1e8ed;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-container {
      position: relative;
      background-color: #151a23;
      padding: 40px;
      border-radius: 16px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 8px 24px rgba(29,161,242,0.2);
      text-align: center;
    }

    .close-btn {
      position: absolute;
      top: 12px;
      left: 16px;
      color: #8899a6;
      font-size: 26px;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .close-btn:hover {
      color: #1DA1F2;
    }

    .register-container h2 {
      color: #1DA1F2;
      margin-bottom: 30px;
      font-size: 28px;
      letter-spacing: 1px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left; /* Mengatur agar label dan input sejajar kiri */
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 6px;
      color: #cfd9de;
      text-align: left; /* Pastikan label berada di kiri */
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      padding-left: 12px;
      border: 1px solid #38444d;
      border-radius: 8px;
      background-color: #0d1117;
      color: #e1e8ed;
      font-size: 16px;
      box-sizing: border-box;
    }

    .form-group input:focus {
      outline: none;
      border-color: #1DA1F2;
    }

    .username-group {
      position: relative;
    }

    .username-symbol {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 12px;
      color: #8899a6;
      font-size: 16px;
      z-index: 1;
      pointer-events: none;
    }

    .username-group input {
      padding-left: 30px !important;
    }

    .btn {
      width: 100%;
      padding: 14px;
      background-color: #1DA1F2;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #1991da;
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      color: #8899a6;
    }

    .footer-text a {
      color: #1DA1F2;
      text-decoration: none;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }

    .branding {
      text-align: center;
      font-size: 12px;
      color: #556;
      margin-top: 30px;
    }

    /* Gaya untuk gambar logo */
    .login-logo {
      display: block;
      margin: 0 auto 20px; /* Menambahkan margin di bawah untuk memberi ruang */
      width: 80px; /* Menyesuaikan ukuran logo */
      height: auto; /* Menjaga rasio gambar */
    }
  </style>
</head>
<body>
  <div class="register-container">
    <a href="home.html" class="close-btn">×</a>
    <!-- Menambahkan gambar di atas form -->
    <img src="images/iconz.png" alt="Logo" class="login-logo">
    <h2>Sign Up</h2>
    <form>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="yourname@example.com" required>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <div class="username-group">
          <span class="username-symbol">@</span>
          <input type="text" id="username" name="username" placeholder="namakerenmu" required>
        </div>
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn">Daftar</button>
    </form>
    <div class="footer-text">
      Sudah punya akun? <a href="login.php">Masuk Sekarang</a>
    </div>
    <div class="branding">urmemories. — tempat di mana cerita kamu berbuah inspirasi</div>
  </div>
</body>
</html>
