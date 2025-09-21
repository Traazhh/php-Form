<?php
session_start(); 

// Buat captcha penjumlahan setiap kali halaman dimuat
$angka1 = rand(1, 10);
$angka2 = rand(1, 10);
$_SESSION['captcha_question'] = "$angka1 + $angka2";
$_SESSION['captcha'] = $angka1 + $angka2;

if (isset($_POST['Login'])) {
    $username      = $_POST['nama'];
    $password      = $_POST['pass'];
    $captcha_input = $_POST['captcha_input'];

    $stored_captcha = $_SESSION['captcha_input_previous'] ?? '';

    if ($captcha_input != $stored_captcha) {
        $error = "Captcha salah! Silakan coba lagi.";
    } else {
        unset($_SESSION['captcha_input_previous']);

        if ($password == "rahasia123") {
            // Login berhasil, set session login dan redirect
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password yang Anda masukkan salah.";
        }
    }
}

// Simpan captcha untuk validasi nanti
$_SESSION['captcha_input_previous'] = $_SESSION['captcha'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login dengan Captcha</title>
</head>
<body>
    <div style="text-align: center;"> 
    <img src="photo/Logo.png" alt="Gagal memuat gambar" width="100px">
    <h2>Login Siswa Skanilan</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="" method="POST" name="input">
        Username Anda : <input type="text" name="nama" required><br> <br>
        Password Anda : <input type="password" name="pass" required><br><br>

        <b>Captcha : <?= $_SESSION['captcha_question'] ?> = ?</b><br>
        Masukkan captcha di atas: <input type="text" name="captcha_input" required><br><br>

        <input type="submit" name="Login" value="Login">
        <input type="reset" name="reset" value="Reset">
    </form>
    </div
</body>
</html>
