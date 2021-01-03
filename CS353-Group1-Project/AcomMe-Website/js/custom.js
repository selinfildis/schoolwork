$(function () {

    $('input[name="DateRange"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'YYYY/MM/DD',
            cancelLabel: 'Clear'
        }
    });

    $('input[name="DateRange"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });

    $('input[name="DateRange"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
});

$(function () {
    $('select').multipleSelect();
});