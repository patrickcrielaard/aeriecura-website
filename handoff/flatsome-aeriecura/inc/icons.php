<?php
/**
 * Inline SVG icon helper (Lucide-style).
 *
 *   aeriecura_icon( 'heart-pulse', 24 );          // echoed
 *   $svg = aeriecura_icon_html( 'heart-pulse', 24 ); // returned
 *
 * Icons zitten inline in deze file (geen losse svg-bestanden nodig — werkt
 * out-of-the-box). Wie wil kan een eigen svg op
 * `assets/icons/{name}.svg` plaatsen; die wint dan.
 */

defined( 'ABSPATH' ) || exit;

function aeriecura_icon_paths() : array {
    return [
        'heart-pulse'  => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/><path d="M3.22 12h6.78l1-3 2 6 1-3h6.78"/>',
        'thermometer'  => '<path d="M14 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z"/>',
        'wind'         => '<path d="M17.7 7.7a2.5 2.5 0 1 1 1.8 4.3H2"/><path d="M9.6 4.6A2 2 0 1 1 11 8H2"/><path d="M12.6 19.4A2 2 0 1 0 14 16H2"/>',
        'activity'     => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>',
        'scale'        => '<path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/>',
        'package'      => '<path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>',
        'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
        'check'        => '<polyline points="20 6 9 17 4 12"/>',
        'arrow-right'  => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'arrow-up-right'=> '<path d="M7 7h10v10"/><path d="M7 17 17 7"/>',
        'phone'        => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
        'mail'         => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
        'map-pin'      => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
        'lock'         => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        'user'         => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'menu'         => '<line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>',
        'globe'        => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
        'sparkles'     => '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.582a.5.5 0 0 1 0 .962L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>',
        'clipboard'    => '<rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>',
        'truck'        => '<path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>',
        'graduation-cap'=> '<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
        'file-text'    => '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/>',
        'building'     => '<rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>',
    ];
}

function aeriecura_icon_html( string $name, int $size = 20, string $extra_class = '' ) : string {
    $paths = aeriecura_icon_paths();
    $cls   = trim( 'ac-icon ' . $extra_class );

    if ( isset( $paths[ $name ] ) ) {
        return sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="%d" height="%d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="%s" aria-hidden="true">%s</svg>',
            $size, $size, esc_attr( $cls ), $paths[ $name ]
        );
    }

    // Optionele override via losse .svg in assets/icons/ — alleen veilige
    // bestandsnamen (geen path traversal) en alleen gesanitizede SVG-output.
    if ( ! preg_match( '/^[a-z0-9_-]+$/i', $name ) ) {
        return '';
    }

    $path = AERIECURA_PATH . '/assets/icons/' . $name . '.svg';
    if ( file_exists( $path ) ) {
        $svg = file_get_contents( $path );
        if ( false === $svg ) {
            return '';
        }

        $svg = aeriecura_sanitize_svg( $svg );
        if ( '' === $svg ) {
            return '';
        }

        // Bestaande width/height/class op de root strippen zodat we geen
        // dubbele attributen introduceren.
        $svg = preg_replace_callback(
            '/<svg([^>]*)>/',
            function ( $m ) use ( $size, $cls ) {
                $attrs = preg_replace( '/\s+(?:width|height|class)\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $m[1] );
                return sprintf(
                    '<svg%s width="%d" height="%d" class="%s">',
                    $attrs, (int) $size, (int) $size, esc_attr( $cls )
                );
            },
            $svg,
            1
        );

        return $svg;
    }

    return '';
}

/**
 * Sanitize SVG-markup: alleen tekening-elementen en veilige attributen,
 * geen <script>, event handlers of externe references.
 */
function aeriecura_sanitize_svg( string $svg ) : string {
    $common = [
        'fill'            => true,
        'stroke'          => true,
        'stroke-width'    => true,
        'stroke-linecap'  => true,
        'stroke-linejoin' => true,
        'opacity'         => true,
        'transform'       => true,
        'class'           => true,
    ];

    $allowed = [
        'svg'      => array_merge( $common, [
            'xmlns'       => true,
            'viewbox'     => true,
            'width'       => true,
            'height'      => true,
            'aria-hidden' => true,
            'role'        => true,
            'focusable'   => true,
        ] ),
        'g'        => $common,
        'path'     => array_merge( $common, [ 'd' => true ] ),
        'circle'   => array_merge( $common, [ 'cx' => true, 'cy' => true, 'r' => true ] ),
        'ellipse'  => array_merge( $common, [ 'cx' => true, 'cy' => true, 'rx' => true, 'ry' => true ] ),
        'rect'     => array_merge( $common, [ 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'ry' => true ] ),
        'line'     => array_merge( $common, [ 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true ] ),
        'polyline' => array_merge( $common, [ 'points' => true ] ),
        'polygon'  => array_merge( $common, [ 'points' => true ] ),
        'title'    => [],
    ];

    return wp_kses( $svg, $allowed );
}

function aeriecura_icon( string $name, int $size = 20, string $extra_class = '' ) : string {
    echo aeriecura_icon_html( $name, $size, $extra_class );
    return '';
}
