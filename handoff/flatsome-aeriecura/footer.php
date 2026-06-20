<?php
/**
 * AerieCura footer — overrulet Flatsome's eigen footer.php.
 *
 * 5-koloms layout: logo + bedrijfsinfo, Producten (auto uit CPT),
 * Bedrijf, Webshops, Beheer.
 */

defined( 'ABSPATH' ) || exit;

$ac_phone    = aeriecura_setting( 'aeriecura_phone',    '+31 (0)182 000 000' );
$ac_email    = aeriecura_setting( 'aeriecura_email',    'info@aeriecura.nl' );
$ac_kvk      = aeriecura_setting( 'aeriecura_kvk',      '12345678' );
$ac_addr1    = aeriecura_setting( 'aeriecura_address1', 'Industrieweg 12' );
$ac_addr2    = aeriecura_setting( 'aeriecura_address2', '2811 NP Reeuwijk' );
$ac_tagline  = aeriecura_setting( 'aeriecura_tagline',  __( 'Specialistische groothandel in diagnostiek- en monitoring-apparatuur voor zorgprofessionals.', 'aeriecura' ) );
$ac_webshops = aeriecura_list( 'aeriecura_webshops' );
?>

<footer class="ac-footer" role="contentinfo">
    <div class="ac-footer-inner">

        <div class="ac-footer-col">
            <a class="ac-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php
                $logo_id  = get_theme_mod( 'custom_logo' );
                $logo_src = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
                if ( $logo_src ) {
                    printf( '<img class="ac-footer-logo" src="%s" alt="%s">', esc_url( $logo_src ), esc_attr( get_bloginfo( 'name' ) ) );
                } else {
                    printf(
                        '<span style="font-family:var(--font-display);font-weight:700;font-size:22px;color:var(--ac-blue-800);">%s</span>',
                        esc_html( get_bloginfo( 'name' ) )
                    );
                }
                ?>
            </a>
            <p class="ac-footer-tag"><?php echo esc_html( $ac_tagline ); ?></p>
            <p class="ac-footer-meta">
                <?php echo esc_html( $ac_addr1 ); ?><br>
                <?php echo esc_html( $ac_addr2 ); ?><br>
                <?php echo esc_html__( 'KvK', 'aeriecura' ) . ' ' . esc_html( $ac_kvk ); ?>
            </p>
        </div>

        <div class="ac-footer-col">
            <h4 class="ac-footer-h"><?php esc_html_e( 'Assortiment', 'aeriecura' ); ?></h4>
            <?php
            $cats = get_posts( [
                'post_type'      => 'productcategorie',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ] );

            if ( $cats ) {
                foreach ( $cats as $cat ) {
                    printf(
                        '<a href="%s">%s</a>',
                        esc_url( get_permalink( $cat ) ),
                        esc_html( $cat->post_title )
                    );
                }
            } else {
                $fallback = [
                    __( 'Bloeddrukmeters',   'aeriecura' ),
                    __( 'Bloedsuikermeters', 'aeriecura' ),
                    __( 'Thermometers',      'aeriecura' ),
                    __( 'Saturatiemeters',   'aeriecura' ),
                    __( 'ECG-apparatuur',    'aeriecura' ),
                    __( 'Weegschalen',       'aeriecura' ),
                ];
                foreach ( $fallback as $label ) {
                    echo '<span>' . esc_html( $label ) . '</span>';
                }
            }
            ?>
        </div>

        <div class="ac-footer-col">
            <h4 class="ac-footer-h"><?php esc_html_e( 'Bedrijf', 'aeriecura' ); ?></h4>
            <?php if ( has_nav_menu( 'footer-2' ) ) :
                wp_nav_menu( [
                    'theme_location' => 'footer-2',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    'walker'         => new Aeriecura_Nav_Walker(),
                ] );
            else : ?>
                <a href="<?php echo esc_url( home_url( '/over/' ) ); ?>"><?php esc_html_e( 'Over ons', 'aeriecura' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/voor-zorgverleners/' ) ); ?>"><?php esc_html_e( 'Voor zorgverleners', 'aeriecura' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/mdr/' ) ); ?>"><?php esc_html_e( 'MDR-conformiteit', 'aeriecura' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/nieuws/' ) ); ?>"><?php esc_html_e( 'Nieuws', 'aeriecura' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'aeriecura' ); ?></a>
            <?php endif; ?>
        </div>

        <div class="ac-footer-col">
            <h4 class="ac-footer-h"><?php esc_html_e( 'Webshops', 'aeriecura' ); ?></h4>
            <?php foreach ( $ac_webshops as $shop ) :
                if ( empty( $shop['name'] ) ) { continue; }
                $url = $shop['url'] ?: '#'; ?>
                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">
                    <?php echo esc_html( $shop['name'] ); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="ac-footer-col">
            <h4 class="ac-footer-h"><?php esc_html_e( 'Beheer', 'aeriecura' ); ?></h4>
            <a href="https://b2b.aeriecura.nl" target="_blank" rel="noopener"><?php esc_html_e( 'B2B-portaal', 'aeriecura' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/api/' ) ); ?>"><?php esc_html_e( 'API-documentatie', 'aeriecura' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Vraag een offerte aan', 'aeriecura' ); ?></a>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $ac_phone ) ); ?>"><?php echo esc_html( $ac_phone ); ?></a>
            <a href="mailto:<?php echo esc_attr( $ac_email ); ?>"><?php echo esc_html( $ac_email ); ?></a>
        </div>

    </div>

    <div class="ac-footer-bottom">
        <span>© <?php echo esc_html( gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'Alle rechten voorbehouden.', 'aeriecura' ); ?></span>
        <div class="ac-footer-bottom-links">
            <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'aeriecura' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/voorwaarden/' ) ); ?>"><?php esc_html_e( 'Voorwaarden', 'aeriecura' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/cookies/' ) ); ?>"><?php esc_html_e( 'Cookies', 'aeriecura' ); ?></a>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
