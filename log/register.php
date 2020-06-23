<?php
// MENGABIL FILE FUNGSI
include '../auxiliary/function.php';
// JIKA TERSDIA NILAI REGIST PADA POST
if (isset($_POST["regist"])) {
    // JIKA DIKEMBAILIKAN NILAI DARI FUNGSI DAFTAR LEBIH DARI NOL
    if (daftar($_POST) > 0) {
        // TAMPILKAN POPUP BERHASIL
        echo "<script>
        alert('User berhasil ditambahkan!');
        document.location.href ='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>REGISTER!</h1>

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
                    <input type="password" name="password1">
                </label>
            </li>
            <li>
                <label>
                    Confirm Password:
                    <input type="password" name="password2">
                </label>
            </li>
            <button type="submit" name="regist">DAFTAR!</button>
            <br>
            <br>
            <a href="/login.php">Kembali ke halaman login</a>
        </ul>
    </form>
</body>

</html>