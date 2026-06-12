<?php
/**
 * Archive — Productcategorieën.
 *
 * URL: /producten/
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-header">
    <div class="shell">
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aeriecura' ); ?></a>
            <span>›</span>
            <span><?php esc_html_e( 'Producten', 'aeriecura' ); ?></span>
        </div>
        <span class="eyebrow"><?php esc_html_e( 'Assortiment', 'aeriecura' ); ?></span>
        <h1><?php esc_html_e( 'Vijf categorieën — het volledige overzicht.', 'aeriecura' ); ?></h1>
        <p><?php esc_html_e( 'Ons assortiment is bewust afgebakend. Per categorie kiezen we voor diepte: meerdere klassen, meerdere prijspunten — allemaal MDR-conform en met directe levering.', 'aeriecura' ); ?></p>
    </div>
</section>

<section class="section">
    <div class="shell">
        <?php if ( have_posts() ) : ?>
            <div class="cat-list">
                <?php while ( have_posts() ) : the_post();
                    $icon  = function_exists( 'get_field' ) ? ( get_field( 'icon' ) ?: 'package' ) : 'package';
                    $desc  = function_exists( 'get_field' ) ? get_field( 'short_desc' ) : '';
                    $count = function_exists( 'get_field' ) ? (int) get_field( 'item_count' ) : 0;
                    $skus  = function_exists( 'get_field' ) ? get_field( 'sample_skus' ) : [];
                    if ( ! $desc ) { $desc = get_the_excerpt(); }
                    ?>
                    <article class="cat-section">
                        <div class="cat-section-head">
                            <div class="cat-section-icon"><?php aeriecura_icon( $icon, 36 ); ?></div>
                            <div class="cat-section-meta">
                                <h2><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></h2>
                                <?php if ( $desc ) : ?>
                                    <p><?php echo esc_html( $desc ); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ( $count > 0 ) : ?>
                                <span class="cert-pill"><?php echo (int) $count; ?> <?php esc_html_e( 'artikelen', 'aeriecura' ); ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if ( is_array( $skus ) && $skus ) : ?>
                            <div class="cat-products-list">
                                <?php foreach ( $skus as $sku ) :
                                    if ( ! is_array( $sku ) ) { continue; } ?>
                                    <div class="cat-product-row">
                                        <span class="thumb"><?php aeriecura_icon( $icon, 22 ); ?></span>
                                        <div>
                                            <div class="name"><?php echo esc_html( $sku['naam'] ?? '' ); ?></div>
                                            <div class="meta">
                                                <?php echo esc_html( $sku['artikelnummer'] ?? '' ); ?>
                                                <?php if ( ! empty( $sku['mdr_class'] ) ) : ?>
                                                    · MDR <?php echo esc_html( $sku['mdr_class'] ); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <p class="muted" style="margin:0;font-size:14px;">
                                <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Bekijk de volledige categorie', 'aeriecura' ); ?> →</a>
                            </p>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="lead">
                <?php esc_html_e( 'Nog geen productcategorieën aangemaakt. Ga naar WP-admin → Productcategorieën → Nieuwe toevoegen om de vijf categorieën in te voeren (Bloeddrukmeters, Thermometers, Saturatiemeters, ECG-apparatuur, Weegschalen).', 'aeriecura' ); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="shell">
        <?php get_template_part( 'parts/cta-band' ); ?>
    </div>
</section>

<?php get_footer();
