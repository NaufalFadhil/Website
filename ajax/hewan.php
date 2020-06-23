<?php
// MENIDURKAN HALAMAN SELAMA SATU DETIK
// sleep(1);
usleep(1000000);
//MENGAMBIL FILE FUNCTION
require '../auxiliary/function.php';
// MENGAMBIL KEYWORD DARI URL
$keyword = $_GET["keyword"];
// MENGAMBIL FUNGSI KEYWORD DENGAN VALUE KEYWORD
$animals = cari($keyword);
?>
<!-- CODE BAGIAN MANAKAH YANG INGIN DIUBAH?
    TIDAK MEMENGARUHI CODE BAGIAN LAIN -->
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
    <!-- UNTUK NOMOR KARENA KALO MENGGUNAKAN INDEX ID AKAN BERANTAKAN -->
    <?php $no = 1; ?>
    <!-- LAKUKAN LOOPING KHUSUS ARRAY FOREACH -->
    <?php foreach ($animals as $animal) : ?>
        <tr>
            <td><?= $no; ?></td>
            <td>
                <a href="/crud/ubah.php?id=<?= $animal["id"]; ?>">Ubah</a> |
                <!--ONCLICK : UNTUK MEMBERI PERINTAH KETIKA TOMBOL DITEKAN 
                        CONFIRM: UNTUK MENANYAKAN SEBUAH KEPASTIAN-->
                <a href="/crud/hapus.php?id=<?= $animal["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
            </td>
            <td><img src="img/<?= $animal["gambar"]; ?>" width="50px"></td>
            <td><?= $animal["nama"] ?></td>
            <td><?= $animal["lingkungan"] ?></td>
            <td><?= $animal["makanan"] ?></td>
            <td><?= $animal["kaki"] ?></td>
        </tr>
        <?php $no++; ?>
    <?php endforeach; ?>
</table>

</html>