<?php
/**
 * Productcategorie-grid — self-contained section.
 */

defined( 'ABSPATH' ) || exit;

$bg = get_query_var( 'ac_section_bg', '' );
$sec_class = trim( 'section ' . ( $bg ? 'section-' . sanitize_html_class( $bg ) : '' ) );

$cats = get_posts( [
    'post_type'      => 'productcategorie',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

$rows = [];
if ( $cats ) {
    foreach ( $cats as $cat ) {
        $rows[] = [
            'title' => $cat->post_title,
            'desc'  => function_exists( 'get_field' ) ? ( get_field( 'short_desc', $cat->ID ) ?: $cat->post_excerpt ) : $cat->post_excerpt,
            'icon'  => function_exists( 'get_field' ) ? ( get_field( 'icon', $cat->ID ) ?: 'package' ) : 'package',
            'url'   => get_permalink( $cat ),
        ];
    }
} else {
    $rows = [
        [ 'title' => __( 'Bloeddrukmeters',   'aeriecura' ), 'desc' => __( 'Klinisch gevalideerde manuele en automatische metingen.', 'aeriecura' ), 'icon' => 'heart-pulse', 'url' => home_url( '/producten/' ) ],
        [ 'title' => __( 'Bloedsuikermeters', 'aeriecura' ), 'desc' => __( 'Glucosemeters, teststrips en lancetten.',                  'aeriecura' ), 'icon' => 'droplet',     'url' => home_url( '/producten/' ) ],
        [ 'title' => __( 'Thermometers',      'aeriecura' ), 'desc' => __( 'Tympaan, contactloos en kerntemperatuur.',                'aeriecura' ), 'icon' => 'thermometer', 'url' => home_url( '/producten/' ) ],
        [ 'title' => __( 'Saturatiemeters',   'aeriecura' ), 'desc' => __( 'Pulse-oximetrie voor screening en monitoring.',           'aeriecura' ), 'icon' => 'wind',        'url' => home_url( '/producten/' ) ],
        [ 'title' => __( 'ECG-apparatuur',    'aeriecura' ), 'desc' => __( '12-leads klinisch en draagbare event recorders.',         'aeriecura' ), 'icon' => 'activity',    'url' => home_url( '/producten/' ) ],
        [ 'title' => __( 'Weegschalen',       'aeriecura' ), 'desc' => __( 'Personen-, baby- en bedweegschalen — gevalideerd.',       'aeriecura' ), 'icon' => 'scale',       'url' => home_url( '/producten/' ) ],
    ];
}
?>

<section class="<?php echo esc_attr( $sec_class ); ?>">
    <div class="shell">
        <div class="section-head">
            <div>
                <span class="eyebrow"><?php esc_html_e( 'Productcategorieën', 'aeriecura' ); ?></span>
                <h2><?php esc_html_e( 'Zes categorieën, één betrouwbare leverancier', 'aeriecura' ); ?></h2>
            </div>
            <p class="lead"><?php esc_html_e( 'Diagnostiek- en monitoring-apparatuur die past bij de werkelijke zorgpraktijk: betrouwbaar, MDR-conform en met snelle levertijden.', 'aeriecura' ); ?></p>
        </div>

        <div class="cat-grid-compact">
            <?php foreach ( $rows as $r ) : ?>
                <a class="cat-tile" href="<?php echo esc_url( $r['url'] ); ?>">
                    <div class="cat-tile-icon"><?php aeriecura_icon( $r['icon'], 26 ); ?></div>
                    <div>
                        <h3 class="cat-tile-title"><?php echo esc_html( $r['title'] ); ?></h3>
                        <?php if ( $r['desc'] ) : ?>
                            <p class="cat-tile-desc"><?php echo esc_html( $r['desc'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="cat-tile-meta"><?php esc_html_e( 'MDR conform', 'aeriecura' ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
