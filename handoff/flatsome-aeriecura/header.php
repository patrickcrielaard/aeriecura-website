<?php
/**
 * AerieCura header — overrulet Flatsome's eigen header.php.
 *
 * Rendert de twee-laagse header uit het prototype: top-bar met contactgegevens
 * en de hoofdbalk met logo, primary menu, login link en CTA-knop.
 */

defined( 'ABSPATH' ) || exit;

$ac_phone = aeriecura_setting( 'aeriecura_phone', '+31 (0)182 000 000' );
$ac_email = aeriecura_setting( 'aeriecura_email', 'info@aeriecura.nl' );

$ac_logo_id  = function_exists( 'get_theme_mod' ) ? get_theme_mod( 'custom_logo' ) : 0;
$ac_logo_src = $ac_logo_id ? wp_get_attachment_image_url( $ac_logo_id, 'full' ) : '';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>

<header class="ac-header" role="banner">
    <div class="ac-header-bar">
        <div class="ac-header-bar-inner">
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $ac_phone ) ); ?>">
                <?php aeriecura_icon( 'phone', 13 ); ?>
                <span><?php echo esc_html( $ac_phone ); ?></span>
            </a>
            <span class="sep" aria-hidden="true"></span>
            <a href="mailto:<?php echo esc_attr( $ac_email ); ?>">
                <?php aeriecura_icon( 'mail', 13 ); ?>
                <span><?php echo esc_html( $ac_email ); ?></span>
            </a>
            <span class="sep" aria-hidden="true"></span>
            <span><?php aeriecura_icon( 'globe', 13 ); ?> NL</span>
        </div>
    </div>

    <div class="ac-header-inner">
        <a class="ac-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <?php if ( $ac_logo_src ) : ?>
                <img src="<?php echo esc_url( $ac_logo_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <?php else : ?>
                <span style="font-family:var(--font-display);font-weight:700;font-size:22px;color:var(--ac-blue-800);letter-spacing:-0.01em;">
                    <?php bloginfo( 'name' ); ?>
                </span>
            <?php endif; ?>
        </a>

        <nav class="ac-nav" role="navigation" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'aeriecura' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    'walker'         => new Aeriecura_Nav_Walker(),
                ] );
            } else {
                // Fallback menu — werkt direct zonder dat de gebruiker een menu hoeft aan te maken
                $items = [
                    [ 'label' => __( 'Home',                'aeriecura' ), 'url' => home_url( '/' ) ],
                    [ 'label' => __( 'Producten',           'aeriecura' ), 'url' => home_url( '/producten/' ) ],
                    [ 'label' => __( 'Over ons',            'aeriecura' ), 'url' => home_url( '/over/' ) ],
                    [ 'label' => __( 'Voor zorgverleners',  'aeriecura' ), 'url' => home_url( '/voor-zorgverleners/' ) ],
                    [ 'label' => __( 'Nieuws',              'aeriecura' ), 'url' => home_url( '/nieuws/' ) ],
                    [ 'label' => __( 'Contact',             'aeriecura' ), 'url' => home_url( '/contact/' ) ],
                ];
                $current_path = wp_parse_url( add_query_arg( [] ), PHP_URL_PATH ) ?: '/';
                $current_url  = trailingslashit( home_url( $current_path ) );
                foreach ( $items as $item ) {
                    $is_active  = trailingslashit( $item['url'] ) === $current_url;
                    $active_cls = $is_active ? ' is-active' : '';
                    printf(
                        '<a class="ac-nav-link%s" href="%s">%s</a>',
                        esc_attr( $active_cls ),
                        esc_url( $item['url'] ),
                        esc_html( $item['label'] )
                    );
                }
            }
            ?>
        </nav>

        <div class="ac-header-actions">
            <?php aeriecura_login_link(); ?>
            <a class="btn btn-primary btn-sm" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                <?php esc_html_e( 'Offerte aanvragen', 'aeriecura' ); ?>
            </a>
        </div>
    </div>
</header>
