<?php

//Adiciona scripts ao hook do Wordpress
add_action('wp_enqueue_scripts', 'al_cadastro_palestra_scripts_css');
function al_cadastro_palestra_scripts_css()
{
    wp_enqueue_style('al_cadastro_palestra_css', plugins_url() . '/al_cadastro_palestra/css/al_cadastro_palestro_style.css');
}