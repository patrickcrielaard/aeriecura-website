<?php
/**
 * Generieke pagina template.
 *
 * Voor pagina's die zijn opgebouwd in UX Builder met [aeriecura_*] shortcodes
 * (homepage, Over ons, B2B, Contact, etc.) — de shortcodes wrappen zichzelf
 * in <section><div class="shell">, dus deze template heeft géén wrapper.
 *
 * Voor een "platte" pagina (alleen WP-editor tekst, geen UX Builder) wordt
 * de inhoud automatisch in een page-header + shell-narrow getoond.
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) : the_post();

    $raw     = trim( get_the_content() );
    $has_sc  = $raw && ( strpos( $raw, '[aeriecura_' ) !== false
                      || strpos( $raw, '[section' )    !== false
                      || strpos( $raw, '[row' )        !== false );

    if ( $has_sc ) :
        // UX Builder / shortcode pagina — laat de content zichzelf renderen
        the_content();
    else :
        // Klassieke pagina — wrap in onze page-header + shell
        ?>
        <section class="page-header">
            <div class="shell">
                <div class="breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aeriecura' ); ?></a>
                    <span>›</span>
                    <span><?php the_title(); ?></span>
                </div>
                <h1><?php the_title(); ?></h1>
                <?php if ( has_excerpt() ) : ?>
                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                <?php endif; ?>
            </div>
        </section>
        <section class="section">
            <div class="shell shell-narrow">
                <?php the_content(); ?>
            </div>
        </section>
        <?php
    endif;

endwhile;

get_footer();
