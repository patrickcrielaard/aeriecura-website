<?php
/**
 * Stats + certificeringen.
 *
 * Stats: 4 vaste cijfers in deze partial.
 * Certificeringen: uit Customizer → AerieCura — Lijsten.
 */

defined( 'ABSPATH' ) || exit;

// Shortcode-attribs voor de section-head (worden gezet door [aeriecura_stats])
$ac_eyebrow = get_query_var( 'ac_stats_eyebrow', __( 'In cijfers', 'aeriecura' ) );
$ac_title   = get_query_var( 'ac_stats_title',   __( 'Een fundament dat zich heeft bewezen.', 'aeriecura' ) );
$ac_lead    = get_query_var( 'ac_stats_lead',    __( 'Geen marketing-claims — gewoon de cijfers die ertoe doen voor uw inkoopafdeling en compliance-officer.', 'aeriecura' ) );

$stats = [
    [ 'num' => '12+',  'lbl' => __( 'Jaar ervaring in medische groothandel', 'aeriecura' ) ],
    [ 'num' => '340+', 'lbl' => __( 'Zorginstellingen werkt met ons',         'aeriecura' ) ],
    [ 'num' => '95',   'lbl' => __( "SKU's in eigen voorraad",                'aeriecura' ) ],
    [ 'num' => '24u',  'lbl' => __( 'Gemiddelde levertijd NL',                'aeriecura' ) ],
];

$certs = aeriecura_list( 'aeriecura_certifications' );

$bg      = get_query_var( 'ac_section_bg', '' );
$sec_cls = trim( 'section ' . ( $bg ? 'section-' . sanitize_html_class( $bg ) : '' ) );
?>

<section class="<?php echo esc_attr( $sec_cls ); ?>">
    <div class="shell">
        <div class="section-head">
            <div>
                <span class="eyebrow"><?php echo esc_html( $ac_eyebrow ); ?></span>
                <h2><?php echo esc_html( $ac_title ); ?></h2>
            </div>
            <p class="lead"><?php echo esc_html( $ac_lead ); ?></p>
        </div>

        <div class="stats-grid">
            <?php foreach ( $stats as $s ) : ?>
                <div class="stat-cell">
                    <div class="stat-num"><?php echo esc_html( $s['num'] ); ?></div>
                    <div class="stat-lbl"><?php echo esc_html( $s['lbl'] ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ( $certs ) : ?>
            <div class="certs-row" style="margin-top:32px;">
                <?php foreach ( $certs as $cert ) : ?>
                    <span class="cert-pill">
                        <?php aeriecura_icon( 'check', 14 ); ?>
                        <?php echo esc_html( $cert['name'] ); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
