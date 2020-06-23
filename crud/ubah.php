<?php
// MENGMABIL FILE FUNGSI
include '../auxiliary/function.php';
// MENGAMBIL NILAI ID DARI URL
$id = $_GET["id"];
// var_dump($id);
// MENAMPILKAN HEWAN DENGAN ID TERSEBUT
$animals = query("SELECT * FROM hewan WHERE id = $id")[0];
// var_dump($animals);
// JIKA TERSEDIA NILAI SUBMIT
if (isset($_POST["submit"])) {
    // JIKA FUNGSI UBAH MENGEMBALIKAN NILAI LEBIH DARI NOL
    if (ubah($_POST) > 0) {
        // MENAPILKAN POPUP BERHASIL
        echo "<script>
        alert('data berhasil ditambahkan!');
        document.location.href ='../index.php';
        </script>";
    } else {
        // MENAMPIKAN POPUP GAGAL
        echo "<script>
        alert('data gagal ditambahkan!');
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
            <input type="hidden" name="id" value="<?= $animals["id"]; ?>">
            <li>
                <label>
                    Nama:
                    <input type="text" name="nama" value="<?= $animals["nama"]; ?>" required>
                </label>
            </li>
            <li>
                <label>
                    Lingkungan:
                    <input type="text" name="lingkungan" value="<?= $animals["lingkungan"]; ?>" required>
                </label>
            </li>
            <li>
                <label>
                    Makanan:
                    <input type="text" name="makanan" value="<?= $animals["makanan"]; ?>" required>
                </label></li>
            <li>
                <label>
                    Kaki
                    <input type="text" name="kaki" value="<?= $animals["kaki"]; ?>" required>
                </label>
            </li>
            <li>
                <img src="../img/<?= $animals["gambar"]; ?>" alt="" width="50px">
            </li>
            <li>
                <label>
                    Gambar:
                    <input type="file" name="gambar" value="<?= $animals["gambar"]; ?>" required>
                </label>
            </li>
            <li>
                <button type="submit" name="submit">Masukan Data!</button>
            </li>
        </form>
    </ul>
    <a href="../index.php">back to dasboard</a>
</body>

</html>