<?php

//Adicionar Widget no hook do wordpress
add_action('widgets_init', 'al_pat_pal_registra_widget');
function al_pat_pal_registra_widget()
{
    register_widget('PatrocinadoresAlurinha');
}


class PatrocinadoresAlurinha extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'al_pat_pal',
            'Patrocinadores Alurinha',
            array('description' => 'Selecione os patrocinadores da palestra')
        );
    }

    //Formulário usado no backend
    public function form($instance)
    {
        $caelum = $instance['caelum'];
        $casa_do_codigo = $instance['casa_do_codigo'];
        $hipsters = $instance['hipsters'];
        ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('caelum'); ?>"
                   name="<?php echo $this->get_field_name('caelum'); ?>"
                   value="1" <?php checked("1", esc_attr($caelum)) ?>/>
            <label for="<?php echo $this->get_field_id('caelum'); ?>">Caelum</label>


        </p>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('casa_do_codigo'); ?>"
                   name="<?php echo $this->get_field_name('casa_do_codigo'); ?>"
                   value="1" <?php checked("1", esc_attr($casa_do_codigo)) ?>/>
            <label for="<?php echo $this->get_field_id('caelum'); ?>">Casa do Código</label>

        </p>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('hipsters'); ?>"
                   name="<?php echo $this->get_field_name('hipsters'); ?>"
                   value="1" <?php checked("1", esc_attr($hipsters)) ?>/>
            <label for="<?php echo $this->get_field_id('hipsters'); ?>">Hipsters Tech</label>

        </p>
        <?php

    }

    //Salvando alterações no banco
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['caelum'] = !empty($new_instance['caelum']) ? strip_tags($new_instance['caelum']) : '';
        $instance['casa_do_codigo'] = !empty($new_instance['casa_do_codigo']) ? strip_tags($new_instance['casa_do_codigo']) : '';
        $instance['hipsters'] = !empty($new_instance['hipsters']) ? strip_tags($new_instance['hipsters']) : '';
        return $instance;
    }

    //Conteúdo do widget
    public function widget($args, $instance)
    {
        ?>
        <section class="patrocinadores-principais">
            <h3 class="titulo-patrocinadores">Patrocinadores</h3>
            <ul class="lista-patrocinadores">
                <?php
                if (!empty($instance['caelum'])): ?>
                    <li><img src="<?= plugin_dir_url(__FILE__) . '../images/caelum.svg'; ?>"</li>
                <?php endif; ?>
                <?php
                if (!empty($instance['casa_do_codigo'])): ?>
                    <li><img src="<?= plugin_dir_url(__FILE__) . '../images/cdc.svg'; ?>"</li>
                <?php endif; ?>
                <?php
                if (!empty($instance['hipsters'])): ?>
                    <li><img src="<?= plugin_dir_url(__FILE__) . '../images/hipsters.svg'; ?>"</li>
                <?php endif; ?>
            </ul>
        </section>
        <?php
    }
}