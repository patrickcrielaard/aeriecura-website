<?php
/**
 * Minimal nav walker — rendert wp_nav_menu items als <a class="ac-nav-link">
 * zonder <ul>/<li> ballast, zodat de header-CSS uit het prototype 1-op-1 past.
 */

defined( 'ABSPATH' ) || exit;

class Aeriecura_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_el( &$output, $item, $depth = 0, $args = null ) {}

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = ! empty( $item->classes ) ? array_filter( (array) $item->classes ) : [];
        $is_active = in_array( 'current-menu-item', $classes, true )
            || in_array( 'current_page_item', $classes, true )
            || in_array( 'current-menu-parent', $classes, true );

        $output .= sprintf(
            '<a class="ac-nav-link%s" href="%s">%s</a>',
            $is_active ? ' is-active' : '',
            esc_url( $item->url ),
            esc_html( $item->title )
        );
    }
}
