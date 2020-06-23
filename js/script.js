// MENAMGBIL ELEMENT
let keyword = document.getElementById("keyword");
let container = document.getElementById("container");
let tombolCari = document.getElementById("tombol-cari");

// TAMBAHKAN EVENT(AKSI) KETIKA INPUT DIMASUKKAN
keyword.addEventListener('keyup', function () {
    // MEMBUAT OBJEK AJAX
    // LET AJAX / XHR
    let xhr = new XMLHttpRequest();
    // CEK KESIAPAN AJAX
    xhr.onreadystatechange = function () {
        // JIKA AJAX SUDAH SIAP DENGAN READY 4 DAN STATUS 200
        if (xhr.readyState == 4 && xhr.status == 200) {
            // GANTI CONTAINER DARI APAPUN SUMBER RESPONSE NYA (HEWAN.PHP)
            container.innerHTML = xhr.responseText;
        }
    }
    // MENGEKSEKUSI AJAX
    // MENARUH KE PERINTAH URL DENGAN ASYNCRONOUS = TRUE
    xhr.open('GET', 'ajax/hewan.php?keyword=' + keyword.value, true);
    xhr.send();
})