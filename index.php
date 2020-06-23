<?php
// MEMULAI SESSION
session_start();
// JIKA TIDAK TERSEDIA SESSION DENGAN NILAI LOGIN
if (!isset($_SESSION["login"])) {
    // PINDAH KE HALAMAN LOGIN
    header("Location: log/login.php");
}
// MENGABIL FILE
// include 'function.php';
require 'auxiliary/function.php';
//PAGINATION
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM hewan"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// MENGAMBLI DATABASE MENGGUNAKAN FUNGSI QUERY 
// DENGAN LIMIT YANG DIAMBIL DARI INDEX: AWAL DATA SEBANYAK: JUMLAH DATA/HALAMAN
// $animals = query("SELECT * FROM hewan LIMIT $awalData, $jumlahDataPerHalaman");
$animals = query("SELECT * FROM hewan"); // UNTUK LIVE SEARCH
// UNTUK MEMERIKSA PROSES PENCARIAN
// JIKA TERSEDIA METHOD POST DENGAN NILAI CARI 
if (isset($_POST["cari"])) {
    // AMBIL NILAI KEYWORD PADA POST MASUKAN DALAM FUNGSI CARI
    $animals = cari($_POST["keyword"]);
}
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

        .loader {
            position: absolute;
            min-width: 130px;
            top: 90px;
            left: 130px;
            z-index: -1;
            display: none;
        }

        /* HANYA DIJAKANKAN KETIKA MAU PRINT VIA WEB */
        @media print {

            .cetak-hide,
            br {
                display: none;
            }
        }
    </style>
</head>

<body>
    <a href="log/logout.php" class="cetak-hide">LOGOUT</a> | <a href="auxiliary/cetak.php" target="_blank">CETAK</a>
    <h1>Daftar Hewan</h1>
    <br>
    <form action="" method="post" class="cetak-hide">
        <!--AUTOfOCUS : UNTUK MENGARAHKAN CURSOR LANGSUNG KE INPUT
            AUTOCOMPLETE : UNTUK MENGHILANGKAN SARAN YANG MUNCUL-->
        <input type="text" name="keyword" placeholder="Masukkan Keyword.." autofocus autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
        <img src="img/load.gif" class="loader">
    </form>
    <br>
    <br>
    <div class="cetak-hide">
        <?php if ($halamanAktif > 1) : ?>
            <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a href="?halaman=<?= $i ?>" style="font-weight: bold; color: red;"><?= $i ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
        <?php endif; ?>
        <br>
        <br>
        <a href="crud/tambah.php">Tambah Data</a>
        <br>
        <br>
    </div>
    <div class="container" id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th class="cetak-hide">Aksi</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Lingkungan</th>
                <th>Makanan</th>
                <th>Kaki</th>
            </tr>
            <!-- UNTUK NOMOR KARENA KALO MENGGUNAKAN INDEX ID AKAN BERANTAKAN -->
            <?php $no = 1; ?>
            <!-- LAKUKAN LOOPING KHUSUS ARRAY FOREACH -->
            <?php foreach ($animals as $animal) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td class="cetak-hide">
                        <a href="crud/ubah.php?id=<?= $animal["id"]; ?>">Ubah</a> |
                        <!--ONCLICK : UNTUK MEMBERI PERINTAH KETIKA TOMBOL DITEKAN 
                        CONFIRM: UNTUK MENANYAKAN SEBUAH KEPASTIAN-->
                        <a href="crud/hapus.php?id=<?= $animal["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
                    </td>
                    <td><img src="img/<?= $animal["gambar"]; ?>" alt=""></td>
                    <td><?= $animal["nama"] ?></td>
                    <td><?= $animal["lingkungan"] ?></td>
                    <td><?= $animal["makanan"] ?></td>
                    <td><?= $animal["kaki"] ?></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/query.js"></script>
    <!-- LIVE SERVER CARA LAMA -->
    <!-- <script src="js/script.js"></script> -->
</body>

</html>