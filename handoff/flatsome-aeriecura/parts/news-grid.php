<?php
/**
 * News teaser — laatste 3 posts. Self-contained section.
 */

defined( 'ABSPATH' ) || exit;

$posts = get_posts( [ 'numberposts' => 3 ] );
if ( ! $posts ) { return; }

$bg      = get_query_var( 'ac_section_bg', 'alt' );
$sec_cls = trim( 'section ' . ( $bg ? 'section-' . sanitize_html_class( $bg ) : '' ) );
?>

<section class="<?php echo esc_attr( $sec_cls ); ?>">
    <div class="shell">
        <div class="section-head">
            <div>
                <span class="eyebrow"><?php esc_html_e( 'Nieuws', 'aeriecura' ); ?></span>
                <h2><?php esc_html_e( 'Productupdates, regelgeving en klantverhalen.', 'aeriecura' ); ?></h2>
            </div>
            <p class="lead">
                <a class="btn btn-quiet" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/nieuws/' ) ); ?>">
                    <?php esc_html_e( 'Alle berichten', 'aeriecura' ); ?>
                    <?php aeriecura_icon( 'arrow-right', 16, 'arrow' ); ?>
                </a>
            </p>
        </div>

        <div class="news-grid">
            <?php foreach ( $posts as $p ) :
                $tag       = function_exists( 'get_field' ) ? get_field( 'nieuws_type', $p->ID ) : '';
                $read_time = function_exists( 'get_field' ) ? (int) get_field( 'read_time', $p->ID ) : 0;
                if ( ! $tag ) {
                    $cats = get_the_category( $p->ID );
                    $tag  = $cats ? $cats[0]->name : __( 'Nieuws', 'aeriecura' );
                }
                $thumb = get_the_post_thumbnail_url( $p->ID, 'large' );
                ?>
                <a class="news-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
                    <div class="news-card-img" style="<?php echo $thumb ? 'background-image:url(' . esc_url( $thumb ) . ');background-size:cover;background-position:center;' : ''; ?>">
                        <?php if ( ! $thumb ) { aeriecura_icon( 'sparkles', 28 ); } ?>
                    </div>
                    <span class="news-card-tag"><?php echo esc_html( $tag ); ?></span>
                    <h3><?php echo esc_html( get_the_title( $p ) ); ?></h3>
                    <span class="news-card-meta">
                        <?php echo esc_html( get_the_date( '', $p ) ); ?>
                        <?php if ( $read_time ) : ?> · <?php echo (int) $read_time; ?> <?php esc_html_e( 'min lezen', 'aeriecura' ); ?><?php endif; ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
