<?php
/**
 * Single — Productcategorie detail.
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) : the_post();
    $icon   = function_exists( 'get_field' ) ? ( get_field( 'icon' ) ?: 'package' ) : 'package';
    $desc   = function_exists( 'get_field' ) ? get_field( 'short_desc' ) : '';
    $count  = function_exists( 'get_field' ) ? (int) get_field( 'item_count' ) : 0;
    $skus   = function_exists( 'get_field' ) ? get_field( 'sample_skus' ) : [];
    $brands = function_exists( 'get_field' ) ? get_field( 'brands' )      : [];
    ?>

    <section class="page-header">
        <div class="shell">
            <div class="breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aeriecura' ); ?></a>
                <span>›</span>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'productcategorie' ) ); ?>"><?php esc_html_e( 'Producten', 'aeriecura' ); ?></a>
                <span>›</span>
                <span><?php the_title(); ?></span>
            </div>
            <div style="display:flex;gap:24px;align-items:center;margin-top:8px;">
                <div class="cat-section-icon"><?php aeriecura_icon( $icon, 36 ); ?></div>
                <div>
                    <span class="eyebrow"><?php esc_html_e( 'Categorie', 'aeriecura' ); ?></span>
                    <h1 style="margin:8px 0 0;"><?php the_title(); ?></h1>
                </div>
            </div>
            <?php if ( $desc ) : ?>
                <p style="margin-top:24px;"><?php echo esc_html( $desc ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section">
        <div class="shell shell-narrow">
            <?php the_content(); ?>
        </div>
    </section>

    <?php if ( is_array( $skus ) && $skus ) : ?>
        <section class="section section-alt">
            <div class="shell">
                <div class="section-head">
                    <div>
                        <span class="eyebrow"><?php esc_html_e( 'Voorbeelden', 'aeriecura' ); ?></span>
                        <h2><?php esc_html_e( 'Een selectie uit het assortiment.', 'aeriecura' ); ?></h2>
                    </div>
                    <?php if ( $count > 0 ) : ?>
                        <p class="lead">
                            <?php
                            printf(
                                /* translators: %d: total number of products in the category */
                                esc_html__( 'Totaal %d artikelen — neem contact op voor het volledige overzicht en actuele prijzen.', 'aeriecura' ),
                                (int) $count
                            );
                            ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="cat-products-list">
                    <?php foreach ( $skus as $sku ) :
                        if ( ! is_array( $sku ) ) { continue; } ?>
                        <div class="cat-product-row">
                            <span class="thumb"><?php aeriecura_icon( $icon, 22 ); ?></span>
                            <div>
                                <div class="name"><?php echo esc_html( $sku['naam'] ?? '' ); ?></div>
                                <div class="meta">
                                    <?php echo esc_html( $sku['artikelnummer'] ?? '' ); ?>
                                    <?php if ( ! empty( $sku['mdr_class'] ) ) : ?>· MDR <?php echo esc_html( $sku['mdr_class'] ); ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( is_array( $brands ) && $brands ) : ?>
        <section class="section">
            <div class="shell">
                <div class="section-head">
                    <div>
                        <span class="eyebrow"><?php esc_html_e( 'Hoofdmerken', 'aeriecura' ); ?></span>
                        <h2><?php esc_html_e( 'De leveranciers die we voor u screenen.', 'aeriecura' ); ?></h2>
                    </div>
                </div>
                <div class="trust-strip-logos" style="grid-template-columns:repeat(<?php echo min( 6, count( $brands ) ); ?>, 1fr);">
                    <?php foreach ( $brands as $b ) :
                        if ( ! is_array( $b ) ) { continue; } ?>
                        <div class="trust-strip-logo">
                            <?php if ( ! empty( $b['logo']['url'] ) ) : ?>
                                <img src="<?php echo esc_url( $b['logo']['url'] ); ?>" alt="<?php echo esc_attr( $b['naam'] ?? '' ); ?>" style="max-height:32px;width:auto;">
                            <?php else : ?>
                                <?php echo esc_html( $b['naam'] ?? '' ); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="section">
        <div class="shell">
            <?php get_template_part( 'parts/cta-band' ); ?>
        </div>
    </section>

<?php endwhile;

get_footer();
