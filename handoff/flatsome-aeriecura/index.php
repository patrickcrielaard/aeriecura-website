<?php
/**
 * Fallback template (en blog index).
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="page-header">
    <div class="shell">
        <div class="breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aeriecura' ); ?></a>
            <span>›</span>
            <span><?php esc_html_e( 'Nieuws', 'aeriecura' ); ?></span>
        </div>
        <span class="eyebrow"><?php esc_html_e( 'Updates', 'aeriecura' ); ?></span>
        <h1><?php esc_html_e( 'Nieuws & inzichten', 'aeriecura' ); ?></h1>
        <p><?php esc_html_e( 'Productupdates, regelgeving en klantverhalen uit de praktijk.', 'aeriecura' ); ?></p>
    </div>
</section>

<section class="section">
    <div class="shell">

        <?php if ( have_posts() ) : ?>
            <div class="news-list">
                <?php while ( have_posts() ) : the_post();
                    $thumb     = get_the_post_thumbnail_url( null, 'medium' );
                    $tag       = function_exists( 'get_field' ) ? get_field( 'nieuws_type' ) : '';
                    $read_time = function_exists( 'get_field' ) ? (int) get_field( 'read_time' ) : 0;
                    if ( ! $tag ) {
                        $cats = get_the_category();
                        $tag  = $cats ? $cats[0]->name : __( 'Nieuws', 'aeriecura' );
                    }
                    ?>
                    <a class="news-row" href="<?php the_permalink(); ?>">
                        <div class="news-row-thumb" style="<?php echo $thumb ? 'background-image:url(' . esc_url( $thumb ) . ');background-size:cover;background-position:center;' : ''; ?>">
                            <?php if ( ! $thumb ) { aeriecura_icon( 'sparkles', 24 ); } ?>
                        </div>
                        <div class="news-row-body">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
                        </div>
                        <div class="news-row-meta">
                            <span class="tag"><?php echo esc_html( $tag ); ?></span>
                            <span class="date">
                                <?php echo esc_html( get_the_date() ); ?>
                                <?php if ( $read_time ) : ?>· <?php echo (int) $read_time; ?> min<?php endif; ?>
                            </span>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <?php
            $pagination = paginate_links( [ 'echo' => false ] );
            if ( $pagination ) {
                echo '<div style="margin-top:48px;text-align:center;">' . wp_kses_post( $pagination ) . '</div>';
            }
            ?>
        <?php else : ?>
            <p class="lead"><?php esc_html_e( 'Nog geen berichten — kom binnenkort terug.', 'aeriecura' ); ?></p>
        <?php endif; ?>

    </div>
</section>

<section class="section">
    <div class="shell">
        <?php get_template_part( 'parts/cta-band' ); ?>
    </div>
</section>

<?php get_footer();
