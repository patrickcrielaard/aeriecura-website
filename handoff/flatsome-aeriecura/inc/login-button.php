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
    // Wijst naar het externe B2B-portaal (opent in nieuw tabblad). De
    // toekomstige aeriecura-admin plugin kan URL/label/icoon nog steeds via
    // deze filters overschrijven — geen aanpassing aan het theme nodig.
    $url   = apply_filters( 'aeriecura_login_url',   'https://b2b.aeriecura.nl' );
    $label = apply_filters( 'aeriecura_login_label', __( 'Inloggen', 'aeriecura' ) );
    $icon  = apply_filters( 'aeriecura_login_icon',  'lock' );

    printf(
        '<a class="login-link" href="%s" title="%s" target="_blank" rel="noopener">%s<span>%s</span></a>',
        esc_url( $url ),
        esc_attr__( 'Naar het B2B-portaal', 'aeriecura' ),
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
