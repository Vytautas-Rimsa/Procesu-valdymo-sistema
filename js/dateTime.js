$(function() {
    $('input[name="datetimes"]').daterangepicker({
        timePicker: true,
        startDate: moment().locale('lt-LT').startOf('hour'),
        endDate: moment().locale('lt-LT').startOf('hour').add(24, 'hour'),
        locale: {
            format: 'YYYY-MM-DD HH:mm'
        }
    });
});