<?php
/**
 * CTA band.
 *
 * [aeriecura_cta_band eyebrow="..." title="..." text="..."
 *                     cta_label="..." cta_url="..." cta2_label="..." cta2_url="..."]
 */

defined( 'ABSPATH' ) || exit;

$eyebrow    = get_query_var( 'ac_cta_eyebrow',    __( 'Klaar om te beginnen', 'aeriecura' ) );
$title      = get_query_var( 'ac_cta_title',      __( 'Een offerte op maat voor uw instelling', 'aeriecura' ) );
$text       = get_query_var( 'ac_cta_text',       __( 'Vertel ons wat u nodig heeft — we maken een vrijblijvend voorstel met staffelprijzen, levertijden en de bijbehorende documentatie.', 'aeriecura' ) );
$cta_label  = get_query_var( 'ac_cta_label',      __( 'Vraag een offerte aan', 'aeriecura' ) );
$cta_url    = get_query_var( 'ac_cta_url',        home_url( '/contact/' ) );
$cta2_label = get_query_var( 'ac_cta2_label',     __( 'B2B-platform', 'aeriecura' ) );
$cta2_url   = get_query_var( 'ac_cta2_url',       home_url( '/voor-zorgverleners/' ) );

$bg      = get_query_var( 'ac_section_bg', '' );
$sec_cls = trim( 'section ' . ( $bg ? 'section-' . sanitize_html_class( $bg ) : '' ) );
?>

<section class="<?php echo esc_attr( $sec_cls ); ?>">
<div class="shell">
<div class="cta-band">
    <div>
        <span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
        <h2><?php echo esc_html( $title ); ?></h2>
        <p><?php echo esc_html( $text ); ?></p>
    </div>
    <div class="cta-band-actions">
        <a class="btn btn-on-deep btn-lg" href="<?php echo esc_url( $cta_url ); ?>">
            <?php echo esc_html( $cta_label ); ?>
            <?php aeriecura_icon( 'arrow-right', 18, 'arrow' ); ?>
        </a>
        <?php if ( $cta2_label ) : ?>
            <a class="btn btn-outline-deep btn-lg" href="<?php echo esc_url( $cta2_url ); ?>">
                <?php echo esc_html( $cta2_label ); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
</div>
</section>
