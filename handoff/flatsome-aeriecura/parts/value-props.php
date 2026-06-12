<?php
/**
 * Value props — waarom AerieCura.
 *
 * Section-head via shortcode attribs, kaarten vast in deze partial.
 */

defined( 'ABSPATH' ) || exit;

$eyebrow = get_query_var( 'ac_vp_eyebrow', __( 'Waarom AerieCura', 'aeriecura' ) );
$title   = get_query_var( 'ac_vp_title',   __( 'Een leverancier die de zorgpraktijk begrijpt.', 'aeriecura' ) );
$lead    = get_query_var( 'ac_vp_lead',    __( 'We zijn klein genoeg om u persoonlijk te kennen en groot genoeg om elke dag te leveren. Specialistisch in plaats van breed — diepgang waar het telt.', 'aeriecura' ) );
$bg      = get_query_var( 'ac_section_bg', 'alt' ); // default: light grey
$sec_cls = trim( 'section ' . ( $bg ? 'section-' . sanitize_html_class( $bg ) : '' ) );

$values = [
    [ 'icon' => 'shield-check',   'title' => __( 'MDR-conform leveranciersnetwerk', 'aeriecura' ), 'body' => __( 'Alle leveranciers zijn gescreend op MDR-conformiteit. Documentatie is op aanvraag direct beschikbaar.', 'aeriecura' ) ],
    [ 'icon' => 'truck',          'title' => __( 'Levertijd binnen 24 uur',         'aeriecura' ), 'body' => __( 'Eigen voorraad in Reeuwijk. Voor 16:00 besteld is vandaag verzonden — Nederland en België.',     'aeriecura' ) ],
    [ 'icon' => 'graduation-cap', 'title' => __( 'Productexperts ter ondersteuning','aeriecura' ), 'body' => __( 'Onze specialisten denken mee bij selectie en validatie. Trainingen on-site bij grotere afnames.',  'aeriecura' ) ],
    [ 'icon' => 'file-text',      'title' => __( 'Heldere staffelprijzen',          'aeriecura' ), 'body' => __( 'Transparante prijsstaffels per instelling. Geen verrassingen op de factuur, alles vooraf in offerte.', 'aeriecura' ) ],
    [ 'icon' => 'clipboard',      'title' => __( 'Compliance-documentatie',         'aeriecura' ), 'body' => __( 'CE-verklaringen, IFU\'s en risicoclassificatie standaard meegeleverd in een digitaal dossier.',     'aeriecura' ) ],
    [ 'icon' => 'building',       'title' => __( 'Voor de hele zorgketen',          'aeriecura' ), 'body' => __( 'Van huisartsenpraktijk tot ziekenhuis: 340+ zorginstellingen vertrouwen al jaren op ons.',          'aeriecura' ) ],
];
?>

<section class="<?php echo esc_attr( $sec_cls ); ?>">
    <div class="shell">
        <div class="section-head">
            <div>
                <span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
                <h2><?php echo esc_html( $title ); ?></h2>
            </div>
            <p class="lead"><?php echo esc_html( $lead ); ?></p>
        </div>

        <div class="values-grid">
            <?php foreach ( $values as $v ) : ?>
                <div class="value-card">
                    <span class="value-card-icon"><?php aeriecura_icon( $v['icon'], 24 ); ?></span>
                    <h3><?php echo esc_html( $v['title'] ); ?></h3>
                    <p><?php echo esc_html( $v['body'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
