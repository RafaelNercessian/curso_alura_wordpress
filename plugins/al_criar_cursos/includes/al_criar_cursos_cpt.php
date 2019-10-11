<?php

//Adicionado CPT ao hook do Wordpress
add_action('init', 'al_criar_cursos_cpt');
function al_criar_cursos_cpt()
{
    $labels = array(
        'name' => 'Cursos',
        'singular_name' => 'Curso',
        'add_new' => 'Adicionar Novo',
        'add_new_item' => 'Adicionar Novo Curso ',
        'edit' => 'Editar',
        'edit_item' => 'Editar Curso',
        'new_item' => 'Novo Curso ',
        'view' => 'Visualizar',
        'view_item' => 'Visualizar Curso',
        'search_items' => 'Buscar Cursos',
        'not_found' => 'Nenhum Curso Encontrado',
        'not_found_in_trash' => 'Nenhum Curso Encontrado na Lixeira',
        'menu_name' => 'Cursos'
    );
    $args = apply_filters('al_criar_cursos_args', array(
            'labels' => $labels,
            'description' => 'Cursos Alurinha',
            'taxonomies' => array('category'),
            'public' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book-alt',
            'show_in_nav_menus' => true,
            'capability_type' => 'post',
            'supports' => array('title', 'thumbnail'),
        )
    );
    register_post_type('cursos', $args);
}
