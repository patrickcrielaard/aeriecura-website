<?php
/**
 * Hero — variant a (split met productkaart-illustratie).
 *
 * Attributen via [aeriecura_hero variant="a" eyebrow="..." title="..."
 *                                lead="..." cta_label="..." cta_url="..."
 *                                cta2_label="..." cta2_url="..."]
 */

defined( 'ABSPATH' ) || exit;

$variant    = get_query_var( 'ac_hero_variant',    'a' );
$eyebrow    = get_query_var( 'ac_hero_eyebrow',    __( 'Specialistische groothandel', 'aeriecura' ) );
$title      = get_query_var( 'ac_hero_title',      __( 'Diagnostiek en monitoring die u kunt vertrouwen.', 'aeriecura' ) );
$lead       = get_query_var( 'ac_hero_lead',       __( 'AerieCura levert hoogwaardige medische apparatuur aan ziekenhuizen, huisartsenpraktijken en thuiszorg-organisaties. MDR-conform, met snelle levering en gespecialiseerde ondersteuning door product-experts.', 'aeriecura' ) );
$cta_label  = get_query_var( 'ac_hero_cta_label',  __( 'Bekijk ons assortiment', 'aeriecura' ) );
$cta_url    = get_query_var( 'ac_hero_cta_url',    home_url( '/producten/' ) );
$cta2_label = get_query_var( 'ac_hero_cta2_label', __( 'Neem contact op', 'aeriecura' ) );
$cta2_url   = get_query_var( 'ac_hero_cta2_url',   home_url( '/contact/' ) );

$variant_class = 'hero-variant-' . sanitize_html_class( $variant );

$illu_tiles = [
    [ 'icon' => 'heart-pulse', 'label' => __( 'Bloeddrukmeter',    'aeriecura' ), 'spec' => 'BP-1860', 'meta' => 'MDR · klasse IIa' ],
    [ 'icon' => 'thermometer', 'label' => __( 'Tympaanthermometer','aeriecura' ), 'spec' => 'TM-2410', 'meta' => 'IR · ±0.2°C' ],
    [ 'icon' => 'wind',        'label' => __( 'Saturatiemeter',    'aeriecura' ), 'spec' => 'SO-110',  'meta' => 'SpO₂ · pulse' ],
    [ 'icon' => 'activity',    'label' => __( 'ECG 12-lead',       'aeriecura' ), 'spec' => 'EC-12X',  'meta' => 'klinisch · WiFi' ],
];

$trust_stats = [
    [ 'num' => '12+',  'lbl' => __( 'Jaar ervaring',       'aeriecura' ) ],
    [ 'num' => '340+', 'lbl' => __( 'Zorginstellingen',    'aeriecura' ) ],
    [ 'num' => 'MDR',  'lbl' => __( 'Conform leverancier', 'aeriecura' ) ],
];
?>

<section class="hero <?php echo esc_attr( $variant_class ); ?>">
    <div class="shell">
        <div class="hero-grid">
            <div>
                <span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
                <h1><?php echo esc_html( $title ); ?></h1>
                <p class="lead"><?php echo esc_html( $lead ); ?></p>
                <div class="hero-cta">
                    <a class="btn btn-primary btn-lg" href="<?php echo esc_url( $cta_url ); ?>">
                        <?php echo esc_html( $cta_label ); ?>
                        <?php aeriecura_icon( 'arrow-right', 18, 'arrow' ); ?>
                    </a>
                    <a class="btn btn-ghost btn-lg" href="<?php echo esc_url( $cta2_url ); ?>">
                        <?php echo esc_html( $cta2_label ); ?>
                    </a>
                </div>
                <div class="hero-trust">
                    <?php foreach ( $trust_stats as $s ) : ?>
                        <div class="hero-trust-stat">
                            <span class="hero-trust-stat-num"><?php echo esc_html( $s['num'] ); ?></span>
                            <span class="hero-trust-stat-lbl"><?php echo esc_html( $s['lbl'] ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hero-illu" aria-hidden="true">
                <div class="hero-illu-grid">
                    <?php foreach ( $illu_tiles as $tile ) : ?>
                        <div class="hero-illu-tile">
                            <div>
                                <span class="hero-illu-tile-icon"><?php aeriecura_icon( $tile['icon'], 22 ); ?></span>
                                <div class="hero-illu-tile-label" style="margin-top:14px;"><?php echo esc_html( $tile['label'] ); ?></div>
                                <div class="hero-illu-tile-meta"><?php echo esc_html( $tile['meta'] ); ?></div>
                            </div>
                            <span class="hero-illu-tile-spec"><?php echo esc_html( $tile['spec'] ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
