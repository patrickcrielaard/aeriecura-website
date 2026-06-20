<?php
/**
 * ACF veldgroepen voor AerieCura — ACF FREE compatibel.
 *
 * Geen Options pages, geen repeaters — alleen basisvelden die ook in
 * de gratis ACF versie werken. Site-instellingen zitten in de Customizer
 * (zie inc/customizer.php).
 *
 * Wie ACF Pro heeft kan deze file uitbreiden met repeaters voor
 * sample_skus / brands op het CPT.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    /* -----------------------------------------------------------------
     * Productcategorie meta — basis (geen repeaters)
     * -------------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'      => 'group_aeriecura_cat',
        'title'    => __( 'Productcategorie meta', 'aeriecura' ),
        'fields'   => [
            [
                'key'           => 'field_aeriecura_cat_icon',
                'label'         => __( 'Icoon', 'aeriecura' ),
                'name'          => 'icon',
                'type'          => 'select',
                'choices'       => [
                    'heart-pulse'  => 'heart-pulse',
                    'droplet'      => 'droplet',
                    'thermometer'  => 'thermometer',
                    'wind'         => 'wind',
                    'activity'     => 'activity',
                    'scale'        => 'scale',
                    'package'      => 'package',
                    'shield-check' => 'shield-check',
                ],
                'default_value' => 'package',
            ],
            [
                'key'         => 'field_aeriecura_cat_short_desc',
                'label'       => __( 'Korte beschrijving', 'aeriecura' ),
                'name'        => 'short_desc',
                'type'        => 'text',
                'maxlength'   => 120,
                'instructions'=> __( 'Max 120 tekens — wordt getoond op de homepage en in archief.', 'aeriecura' ),
            ],
            [
                'key'   => 'field_aeriecura_cat_item_count',
                'label' => __( 'Aantal artikelen', 'aeriecura' ),
                'name'  => 'item_count',
                'type'  => 'number',
                'min'   => 0,
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'productcategorie' ] ],
        ],
    ] );

    /* -----------------------------------------------------------------
     * Nieuws meta — type + leestijd
     * -------------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'      => 'group_aeriecura_post',
        'title'    => __( 'Nieuws meta', 'aeriecura' ),
        'fields'   => [
            [
                // NB: veldnaam mag niet 'post_type' zijn — dat is een
                // gereserveerde naam in WordPress (query var / kolomnaam).
                'key'     => 'field_aeriecura_nieuws_type',
                'label'   => __( 'Type bericht', 'aeriecura' ),
                'name'    => 'nieuws_type',
                'type'    => 'select',
                'choices' => [
                    'productupdate'  => __( 'Productupdate',  'aeriecura' ),
                    'regelgeving'    => __( 'Regelgeving',    'aeriecura' ),
                    'klantverhaal'   => __( 'Klantverhaal',   'aeriecura' ),
                    'inzicht'        => __( 'Inzicht',        'aeriecura' ),
                    'bedrijfsnieuws' => __( 'Bedrijfsnieuws', 'aeriecura' ),
                ],
            ],
            [
                'key'   => 'field_aeriecura_read_time',
                'label' => __( 'Leestijd (minuten)', 'aeriecura' ),
                'name'  => 'read_time',
                'type'  => 'number',
                'min'   => 1,
                'max'   => 60,
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ],
        ],
    ] );
} );
