import '../scss/barbecue-find.scss';

$(function() {
    $('#rent_date').attr('min', new Date().toISOString().split("T")[0]);
});