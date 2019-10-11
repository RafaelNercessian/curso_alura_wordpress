<?php
/*
Plugin Name: Inserir Google Maps com data
Plugin URI: https://www.alura.com.br
Description: Plugin para inserir Google Maps e contagem regressiva
Version: 1.0.0
Author: Rafael Silva Nercessian
License: GPLv2 or later
*/
require_once plugin_dir_path(__FILE__) . '/includes/al_local_dia_palestra_scripts.php';
require_once plugin_dir_path(__FILE__) . '/includes/al_local_dia_palestra_settings.php';
require_once plugin_dir_path(__FILE__) . '/includes/al_local_dia_palestra_shortcode.php';

//Carrega script do admin só se usuário for Admin
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . '/includes/al_local_dia_palestra_scripts_admin.php';
}