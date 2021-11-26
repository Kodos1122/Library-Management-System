$(document).ready(function($) {
    
    $('#demo').innerHTML = 'asdf';
    $('#demo').fadeIn('slow');

    $('#client').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select a Client'
    }).on('select2:select', function(e) {
        var card = $('#client').find(":selected").data('card');
        $('#library_card').val(card);
        $('#library_card').unmask();
        $('#library_card').mask('9999-9999-9999-9999');
    }).on('select2:open', function() {
        document.querySelector('.select2-search__field').focus();
    });

    $('#reserve_date, #return_date').flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
});
