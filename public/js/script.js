$(function() {

    $('.tombolTambahDataEvent').on('click', function() {
        $('#formModalLabel').html('Tambah Data Event');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#title').val('');
        $('#deskripsi').val('');
        $('#venue').val('');
        $('#date').val('');
        $('#time').val('');
        $('#number_of_participants').val('');
        $('#image').val('');
        $('#id').val('');
    });


    $('.tampilModalUbahEvent').on('click', function() {
        
        $('#formModalLabel').html('Ubah Data Event');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/event/ubah');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/phpmvc/public/event/getubah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#title').val(data.title);
                $('#deskripsi').val(data.deskripsi);
                $('#venue').val(data.venue);
                $('#number_of_participants').val(data.number_of_participants);
                $('#id').val(data.id);
            }
        });
        
    });

});


