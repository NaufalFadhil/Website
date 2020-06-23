<?php
// FILE INI BERSISI PERULANGAN TANPA FOREACH
// JADI PINDAH KE INDEX.PHP KARENA MENGGUNAKAN WHILE RIBET DAN SUSAH
header("Location: index.php");
exit;

// Menghubungkan ke database
$conn = mysqli_connect("localhost", "root", "", "wpu_phpdasar");

// Mengambil data dari table mahasiswa
$result = mysqli_query($conn, "SELECT * FROM hewan");

// error tidak akan ditampilkan jadi buat manual
// if (!$data) {
//     mysqli_error($data);
// }

// mengambil data (fetch) mahasiswa dari object $data
// mysqli_fetch_row(); // Mengembalikan nilai numerik
// mysqli_fetch_assoc(); // Mengembalikan nilai assosiatif
// mysqli_fetch_array(); // Mengembalikan Kedua Nilai
// mysqli_fetch_object(); // Membuat Object

// $animals = mysqli_fetch_object($result);
// var_dump($animals->nama);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hewan</title>
    <style>
        img {
            max-width: 50px;
        }

        th,
        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Daftar Hewan</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Lingkungan</th>
            <th>Makanan</th>
            <th>Kaki</th>
        </tr>

        <?php $no = 1; ?>
        <?php while ($animals = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <a href="">Ubah</a> |
                    <a href="">Hapus</a>
                </td>
                <td><img src="img/<?= $animals["gambar"]; ?>" alt=""></td>
                <td><?= $animals["nama"] ?></td>
                <td><?= $animals["lingkungan"] ?></td>
                <td><?= $animals["makanan"] ?></td>
                <td><?= $animals["kaki"] ?></td>
            </tr>
            <?php $no++; ?>
        <?php endwhile; ?>
    </table>
</body>

</html>