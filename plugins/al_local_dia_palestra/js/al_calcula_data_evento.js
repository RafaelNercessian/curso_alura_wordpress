jQuery("#evento").countdown(data.datepicker, function(event) {
    jQuery("#dias").html(event.strftime('%D Dias'));
    jQuery("#horas").html(event.strftime('%H Horas'));
    jQuery("#minutos").html(event.strftime('%M Min.'));
    jQuery("#segundos").html(event.strftime('%S Seg.'));
});