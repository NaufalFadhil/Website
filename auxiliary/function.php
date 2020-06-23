<?php
// MENGKONEKSIKAN KE DATABASE
$conn = mysqli_connect("localhost", "root", "", "wpu_phpdasar");
// FUNGSI UNTUK MENGAMBIL DATA
function query($query)
{
    // AMBIL VARIABEL CONN DILUAR FUNGSI
    global $conn;
    // MENARUH PERINTAH SQL UNTUK MENGAMBIL DATA DARI DATABASE
    $result = mysqli_query($conn, $query);
    // MEMBUAT ARRAY KOSONG UNTUK DI ISI
    $rows = [];
    // AMBIL NILAI STRING PADA HASIL RELSULT TARUH PADA ROW
    while ($row = mysqli_fetch_assoc($result)) {
        // ISI ROWS ARRAY KOSONG KOSONG DENGAN ROW
        $rows[] = $row;
    }
    // KEMBALIKAN NILAI ROWS/STRING FIELD DATA
    return $rows;
}
// FUNGSI UNTUK MENAMBAH DATA
function tambah($data)
{
    // AMBIL VARIABEL CONN DILUAR FUNGSI
    global $conn;
    // MENGAMBIL NILAI DATA DARI SETIAP ELEMENT DI FORM
    $nama = htmlspecialchars($data["nama"]);
    $lingkungan = htmlspecialchars($data["lingkungan"]);
    $makanan = htmlspecialchars($data["makanan"]);
    $kaki = htmlspecialchars($data["kaki"]);
    // JALANKAN FUNGSI UPLOAD UNTUK GAMBAR
    $gambar = upload();
    // JIKA TIDAK ADA GAMBAR
    if (!$gambar) {
        // KEMBALIKAN NILAI FALSE
        return false;
    }
    // MASUKKAN DATA KE DALAM DATABASE
    $query = "INSERT INTO hewan VALUES ('', '$nama', '$lingkungan', '$makanan', '$kaki', '$gambar')";
    // MENARUH PERINTAH KE DATABASE
    mysqli_query($conn, $query);
    // KEMBALIKAN NILAI AFFECETED! BERHASIL/GAGAL!
    return mysqli_affected_rows($conn);
}
// FUNGSI UNUTK MENGUPLOAD GAMBAR
function upload()
{
    // MENGAMBIL NILAI FILES PADA SETIAP ELEMENT DI FORM
    // BUKA DULU KULIT LUAR 'GAMBAR' LALU MASUK KE NILAI ASSOSIATIFNYA
    $namaFile = $_FILES['gambar']['name'];
    $tipeFile = $_FILES['gambar']['type'];
    $tmpFile = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];
    $ukuranFile = $_FILES['gambar']['size'];
    // MENGECEK APAKAH ADA DATA YANG DIUPLOAD ATAU TIDAK
    // NILAI 4 ADALAH IMPLEMENTASI DARI ERROR
    // JIKA ERROR = 4 
    if ($error === 4) {
        // TMAPILKAN POPUP GAGAL
        echo "<script>
        alert('Gambar gagal diubah!');
        document.location.href ='index.php';
        </script>";
        // KEMBALIKAN NILAI SALAH
        return false;
    }
    // MENGECEK DATA YANG DIKIRIM GAMBAR ATAU BUKAN
    // MENANDAKANA EKSTENSI
    $ekstensiFileValid = ['jpg', 'jpeg', 'png'];
    // MEMECAH EKSTENSI
    // EXPLODE('DELIMITER', 'FILE');
    $ekstensiFile = explode('.', $namaFile);
    // STRTOLOWER: MEMAKSA SEMUA HURUF MENJADI KECIL
    // END: AMBIL AKHIR PAD EKSTESIFILE ATAS^
    $ekstensiFile = strtolower(end($ekstensiFile));
    // IN_ARRAY: LOGIKANNYA SEPERTI MENGAMBIL JARUM DI TUMPUKKAN JERAMI
    // JIKA TIDAK ADA YANG VALID
    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        // TAMPILKAN POPUP GAGAL!
        echo "<script>
        alert('Gambar gagal diubah!');
        document.location.href ='index.php';
        </script>";
        // KEMBALLIKAN NILAI SALAH
        return false;
    }
    // MENGECEK UKURAN APABILA TERLALU BESAR
    // JIKA UKURAN FILE LELBIH DARI 1Mb
    if ($ukuranFile > 1000000) {
        // TAMPILKAN PUPUP BESAR
        echo "<script>
        alert('Ukuran file terlalu besar!');
        document.location.href ='index.php';
        </script>";
        // KEMBALIKAN NILAI SALAH
        return false;
    }
    // GENERATE(MENGACAK) NAMA GAMBAR
    // AGAR TIDAK MENIMPA FILE YANG NAMANYA SAMA
    // UNIQID: MEMBERI ID UNIK
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;
    // MENGUPLOAD GAMBAR
    move_uploaded_file($tmpFile, '../img/' . $namaFileBaru);
    // MENGEMBALIKAN NILAI NAMA FILE BARU
    return $namaFileBaru;
}
// FUNGSI UNTUK MENGHAPUS
function hapus($id)
{
    // AMBIL VARIABEL CONN DILUAR FUNGSI
    global $conn;
    // MASUKKAN PERINTAH HAPUS KE DATABASE 
    mysqli_query($conn, "DELETE FROM hewan WHERE id = $id");
    // KEMBALIKAN NILAI AFFECTED
    return mysqli_affected_rows($conn);
}
// FUNGSI MENGUBAH DATA
function ubah($data)
{
    // AMBIL VARIABEL CONN DILUAR FUNGSI
    global $conn;
    // AMBIL NILAI DARI DATA
    // HTMLSPECIALCHARS: AGAR TIDAK BISA DIMASUKKAN SCRIPT HTML
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $lingkungan = htmlspecialchars($data["lingkungan"]);
    $makanan = htmlspecialchars($data["makanan"]);
    $kaki = htmlspecialchars($data["kaki"]);
    $gambarLama = htmlspecialchars($data["gambar"]);
    // JIKA NILAI ERROR PADA GAMBAR YANG DITERIMA = 4
    if ($_FILES['gambar']['error'] === 4) {
        // UBAH GAMBAR LAMA JADI GAMBAR BARU
        $gambar = $gambarLama;
    } else {
        // TETAP UPLOAD GAMBAR
        $gambar = upload();
    }
    // PERINTAH UPDATE DATA
    $query = "UPDATE hewan SET 
        nama = '$nama',
        lingkungan = '$lingkungan',
        makanan = '$makanan',
        kaki = '$kaki',
        gambar = '$gambar'
        WHERE id = $id;
    ";
    // MENGIRIM PERINTAH UPDATE KE DATABASE
    mysqli_query($conn, $query);
    // MENGMBALIKAN NILAI DARI KONEKSI
    return mysqli_affected_rows($conn);
}
// FUNGSI MENCARI DATA
function cari($keyword)
{
    // PERINTAH TAMPILAN UNTUK PENCARIAN
    $query = "SELECT * FROM hewan WHERE
        nama LIKE '%$keyword%' OR
        lingkungan LIKE '%$keyword%' OR
        makanan LIKE '%$keyword%' OR
        kaki LIKE '%$keyword%' OR
        gambar LIKE '%$keyword%'
        ";
    // MENGIRIM KE FUNGI QUERY AGAR MASUK KE DATABASE
    return query($query);
}

function daftar($data)
{
    // AMBIL VARIABEL CONN DILUAR FUNGSI
    global $conn;
    // STRIPSLAHES: BERFUNGSI MENGHILANGKAN BACKSLASH
    $username = strtolower(stripslashes($data['username']));
    // mysqli_real_escape_string: BERFUNGSI UNTUK MEMBIARKAN TANDA HTML MASUK KE INPUT
    $password1 = mysqli_real_escape_string($conn, $data['password1']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    // JIKA PASSWORD ASLI DAN CONFIRM TIDAK SAMA
    if ($password1 != $password2) {
        // TAMPILKAN PUPUP PASWORD SALAH
        echo "<script>
        alert('Password yang anda masukkan tidak sama');
        </script>";
        // KEMBALIKAN NILAI SALAH
        return false;
    }
    // MEMEMRIKSA KESAMAAN USERNAME
    // AMBIL DI DATABASE
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    // JIKA TERDAPAT SEBUAH NILAI DATA DI RESULT
    if (mysqli_fetch_assoc($result)) {
        // TAMPILKAN PUPUP GANTI
        echo "<script>
        alert('Username Tersedia Silahkan Ganti Username!');
        </script>";
        // KEMBALIKAN NILAI SALAH
        return false;
    }
    // ENKRIPSI PASSWORD AGAR TIDAK MUDAH DIBACA USER DAN PROGRAMMER
    // PASSWORD_HASH: MENGACAK PASSWORD
    // PASSWORD_HASH(NILAI, ALGORITMA)
    $password1 = password_hash($password1, PASSWORD_DEFAULT);
    // MENAMBAHKAN USER KEDALAM TABLE DI DATABASE
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password1')");
    // KEMBALIKAN NILAI AFEECTED
    return mysqli_affected_rows($conn);
}
