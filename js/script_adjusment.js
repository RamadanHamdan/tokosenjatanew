$(document).ready(function() {
    // hilangkan tombol cari
    $('#tombol-cari-adjusment').hide();
    // event ketika keyword ditulis
    $('#keyword_adjusment').on('keyup',function() {
        // munculkan icon loading
        $('.loader').show();
        // ajax menggunakan load
        // $('#container').load('ajax/senjata.php?keyword=' + $('#keyword').val());
        $.get('ajax/adjusment.php?keyword_adjusment=' + $('#keyword_adjusment').val(), function(data){
            $('#container').html(data);
            $('.loader').hide();

        }); 
    });

});