<?php

//Adiciona scripts no hook do Wordpress
add_action('wp_enqueue_scripts', 'al_local_dia_palestra_scripts');
function al_local_dia_palestra_scripts()
{
    wp_enqueue_style('al_local_dia_palestra_scripts_css', plugins_url() . '/al_local_dia_palestra/css/al_local_dia_palestra_style.css');
    wp_enqueue_script('al_local_dia_palestra_jquery', 'jquery', array(), false, true);
    wp_enqueue_script('al_local_dia_palestra_countdown', plugins_url() . '/al_local_dia_palestra/js/al_local_dia_palestra.countdown.min.js', array(), false, true);

    //Passando data do evento
    wp_register_script( 'al_calcula_data_evento', plugins_url() . '/al_local_dia_palestra/js/al_calcula_data_evento.js', array(), false, true );
    $data = get_option('al_local_dia_palestra_data');
    wp_localize_script( 'al_calcula_data_evento', 'data', $data );
    wp_enqueue_script( 'al_calcula_data_evento' );
}