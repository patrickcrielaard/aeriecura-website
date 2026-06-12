<?php
/**
 * Login link in de header.
 *
 * In Header Builder een Custom HTML block aanmaken met de shortcode:
 *   [aeriecura_login]
 * (HTML-blocks voeren geen PHP uit; in eigen templates kan wel direct
 * aeriecura_login_link() worden aangeroepen — zie header.php.)
 *
 * Toekomstige aeriecura-admin plugin overschrijft URL/label via filters
 * — geen aanpassing aan het theme nodig.
 */

defined( 'ABSPATH' ) || exit;

function aeriecura_login_link() : void {
    $url   = apply_filters( 'aeriecura_login_url',   wp_login_url( home_url() ) );
    $label = apply_filters( 'aeriecura_login_label', __( 'Inloggen', 'aeriecura' ) );
    $icon  = apply_filters( 'aeriecura_login_icon',  'lock' );

    if ( is_user_logged_in() ) {
        $url   = apply_filters( 'aeriecura_logged_in_url',   admin_url() );
        $label = apply_filters( 'aeriecura_logged_in_label', __( 'Mijn account', 'aeriecura' ) );
        $icon  = apply_filters( 'aeriecura_logged_in_icon',  'user' );
    }

    printf(
        '<a class="login-link" href="%s" title="%s">%s<span>%s</span></a>',
        esc_url( $url ),
        esc_attr__( 'Inloggen op het beheer', 'aeriecura' ),
        aeriecura_icon_html( $icon, 13 ),
        esc_html( $label )
    );
}

/**
 * Maak het ook beschikbaar als shortcode voor wie geen PHP wil aanraken
 * in de Header Builder.
 */
add_shortcode( 'aeriecura_login', function () {
    ob_start();
    aeriecura_login_link();
    return ob_get_clean();
} );
