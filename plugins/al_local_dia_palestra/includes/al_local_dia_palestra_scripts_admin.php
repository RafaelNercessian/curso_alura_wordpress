<?php

//Adiciona script do datepicker para mostrar o calendário no dashboard do admin
add_action('admin_enqueue_scripts', 'enqueue_date_picker');
function enqueue_date_picker()
{
    wp_enqueue_script(
        'al_local_dia_palestra_datepicker_scripts',
        'datepicker',
        array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
        false,
        true
    );
    wp_enqueue_style('al_local_dia_palestra_datepicker_css');
}