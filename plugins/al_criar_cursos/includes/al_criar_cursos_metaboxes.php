<?php

//Adicionando meta boxes ao hook do Wordpress
add_action('add_meta_boxes', 'al_criar_cursos_metabox');
function al_criar_cursos_metabox()
{
    add_meta_box(
        'al_criar_cursos_metabox',
        'Campos cursos',
        'al_criar_cursos_metabox_callback',
        'cursos',
        'normal',
        'default'
    );
}

//Função usada para montar o conteúdo na tela admin do post customizado
function al_criar_cursos_metabox_callback($post)
{
    //Gera um token para o wordpress saber que nós quem estamos enviando a requisição
    //Evitar CSRF
    wp_nonce_field(basename(__FILE__), 'al_criar_cursos_nonce');
    $criar_curso_meta = get_post_meta($post->ID);
    ?>
    <div class="wrap video-form">
        <div class="form-group">
            <h2 for="video_url">Video URL</h2>
            <input type="text" name="video_url" id="video_url"
                   value="<?= esc_attr($criar_curso_meta['video_url'][0]) ?>">
        </div>
        <br><br>
        <div class="form-group">
            <h2 for="details">Faça esse curso:</h2>
            <?php
            $content = get_post_meta($post->ID, 'faca_esse_curso', true);
            $editor = 'faca_esse_curso';
            $settings = array(
                'textarea_rows' => 5,
                'media_buttons' => false
            );
            wp_editor($content, $editor, $settings);
            ?>
        </div>
        <br>
        <br>
        <div class="form-group">
            <h2 for="details">Conteúdo detalhado</h2>
            <?php
            $content = get_post_meta($post->ID, 'conteudo_detalhado', true);
            $editor = 'conteudo_detalhado';
            $settings = array(
                'textarea_rows' => 5,
                'media_buttons' => false
            );
            wp_editor($content, $editor, $settings);
            ?>
        </div>
    </div>
    <?php
}

//Salvando valores no banco
//Adicionamos função ao hook 'save_post' do Wordpress
add_action('save_post', 'al_criar_cursos_salva_mudancas');
function al_criar_cursos_salva_mudancas($post_id)
{
    $temTokenValido = (isset($_POST['al_criar_cursos_nonce']) &&
        wp_verify_nonce($_POST['al_criar_cursos_nonce'], basename(__FILE__))) ?
        'true' : 'false';

    //Se o token gerado é inválido, retorna e não salva os dados
    if(!$temTokenValido){
        return;
    }

    if (isset($_POST['video_url'])) {
        update_post_meta($post_id, 'video_url', sanitize_text_field($_POST['video_url']));
    }
    if (isset($_POST['faca_esse_curso'])) {
        update_post_meta($post_id, 'faca_esse_curso', wp_kses($_POST['faca_esse_curso'], al_criar_cursos_tags_html()));
    }

    if (isset($_POST['conteudo_detalhado'])) {
        update_post_meta($post_id, 'conteudo_detalhado', wp_kses($_POST['conteudo_detalhado'], al_criar_cursos_tags_html()));
    }
}

//Função para especificar as tags HTML válidas
function al_criar_cursos_tags_html()
{
    return array(
        'ul' => array(),
        'li' => array(
            'class'
        ),
        'ol' => array(
            'class'
        ),
        'h3' => array(
            'class'
        ),
    );
}
