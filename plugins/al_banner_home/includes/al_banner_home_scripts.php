<?php

//Adicionando scripts no hook do Wordpress
add_action('wp_enqueue_scripts', 'al_banner_home_scripts_css');
function al_banner_home_scripts_css()
{
    wp_enqueue_style('estilos-banner', plugins_url() . '/al_banner_home/css/al_banner_home_estilos.css');
    wp_enqueue_script('jquery', 'jquery', array(), false, true);
    wp_enqueue_script('script-parallax', plugins_url() . '/al_banner_home/js/al_banner_home_estilos_parallax.min.js', array(), false, true);
}