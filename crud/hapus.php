<?php
// MENGAMBIL FILE FUNCTION
require '../auxiliary/function.php';
// AMBIL NILAI DI URL ID
$id = $_GET["id"];
// JIKA NILAI BALIK HAPUS LEBIH DARI NOL
if (hapus($id) > 0) {
    // TAMPILKAN POPUP BERHASIL
    echo "<script>
        alert('data berhasil dihapus!');
        document.location.href ='../index.php';
        </script>";
} else {
    // TAMPILKAN PUPU GAGAL
    echo "<script>
        alert('data gagal dihapus!');
        document.location.href = '../index.php';
        </script>";
}
