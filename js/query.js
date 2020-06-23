// $ | JQUERY
// JQUERY CARIKAN SAYA DOCUMENT JIKA SUDAH SIAP JALANKAN FUNGSI
$(document).ready(function () {
    // HILANGKAN TOMBOL CARI
    $('#tombol-cari').hide();
    // JIKA EVENT KEYWORD DITULIS JALANKAN FUNGSI
    $('#keyword').on('keyup', function () {
        // MEMUNCULKAN LOADER
        $('.loader').show();
        // // CARA: AJAX MENGGUNAKAN LOAD
        // $('#container').load('ajax/hewan.php?keyword=' + $('#keyword').val());
        // CARA: $.GET()
        // AMBIL DATA DARI FILE HEWAN LALU JALANKAN FUNGSI
        $.get('ajax/hewan.php?keyword=' + $('#keyword').val(), function (data) {
            // TEMUKAN DATA
            $('#container').html(data);
            // JIKA SUDAH KETEMU SMEBUNYIKAN LOADER
            $('.loader').hide();
        })
    })
})