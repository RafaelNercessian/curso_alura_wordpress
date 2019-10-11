<?php

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

require 'vendor/autoload.php';

//Adicionar Widget no hook do wordpress
add_action('widgets_init', 'al_temp_palestra_widget');
function al_temp_palestra_widget()
{
    register_widget('TemperaturaLocalPalestra');
}


class TemperaturaLocalPalestra extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'al_temp_palestra',
            'Temperatura Local Palestra',
            array('description' => 'Mostra a temperatura no local da palestra')
        );
    }


    //Conteúdo do widget
    public function widget($args, $instance)
    {
        $lang = 'pt';
        $units = 'metric';
        $httpRequestFactory = new RequestFactory();
        $httpClient = GuzzleAdapter::createWithConfig(['verify' => false]);
        $owm = new OpenWeatherMap(API_KEY_OPEN_WEATHER, $httpClient, $httpRequestFactory);

        try {
            $weather = $owm->getWeather(get_option('al_local_dia_palestra_cidade'), $units, $lang);
        } catch (OWMException $e) {
            error_log("Houve uma exception com o Open Weather " . print_r($e->getMessage(), 1));
        } catch (\Exception $e) {
            error_log("Houve uma exception genérica " . print_r($e->getMessage(), 1));
        }


        ?>
        <div class="container-temperatura">
            <p class="temperatura-titulo"><?= esc_attr(get_option('al_local_dia_palestra_cidade')) ?></p>
            <p class="temperatura"><?= $weather->temperature ?></p>
        </div>
        <?php
    }
}