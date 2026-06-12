<?php
/**
 * Customizer-instellingen voor AerieCura.
 *
 * Vervangt de ACF Options page — werkt zonder ACF Pro (en zelfs zonder ACF Free).
 *
 * Beheer via WP-admin → Uiterlijk → Customizer → "AerieCura — Bedrijfsgegevens"
 * en "AerieCura — Lijsten".
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {

    /* -------------------------------------------------------------------
     * Section 1 — Bedrijfsgegevens
     * ---------------------------------------------------------------- */
    $wp_customize->add_section( 'aeriecura_company', [
        'title'    => __( 'AerieCura — Bedrijfsgegevens', 'aeriecura' ),
        'priority' => 30,
    ] );

    $company_fields = [
        'aeriecura_phone'    => [ 'label' => __( 'Telefoonnummer',         'aeriecura' ), 'default' => '+31 (0)182 000 000' ],
        'aeriecura_email'    => [ 'label' => __( 'E-mailadres',            'aeriecura' ), 'default' => 'info@aeriecura.nl', 'type' => 'email' ],
        'aeriecura_address1' => [ 'label' => __( 'Adres regel 1',          'aeriecura' ), 'default' => 'Industrieweg 12' ],
        'aeriecura_address2' => [ 'label' => __( 'Adres regel 2',          'aeriecura' ), 'default' => '2811 NP Reeuwijk' ],
        'aeriecura_kvk'      => [ 'label' => __( 'KvK-nummer',             'aeriecura' ), 'default' => '12345678' ],
        'aeriecura_btw'      => [ 'label' => __( 'BTW-nummer',             'aeriecura' ), 'default' => 'NL000000000B01' ],
        'aeriecura_tagline'  => [ 'label' => __( 'Footer-tagline',         'aeriecura' ), 'default' => 'Specialistische groothandel in diagnostiek- en monitoring-apparatuur voor zorgprofessionals.', 'type' => 'textarea' ],
    ];

    foreach ( $company_fields as $id => $cfg ) {
        $wp_customize->add_setting( $id, [
            'default'           => $cfg['default'],
            'sanitize_callback' => ( $cfg['type'] ?? '' ) === 'email' ? 'sanitize_email' : 'sanitize_text_field',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( $id, [
            'label'   => $cfg['label'],
            'section' => 'aeriecura_company',
            'type'    => $cfg['type'] ?? 'text',
        ] );
    }

    /* -------------------------------------------------------------------
     * Section 2 — Lijsten (één per regel)
     * ---------------------------------------------------------------- */
    $wp_customize->add_section( 'aeriecura_lists', [
        'title'       => __( 'AerieCura — Lijsten', 'aeriecura' ),
        'description' => __( 'Eén item per regel. Voor leveranciers en webshops: "Naam | URL".', 'aeriecura' ),
        'priority'    => 31,
    ] );

    $list_fields = [
        'aeriecura_suppliers'      => [
            'label'   => __( 'Leveranciers (trust-strip)', 'aeriecura' ),
            'default' => "Medisana\nWelch Allyn\nOmron\nBeurer\nA&D Medical\nMicrolife",
        ],
        'aeriecura_certifications' => [
            'label'   => __( 'Certificeringen', 'aeriecura' ),
            'default' => "ISO 9001:2015\nISO 13485\nMDR (EU) 2017/745\nWKKGZ\nGDP",
        ],
        'aeriecura_webshops'       => [
            'label'   => __( 'Webshops (Naam | URL)', 'aeriecura' ),
            'default' => "AerieCura Direct | https://direct.aeriecura.nl\nAerieCura Pro | https://pro.aeriecura.nl\nAerieCura Lab | https://lab.aeriecura.nl",
        ],
    ];

    foreach ( $list_fields as $id => $cfg ) {
        $wp_customize->add_setting( $id, [
            'default'           => $cfg['default'],
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( $id, [
            'label'   => $cfg['label'],
            'section' => 'aeriecura_lists',
            'type'    => 'textarea',
        ] );
    }
} );

/* =====================================================================
 * Helpers — lees de instellingen + parse de lijsten.
 * ================================================================== */

function aeriecura_setting( string $key, string $fallback = '' ) : string {
    $val = get_theme_mod( $key, '' );
    return $val !== '' ? $val : $fallback;
}

function aeriecura_list( string $key ) : array {
    $raw = (string) get_theme_mod( $key, '' );
    $lines = array_filter( array_map( 'trim', explode( "\n", $raw ) ) );

    // Pipe-separated → ['name' => …, 'url' => …]
    return array_map( function ( $line ) {
        if ( strpos( $line, '|' ) !== false ) {
            list( $name, $url ) = array_map( 'trim', explode( '|', $line, 2 ) );
            return [ 'name' => $name, 'url' => $url ];
        }
        return [ 'name' => $line, 'url' => '' ];
    }, $lines );
}
