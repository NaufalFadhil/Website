<?php
// MENGAMBIL NILAI FUNGSI
include '../auxiliary/function.php';
// JIKA TERSEDIA NILAI SUBMIT
if (isset($_POST["submit"])) {
    // Ambil data dari setiap element form // Sudah berada didalam funtion
    // // Memeriksa nilai dari data yang terkirim ke halaman ini
    // var_dump($_POST);
    // var_dump($_FILES);
    // die; // Menghentikan Script
    // JIKA FUNGSI TAMBAH MENGEMBALIKAN NILAI LEBIH DAI NOL
    if (tambah($_POST) > 0) {
        // MENAMPILKAN POPUP BERHASIL
        echo "<script>
        alert('data berhasil diubah!');
        document.location.href ='../index.php';
        </script>";
    } else {
        // MENAMPILKAN POPUP GAGAL
        echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Tambah Data</h1>

    <ul>
        <!-- MULITPART/FORM-DATA: UNTUK MENGIRIM INPUT TIPE FILE -->
        <form action="" method="post" enctype="multipart/form-data">
            <li>
                <label>
                    Nama:
                    <input type="text" name="nama" required>
                </label>
            </li>
            <li>
                <label>
                    Lingkungan:
                    <input type="text" name="lingkungan" required>
                </label>
            </li>
            <li>
                <label>
                    Makanan:
                    <input type="text" name="makanan" required>
                </label></li>
            <li>
                <label>
                    Kaki
                    <input type="text" name="kaki" required>
                </label>
            </li>
            <li>
                <label>
                    Gambar:
                    <input type="file" name="gambar" required>
                </label>
            </li>
            <br>
            <li>
                <button type="submit" name="submit">Masukan Data!</button>
            </li>
        </form>
    </ul>

    <a href="../index.php">back to dasboard</a>
</body>

</html>