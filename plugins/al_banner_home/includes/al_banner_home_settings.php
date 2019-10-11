<?php

//Adiciona criação do novo menu no hook do Wordpress
add_action("admin_menu", "al_banner_home_menu");
function al_banner_home_menu()
{
    add_menu_page(
        "Banner Home",
        "Banner Home",
        "manage_options",
        "banner-home",
        "al_banner_home_menu_pagina"
    );

}

//Conteúdo que será mostrado ao clicar no botão do menu
function al_banner_home_menu_pagina()
{
    ?>
    <div class="wrap">
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            do_settings_sections('banner-home');
            settings_fields('al_banner_home_settings');
            settings_errors('al_banner_mensagens');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

//Criação da seção e campo que serão inseridos na página
add_action('admin_init', 'al_banner_home_secao_texto');
function al_banner_home_secao_texto()
{
    add_settings_section(
        'al_banner_home_secao',
        'Banner Home Page',
        'al_banner_home_instrucao',
        'banner-home'
    );

    add_settings_field(
        'al_banner_home_campo_texto',
        'Texto para o banner',
        'al_banner_home_texto_callback',
        'banner-home',
        'al_banner_home_secao'
    );
    register_setting(
        'al_banner_home_settings',
        'al_banner_home_campo_texto'
    );
}

//Imprime conteúdo instrução da seção
function al_banner_home_instrucao()
{
    echo '<p>Insira o texto e imagem do banner que serão usados na Home Page da Alurinha</p>';
}

//Imprime campo input do texto do banner
function al_banner_home_texto_callback()
{
    $textoBanner = get_option('al_banner_home_campo_texto');
    echo '<input required type="text" id="al_banner_home_campo_texto" name="al_banner_home_campo_texto" value="' . esc_attr($textoBanner) . '" />';
}

//Adiciona configuração do campo do banner
add_action('admin_init', 'al_banner_home_imagem');
function al_banner_home_imagem()
{
    add_settings_field(
        'al_banner_home_imagem_upload',
        'Banner',
        'al_banner_home_imagem_callback',
        'banner-home',
        'al_banner_home_secao'
    );
    register_setting(
        'al_banner_home_settings',
        'al_banner_home_imagem_upload',
        'verifica_arquivo_enviado'
    );

}

//Imprime input do banner
function al_banner_home_imagem_callback()
{
    echo '<input type="file" id="al_banner_home_imagem_upload" name="al_banner_home_imagem_upload" required/>';
    echo get_option('al_banner_home_imagem_upload');
}

//Função para fazer verificação do bannere realizar upload
function verifica_arquivo_enviado()
{
    $urls = wp_handle_upload($_FILES["al_banner_home_imagem_upload"], array('test_form' => FALSE,
        'mimes' => array('png' => 'image/png', 'jpeg' => 'images/jpeg', 'jpg' => 'image/jpeg')));
    $urlDoArquivo = $urls["url"];
    if (empty($urlDoArquivo)) {
        add_settings_error(
            'al_banner_mensagens',
            'al_banner_mensagem_erro',
            'Imagem inválida!',
            'error'
        );
    }else{
        add_settings_error(
            'al_banner_mensagens',
            'al_banner_mensagem_sucesso',
            'Configuração salva com sucesso',
            'updated'
        );
    }
    return $urlDoArquivo;
}