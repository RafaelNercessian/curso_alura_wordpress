<?php

//Adiciona menu ao hook do Wordpress
add_action("admin_menu", "al_local_dia_palestra_menu");
function al_local_dia_palestra_menu()
{
    add_menu_page(
        "Local Palestra",
        "Local Palestra",
        "manage_options",
        "local-palestra",
        "al_local_dia_palestra_menu_pagina"
    );

}

//Conteúdo que será mostrado ao clicar no botão do menu
function al_local_dia_palestra_menu_pagina()
{
    ?>
    <div class="wrap">
        <h1>Local Palestras</h1>
        <form method="post" action="options.php">
            <?php
            do_settings_sections('local-palestra');
            settings_fields('al_local_dia_palestra_settings');
            settings_errors();
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

//Adiciona seção e endereço da palestra
add_action('admin_init', 'al_local_dia_palestra_secao_endereco');
function al_local_dia_palestra_secao_endereco()
{
    add_settings_section(
        'al_local_dia_palestra_secao',
        'Configurações local palestra',
        'al_local_dia_palestra_campos_secao_detalhes',
        'local-palestra'
    );

    add_settings_field(
        'al_local_dia_palestra_endereco',
        'Endereço',
        'al_local_dia_palestra_endereco_imprime_conteudo',
        'local-palestra',
        'al_local_dia_palestra_secao'
    );
    register_setting(
        'al_local_dia_palestra_settings',
        'al_local_dia_palestra_endereco'
    );

}

//Imprime detalhes da seção
function al_local_dia_palestra_campos_secao_detalhes()
{
    echo '<p>Insira aqui o endereço, cidade e local do próximo evento da Alurinha</p>';
}

//Imprime input do endereço
function al_local_dia_palestra_endereco_imprime_conteudo()
{
    $endereco = get_option('al_local_dia_palestra_endereco');
    echo '<input type="text" id="al_local_dia_palestra_endereco" name="al_local_dia_palestra_endereco" value="' . esc_attr($endereco) . '" required/>';
}

//Adiciona cidade
add_action('admin_init', 'al_local_dia_palestra_cidade');
function al_local_dia_palestra_cidade()
{
    add_settings_field(
        'al_local_dia_palestra_cidade',
        'Cidade',
        'al_local_dia_palestra_cidade_imprime_conteudo',
        'local-palestra',
        'al_local_dia_palestra_secao'
    );
    register_setting(
        'al_local_dia_palestra_settings',
        'al_local_dia_palestra_cidade'
    );

}

//Imprime input da cidade
function al_local_dia_palestra_cidade_imprime_conteudo()
{
    $cidade = get_option('al_local_dia_palestra_cidade');
    echo '<input type="text" id="al_local_dia_palestra_cidade" name="al_local_dia_palestra_cidade" value="' . esc_attr($cidade) . '" required/>';
}

//Adiciona data do evento
add_action('admin_init', 'insere_google_maps_datepicker');
function insere_google_maps_datepicker()
{
    add_settings_field(
        'al_local_dia_palestra_data',
        'Data',
        'al_local_dia_palestra_data_imprime_conteudo',
        'local-palestra',
        'al_local_dia_palestra_secao'
    );
    register_setting(
        'al_local_dia_palestra_settings',
        'al_local_dia_palestra_data'
    );
}

function al_local_dia_palestra_data_imprime_conteudo()
{
    $data = get_option('al_local_dia_palestra_data');
    echo '<input type="date" id="al_local_dia_palestra_data" name="al_local_dia_palestra_data[datepicker]" value="' . esc_attr($data["datepicker"]) . '" class="example-datepicker" required/>';
}