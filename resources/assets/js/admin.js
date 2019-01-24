require('./bootstrap');

require('bootstrap-datepicker');

let dp = $('.datepicker');
dp.each(function() {
    $(this).datepicker({
        format: 'dd.mm.yyyy',
        autoUpdateInput: false,
        autoclose: true
    });
});
if ($('#pub_date').val() === '') {
    $('#pub_date').datepicker("setDate", new Date());
}

$('#confirmation').on('show.bs.modal', function (e) {
    $('#confirmation').find('.js-delete').attr('href', $(e.relatedTarget).data('follow'));
});