
<?php
class Bootstrap_5_Navwalker extends Walker_Nav_Menu {
    // Start Level - Add Bootstrap classes for menu containers
    function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && ' ' === $args->item_spacing ) {
            $t = '';
            $n = ' ';
        } else {
            $t = '
';
            $n = '
';
        }

        $classes = array( 'sub-menu' );
        $classes = apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth );
        $classes = array_map( 'esc_attr', $classes );
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_submenu_id', '', $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $t . '<ul' . $id . $class_names . '>';

    }

    // Start Element - Modify the list items for the menu
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && ' ' === $args->item_spacing ) {
            $t = '';
            $n = ' ';
        } else {
            $t = '
';
            $n = '
';
        }

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';
        // Add class for active items
        if ( in_array( 'current-menu-item', $classes ) ) {
            $classes[] = 'active';
        }

        // Add classes for dropdowns
        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $classes[] = 'dropdown';
        }

        $classes = array_map( 'esc_attr', $classes );
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $t . '<li' . $id . $class_names .'>';

        $id = 'menu-item-'. $item->ID;
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title )     ? $item->attr_title     : '';
        $atts['target'] = ! empty( $item->target )          ? $item->target          : '';
        $atts['rel']    = ! empty( $item->xfn )             ? $item->xfn             : '';
        $atts['href']   = ! empty( $item->url )             ? $item->url             : '';

        // Add dropdown-toggle class for dropdowns
        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $atts['class'] = 'nav-link dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        } else {
            $atts['class'] = 'nav-link';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= $item_output;
    }
}
?>
