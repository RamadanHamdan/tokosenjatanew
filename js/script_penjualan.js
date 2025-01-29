$(document).ready(function() {
    // hilangkan tombol cari
    $('#tombol-cari-penjualan').hide();
    // event ketika keyword ditulis
    $('#keyword_penjualan').on('keyup',function() {
        // munculkan icon loading
        $('.loader').show();
        // ajax menggunakan load
        // $('#container').load('ajax/senjata.php?keyword=' + $('#keyword').val());
        $.get('ajax/penjualan.php?keyword_penjualan=' + $('#keyword_penjualan').val(), function(data){
            $('#container').html(data);
            $('.loader').hide();

        }); 
    });

});