<?php

//Adiciona estilos
add_action('wp_enqueue_scripts', 'al_temperatura_palestra_scripts');
function al_temperatura_palestra_scripts()
{
    wp_enqueue_style('al_local_dia_palestra_scripts_css', plugins_url() . '/al_temperatura_palestra/css/al_temperatura_style.css');
}