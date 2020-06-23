<?php
// MENJALANKAN SESSION
session_start();
// MENGHANCURKAN SESSION
session_destroy(); // HARUSNYA INI AJA CUKUP
// SET ULANG SESSION
session_unset();
// MENGKOSOSGKAN SESSION
$_SESSION = [];
// MENGHAPUS COOKIE KEY
setcookie('id', '', time() - 3600);
// MENGHAPUS COOKIE PASSWORD
setcookie('key', '', time() - 3600);
// PINDAH KE HALAMAN LOGIN
header("Location: login.php");
