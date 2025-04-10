<?php
session_start();
include('db.php'); // Menghubungkan ke database

$error_message = "";

// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($email) || empty($password)) {
        $error_message = "Email atau kata sandi tidak boleh kosong.";
    } else {
        // Query untuk memeriksa apakah email ada di database
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Jika pengguna ditemukan
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verifikasi password tanpa hash
            if ($password === $user['password']) {
                // Login berhasil, simpan session
                $_SESSION['user_email'] = $email;

                // Redirect ke halaman timeline.php setelah login berhasil
                header("Location: timeline.php");
                exit();
            } else {
                $error_message = "Email atau kata sandi salah.";
            }
        } else {
            $error_message = "Email tidak ditemukan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - PeachSocial</title>
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

    .login-container {
      position: relative;
      background-color: #151a23;
      padding: 40px;
      border-radius: 16px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 8px 24px rgba(29,161,242,0.2);
      text-align: center; /* Menambahkan text-align center agar gambar berada di tengah */
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

    .login-container h2 {
      color: #1DA1F2;
      margin-bottom: 30px;
      font-size: 28px;
      letter-spacing: 1px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left; /* Agar label dan input sejajar kiri */
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
      box-sizing: border-box;
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
      margin: 0 auto 20px; /* Memberikan margin di bawah logo */
      width: 80px; /* Menyesuaikan ukuran logo */
      height: auto; /* Menjaga rasio gambar */
    }

  </style>
</head>
<body>
<div class="login-container">
  <a href="home.html" class="close-btn">×</a>
  <!-- Menambahkan gambar di atas form -->
  <img src="images/iconz.png" alt="Logo" class="login-logo">
  <h2>Sign In</h2>

  <!-- Menambahkan gambar di atas form -->

  <?php if (!empty($error_message)): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
  <?php endif; ?>

  <form method="POST" action="login.php">
    <div class="form-group">
      <label for="email">Email atau Username</label>
      <input type="text" id="email" name="email" placeholder="yourname@example.com" required>
    </div>
    <div class="form-group">
      <label for="password">Kata Sandi</label>
      <input type="password" id="password" name="password" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn">Masuk</button>
  </form>
  <div class="footer-text">
    Belum punya akun? <a href="register.php">Daftar Sekarang</a>
  </div>
  <div class="branding">urmemories. — ekspresikan dirimu dengan cara yang paling kamu suka</div>
</div>

</body>
</html>
