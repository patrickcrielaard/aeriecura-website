<?php
/**
 * AerieCura shortcodes — bedoeld om in UX Builder gedropt te worden.
 *
 *   [aeriecura_hero variant="a" eyebrow="..." title="..." lead="..."
 *                    cta_label="..." cta_url="..." cta2_label="..." cta2_url="..."]
 *
 *   [aeriecura_categories]
 *   [aeriecura_trust_strip]
 *   [aeriecura_value_props eyebrow="..." title="..." lead="..."]
 *   [aeriecura_stats     eyebrow="..." title="..." lead="..."]
 *   [aeriecura_news]
 *   [aeriecura_cta_band  eyebrow="..." title="..." text="..."
 *                        cta_label="..." cta_url="..."
 *                        cta2_label="..." cta2_url="..."]
 *
 * Elke shortcode rendert de bijbehorende /parts/ partial — de partial leest
 * de attributen via get_query_var('ac_…').
 */

defined( 'ABSPATH' ) || exit;

/**
 * Helper — render een partial met de gegeven $vars als query-vars.
 */
function aeriecura_render_partial( string $template, array $vars = [] ) : string {
    foreach ( $vars as $k => $v ) {
        if ( $v !== '' && $v !== null ) {
            set_query_var( $k, $v );
        }
    }
    ob_start();
    get_template_part( $template );
    $out = ob_get_clean();

    // Cleanup
    foreach ( array_keys( $vars ) as $k ) {
        set_query_var( $k, null );
    }
    return $out;
}

/* ---------------------------------------------------------------------------
 * Hero
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_hero', function ( $atts ) {
    $a = shortcode_atts( [
        'variant'    => 'a',
        'eyebrow'    => '',
        'title'      => '',
        'lead'       => '',
        'cta_label'  => '',
        'cta_url'    => '',
        'cta2_label' => '',
        'cta2_url'   => '',
    ], $atts );

    return aeriecura_render_partial( 'parts/hero', [
        'ac_hero_variant'    => $a['variant'],
        'ac_hero_eyebrow'    => $a['eyebrow'],
        'ac_hero_title'      => $a['title'],
        'ac_hero_lead'       => $a['lead'],
        'ac_hero_cta_label'  => $a['cta_label'],
        'ac_hero_cta_url'    => $a['cta_url'],
        'ac_hero_cta2_label' => $a['cta2_label'],
        'ac_hero_cta2_url'   => $a['cta2_url'],
    ] );
} );

/* ---------------------------------------------------------------------------
 * Categories grid
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_categories', function ( $atts ) {
    $a = shortcode_atts( [ 'bg' => '' ], $atts );
    return aeriecura_render_partial( 'parts/categories', [
        'ac_section_bg' => $a['bg'],
    ] );
} );

/* ---------------------------------------------------------------------------
 * Trust strip
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_trust_strip', function () {
    return aeriecura_render_partial( 'parts/trust-strip' );
} );

/* ---------------------------------------------------------------------------
 * Value props
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_value_props', function ( $atts ) {
    $a = shortcode_atts( [
        'eyebrow' => '',
        'title'   => '',
        'lead'    => '',
        'bg'      => 'alt',
    ], $atts );

    return aeriecura_render_partial( 'parts/value-props', [
        'ac_vp_eyebrow'   => $a['eyebrow'],
        'ac_vp_title'     => $a['title'],
        'ac_vp_lead'      => $a['lead'],
        'ac_section_bg'   => $a['bg'],
    ] );
} );

/* ---------------------------------------------------------------------------
 * Stats + certs
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_stats', function ( $atts ) {
    $a = shortcode_atts( [
        'eyebrow' => '',
        'title'   => '',
        'lead'    => '',
        'bg'      => '',
    ], $atts );

    return aeriecura_render_partial( 'parts/stats-band', [
        'ac_stats_eyebrow' => $a['eyebrow'],
        'ac_stats_title'   => $a['title'],
        'ac_stats_lead'    => $a['lead'],
        'ac_section_bg'    => $a['bg'],
    ] );
} );

/* ---------------------------------------------------------------------------
 * News teaser
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_news', function ( $atts ) {
    $a = shortcode_atts( [ 'bg' => 'alt' ], $atts );
    return aeriecura_render_partial( 'parts/news-grid', [
        'ac_section_bg' => $a['bg'],
    ] );
} );

/* ---------------------------------------------------------------------------
 * CTA band
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_cta_band', function ( $atts ) {
    $a = shortcode_atts( [
        'eyebrow'    => '',
        'title'      => '',
        'text'       => '',
        'cta_label'  => '',
        'cta_url'    => '',
        'cta2_label' => '',
        'cta2_url'   => '',
        'bg'         => '',
    ], $atts );

    return aeriecura_render_partial( 'parts/cta-band', [
        'ac_section_bg'  => $a['bg'],
        'ac_cta_eyebrow' => $a['eyebrow'],
        'ac_cta_title'   => $a['title'],
        'ac_cta_text'    => $a['text'],
        'ac_cta_label'   => $a['cta_label'],
        'ac_cta_url'     => $a['cta_url'],
        'ac_cta2_label'  => $a['cta2_label'],
        'ac_cta2_url'    => $a['cta2_url'],
    ] );
} );

/* ---------------------------------------------------------------------------
 * Page header — gebruikt op Over, B2B, Contact, etc.
 *   [aeriecura_page_header eyebrow="..." title="..." subtitle="..." crumb="..."]
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_page_header', function ( $atts ) {
    $a = shortcode_atts( [
        'eyebrow'  => '',
        'title'    => '',
        'subtitle' => '',
        'crumb'    => '',  // breadcrumb-label voor huidige pagina
    ], $atts );

    ob_start(); ?>
    <section class="page-header">
        <div class="shell">
            <?php if ( $a['crumb'] ) : ?>
                <div class="breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aeriecura' ); ?></a>
                    <span>›</span>
                    <span><?php echo esc_html( $a['crumb'] ); ?></span>
                </div>
            <?php endif; ?>
            <?php if ( $a['eyebrow'] ) : ?>
                <span class="eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></span>
            <?php endif; ?>
            <h1><?php echo esc_html( $a['title'] ); ?></h1>
            <?php if ( $a['subtitle'] ) : ?>
                <p><?php echo esc_html( $a['subtitle'] ); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
} );

/* ---------------------------------------------------------------------------
 * Contact info — leest Customizer waarden (phone, email, address, etc.)
 *   [aeriecura_contact_info]
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_contact_info', function () {
    $phone = aeriecura_setting( 'aeriecura_phone',    '+31 (0)182 000 000' );
    $email = aeriecura_setting( 'aeriecura_email',    'info@aeriecura.nl' );
    $a1    = aeriecura_setting( 'aeriecura_address1', 'Industrieweg 12' );
    $a2    = aeriecura_setting( 'aeriecura_address2', '2811 NP Reeuwijk' );
    $kvk   = aeriecura_setting( 'aeriecura_kvk',      '12345678' );
    $btw   = aeriecura_setting( 'aeriecura_btw',      'NL000000000B01' );
    $tel   = preg_replace( '/[^0-9+]/', '', $phone );

    ob_start(); ?>
    <div class="contact-info">
        <dl>
            <dt><?php esc_html_e( 'Bezoekadres', 'aeriecura' ); ?></dt>
            <dd><?php echo esc_html( $a1 ); ?><br><?php echo esc_html( $a2 ); ?></dd>

            <dt><?php esc_html_e( 'Telefoon', 'aeriecura' ); ?></dt>
            <dd>
                <a href="tel:<?php echo esc_attr( $tel ); ?>"><?php echo esc_html( $phone ); ?></a><br>
                <span class="muted" style="font-size:13px;"><?php esc_html_e( 'Ma–Vr 08:30 – 17:00', 'aeriecura' ); ?></span>
            </dd>

            <dt><?php esc_html_e( 'E-mail', 'aeriecura' ); ?></dt>
            <dd><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></dd>

            <dt><?php esc_html_e( 'KvK / BTW', 'aeriecura' ); ?></dt>
            <dd><?php echo esc_html( $kvk ); ?><br><?php echo esc_html( $btw ); ?></dd>
        </dl>
    </div>
    <?php
    return ob_get_clean();
} );

/* ---------------------------------------------------------------------------
 * Icon — handig voor UX Builder text blocks
 *   [aeriecura_icon name="heart-pulse" size="20"]
 * ------------------------------------------------------------------------ */
add_shortcode( 'aeriecura_icon', function ( $atts ) {
    $a = shortcode_atts( [ 'name' => 'check', 'size' => 20 ], $atts );
    return aeriecura_icon_html( (string) $a['name'], (int) $a['size'] );
} );
