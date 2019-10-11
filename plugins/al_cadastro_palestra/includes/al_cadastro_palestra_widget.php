<?php

//Adiciona o Widget no Hook do Wordpress
add_action('widgets_init', 'al_cadastro_palestra_registra');
function al_cadastro_palestra_registra()
{
    register_widget('CadastroPalestra');
}


class CadastroPalestra extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct(
            'al_cadastro_palestra_widget',
            'Cadastro Palestra',
            array(
                'description' => 'Enviando email contato',
            ));
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        ?>
        <div id="form-msg"></div>
        <br>
        <form class="rodapePrincipal-contatoForm"
              action="<?= plugins_url() . '/al_cadastro_palestra/includes/al_cadastro_palestra_envio_email.php' ?>"
              method="post">
            <?php wp_nonce_field(basename(__FILE__), 'al_cadastro_palestra_nonce'); ?>
            <fieldset>
                <legend class="rodapePrincipal-contatoForm-legend" for="email-contato">Cadastre para a palestra</legend>
                <div class="rodapePrincipal-contatoForm-fieldset">
                    <input class="rodapePrincipal-contatoForm-emailInput" type="email" name="email-contato"
                           id="email-contato">
                    <button class="rodapePrincipal-contatoForm-submit" type="submit">Enviar</button>
                </div>
                <?php if(isset($_GET['envio']) &&  $_GET['envio'] == 'sucesso'){ ?>
                    <p class="sucesso">E-mail enviado com sucesso</p>
                <?php } else if(isset($_GET['envio']) &&  $_GET['envio'] == 'erro'){ ?>
                    <p class="erro">Erro ao enviar e-mail</p>
                <?php } ?>
            </fieldset>
            <input type="hidden" name="senha" value="<?= esc_attr(trim($instance['senha'])) ?>">
            <input type="hidden" name="destinatario" value="<?= esc_attr(trim($instance['destinatario'])) ?>">
        </form>
        <?php
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $destinatario = esc_attr(trim($instance['destinatario']));
        $senha = esc_attr(trim($instance['senha']));
        ?>
        <p>
            <label for="<?= $this->get_field_id('destinatario') ?>">Destinatário:</label><br>
            <input type="text" id="<?= $this->get_field_id('destinatario') ?>"
                   name="<?= $this->get_field_name('destinatario') ?>" value="<?= $destinatario ?>">
        </p>
        <p>
            <label for="<?= $this->get_field_id('senha') ?>">Senha:</label><br>
            <input type="password" id="<?= $this->get_field_id('senha') ?>" name="<?= $this->get_field_name('senha') ?>"
                   value="<?= $senha ?>">
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $temTokenValido = (isset($_POST['al_cadastro_palestra_nonce']) &&
            wp_verify_nonce($_POST['al_cadastro_palestra_nonce'], basename(__FILE__))) ?
            'true' : 'false';

        if(!$temTokenValido){
            return;
        }

        $instance = array(
            'destinatario' => !empty($new_instance['destinatario']) ? strip_tags(trim($new_instance['destinatario'])) : '',
            'senha' => !empty($new_instance['senha']) ? strip_tags(trim($new_instance['senha'])) : '',
        );
        return $instance;
    }
}

