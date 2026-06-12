<?php
/**
 * Theme functions — Flatsome AerieCura child theme.
 *
 * Boilerplate, klaar om door Claude Code te worden uitgebreid.
 *
 * @package aeriecura
 */

defined( 'ABSPATH' ) || exit;

define( 'AERIECURA_VERSION', '2.0.0' );
define( 'AERIECURA_PATH', get_stylesheet_directory() );
define( 'AERIECURA_URL',  get_stylesheet_directory_uri() );

/* ----------------------------------------------------------------------------
 * 1. Enqueue parent + child + tokens
 * ------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', function () {
    // Parent (Flatsome) styles — Flatsome registreert zelf 'flatsome-main';
    // dit is alleen een vangnet als de parent stylesheet niet via Flatsome's
    // eigen enqueue is geladen.
    if ( ! wp_style_is( 'flatsome-main', 'registered' ) ) {
        wp_enqueue_style(
            'flatsome-parent',
            get_template_directory_uri() . '/style.css',
            [],
            wp_get_theme( get_template() )->get( 'Version' )
        );
    }

    $parent_handle = wp_style_is( 'flatsome-main', 'registered' ) ? 'flatsome-main' : 'flatsome-parent';

    // Design tokens — must load before main stylesheet
    wp_enqueue_style(
        'aeriecura-tokens',
        AERIECURA_URL . '/assets/css/tokens.css',
        [ $parent_handle ],
        AERIECURA_VERSION
    );

    // Core AerieCura stylesheet (layout + components)
    wp_enqueue_style(
        'aeriecura-core',
        AERIECURA_URL . '/assets/css/aeriecura-core.css',
        [ 'aeriecura-tokens' ],
        AERIECURA_VERSION
    );

    // Wrapper stylesheet (mag leeg blijven, handig voor latere overrides)
    wp_enqueue_style(
        'aeriecura',
        AERIECURA_URL . '/assets/css/aeriecura.css',
        [ 'aeriecura-core' ],
        AERIECURA_VERSION
    );
}, 100 );

/* ----------------------------------------------------------------------------
 * 2. Includes
 * ------------------------------------------------------------------------- */
require_once AERIECURA_PATH . '/inc/icons.php';
require_once AERIECURA_PATH . '/inc/nav-walker.php';
require_once AERIECURA_PATH . '/inc/customizer.php';
require_once AERIECURA_PATH . '/inc/cpt-productcategorie.php';
require_once AERIECURA_PATH . '/inc/acf-fields.php';
require_once AERIECURA_PATH . '/inc/login-button.php';
require_once AERIECURA_PATH . '/inc/shortcodes.php';

/* ----------------------------------------------------------------------------
 * 3. Theme supports
 * ------------------------------------------------------------------------- */
add_action( 'after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption' ] );

    register_nav_menus( [
        'primary'  => __( 'Primair menu',       'aeriecura' ),
        'footer-1' => __( 'Footer — Producten', 'aeriecura' ),
        'footer-2' => __( 'Footer — Bedrijf',   'aeriecura' ),
        'footer-3' => __( 'Footer — Webshops',  'aeriecura' ),
        'footer-4' => __( 'Footer — Beheer',    'aeriecura' ),
    ] );
} );
