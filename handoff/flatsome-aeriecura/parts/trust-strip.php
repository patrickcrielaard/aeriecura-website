<?php
/**
 * Trust strip — rij met leveranciers.
 *
 * Leveranciers komen uit Customizer → AerieCura — Lijsten → Leveranciers.
 * Eén per regel.
 */

defined( 'ABSPATH' ) || exit;

$logos = aeriecura_list( 'aeriecura_suppliers' );
if ( ! $logos ) {
    $logos = [
        [ 'name' => 'Medisana' ], [ 'name' => 'Welch Allyn' ], [ 'name' => 'Omron' ],
        [ 'name' => 'Beurer' ], [ 'name' => 'A&D Medical' ], [ 'name' => 'Microlife' ],
    ];
}
?>

<div class="trust-strip">
    <div class="trust-strip-inner">
        <div class="trust-strip-label">
            <?php esc_html_e( 'Vertrouwd', 'aeriecura' ); ?><br>
            <?php esc_html_e( 'door',      'aeriecura' ); ?>
        </div>
        <div class="trust-strip-logos">
            <?php foreach ( $logos as $logo ) : ?>
                <div class="trust-strip-logo"><?php echo esc_html( $logo['name'] ); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
