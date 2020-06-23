<?php
// MEMULAI SESSION
session_start();
// MENGAMBIL FILE FUNGSI
include '../auxiliary/function.php';
// MENGECEK COOKIE
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    // MENGAMBIL COOKIE
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    // MEGAMBIL USERNAME BERDASARKAN ID PADA DATABASE
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    // MENGAMBIL NILAI DALAM BENTUK STRING
    $row = mysqli_fetch_assoc($result);
    // MENGECEK COOKIIE DAN USERNAME
    if ($key === hash('sha256', $row['username'])) {
        //MENGIRIMKAN SESSION LOGIN
        $_SESSION['login'] = true;
    }
}
// JIKA TERSEDIA SESSION BERNILAI LOGIN
if (isset($_SESSION["login"])) {
    // PINDAH KE HALAMAN INDEX
    header("Location: ../index.php");
}
// JIKA TERSEDIA NILAI LOGIN PADA POST
if (isset($_POST["login"])) {
    // AMBIL NILAI USERNAME DAN PASSWORD
    $username = $_POST["username"];
    $password = $_POST["password"];
    // MEMANGGIL DATABASE DAN MENARUH PERINTAH TAMPILAN
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    // MEMERIKSA USERNAME
    // MYSQLI_NUM_ROWS: MENGHITUNG BARIS YANG DIKEMBALIKAN DATABASE
    if (mysqli_num_rows($result)) {
        // CEK PASSWORD
        // MENGAMBIL NILAI INDEX STRING PADA RESULT
        $row = mysqli_fetch_assoc($result);
        // PASSWORD_VERIFY(BELUM DIACAK, SUDAH DIACAK)
        if (password_verify($password, $row["password"])) {
            // MENGIRIMKAN SESSION LOGIN
            $_SESSION["login"] = true;
            // MEMMERIKSA REMEMBER ME
            // JIKA TERSEDIA NILAI REMEMBER PADA POST
            if (isset($_POST['remember'])) {
                // MEMBUAT COOKIE
                // SETCOOKIE('KEY', 'VALUE', TIME);
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha265', $row['username']), time() + 60);
            }
            // PINDAH KEHALAMAN INDEX
            header("Location: ../index.php");
            // KELUAR BIAR BAWAH GA JALAN
            exit;
        }
    }
    // BUAT VARIABEL ERROR DENGAN NILAI TRUE
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <h1>SILAHKAN LOGIN!</h1>
    <!-- JIKA TERSEDIA NILAI ERROR -->
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic;">Username/Password Salah!</p>
    <?php endif; ?>
    <form action="" method="post">
        <ul>
            <li>
                <label>
                    Username:
                    <input type="text" name="username">
                </label>
            </li>
            <li>
                <label>
                    Password:
                    <input type="password" name="password">
                </label>
            </li>
            <li>
                <label>
                    <input type="checkbox" name="remember">
                    Remember Me!
                </label>
            </li>
            <button type="submit" name="login">LOGIN!</button>
            <br>
            <a href="register.php">Belum Punya Akun?</a>
        </ul>
    </form>
</body>

</html>