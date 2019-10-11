<?php get_header() ?>
    <main class="conteudoPrincipal">
        <div class="conteudo-banner"><?= get_option('al_banner_home_campo_texto'); ?></div>
        <div class="img-holder" data-image="<?= get_option('al_banner_home_imagem_upload'); ?>"></div>
        <div class="container">
            <h2 class="subtitulo">Nossos lançamentos</h2>
            <nav>
                <ul class="conteudoPrincipal-cursos">
                    <?php
                    $args = array(
                        'post_type' => 'cursos',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => 'lancamentos'
                            )
                        ));
                    $cursos = new WP_Query($args);
                    if ($cursos->have_posts()):
                        while ($cursos->have_posts()):
                            $cursos->the_post();
                            ?>
                            <li class="conteudoPrincipal-cursos-link"><span
                                        class="thumbnail-curso"><?= the_post_thumbnail(); ?></span><a
                                        href="<?= the_permalink() ?>"><?= the_title() ?></a></li>
                        <?php endwhile; ?>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                </ul>
            </nav>
        </div>

        <section class="videoSobre">
            <div class="container">
                <iframe class="videoSobre-video" width="560" height="315"
                        src="https://www.youtube.com/embed/bIlOsJzBVaY?list=PLh2Y_pKOa4UcF1BYPJR3EIMRi3nWAUxIp"
                        frameborder="0" allowfullscreen></iframe>

                <div class="videoSobre-sobre">
                    <h2 class="videoSobre-sobre-title">Vantagens do Alurinha</h2>
                    <ul class="videoSobre-sobre-list">
                        <li class="videoSobre-sobre-item">Estude onde quiser</li>
                        <li class="videoSobre-sobre-item">Novos cursos todos os meses</li>
                        <li class="videoSobre-sobre-item">Cursos compatíveis com o mercado</li>
                    </ul>
                    <button class="videoSobre-button">Cadastre-se já</button>
                </div>
            </div>
        </section>

    </main>
<?php get_footer(); ?>