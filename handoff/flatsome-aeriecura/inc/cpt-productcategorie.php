<?php
/**
 * Custom Post Type: productcategorie
 *
 * Eén entry per assortimentscategorie (Bloeddrukmeters, Thermometers, …).
 * Wordt automatisch ge-rendered op de Home en de Producten archive.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
    register_post_type( 'productcategorie', [
        'labels' => [
            'name'          => __( 'Productcategorieën', 'aeriecura' ),
            'singular_name' => __( 'Productcategorie',   'aeriecura' ),
            'add_new_item'  => __( 'Nieuwe categorie',   'aeriecura' ),
            'edit_item'     => __( 'Categorie bewerken', 'aeriecura' ),
            'menu_name'     => __( 'Categorieën',        'aeriecura' ),
        ],
        'public'       => true,
        'has_archive'  => 'producten',
        'rewrite'      => [ 'slug' => 'producten' ],
        'menu_icon'    => 'dashicons-heart',
        'show_in_rest' => true,
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
        'hierarchical' => false,
    ] );
} );
