<?php
function yourtheme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menus([
        'main_menu' => 'Main Menu',
    ]);
}
add_action('after_setup_theme', 'yourtheme_setup');







function mytheme_enqueue_bootstrap() {
    
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

    
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/theme-style.css', array(), filemtime(get_template_directory() . '/css/theme-style.css'));

    
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_bootstrap');


function mytheme_register_menus() {
    register_nav_menus([
        'primary-menu' => __('Primary Menu', 'mytheme'),
    ]);
}
add_action('after_setup_theme', 'mytheme_register_menus');

function mytheme_enqueue_scripts() {
    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://unpkg.com/swiper/swiper-bundle.min.css',
        array(),
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        array(),
        '6.5.0'
    );

    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Gilda+Display&family=Instrument+Sans&display=swap',
        array(),
        null
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://unpkg.com/swiper/swiper-bundle.min.js',
        array(),
        null,
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');



function enqueue_swiper_assets() {
    // Swiper CSS
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');

    // Swiper JS
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], null, true);

    // Your custom JS to initialize Swiper
    wp_enqueue_script('custom-swiper-init', get_template_directory_uri() . '/js/swiper-init.js', ['swiper-js'], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');



if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'Theme Settings',
    'menu_title' => 'Theme Settings',
    'menu_slug'  => 'theme-settings',
    'capability' => 'edit_posts',
    'redirect'   => false
  ]);
}



function my_theme_enqueue_styles() {
    // Your theme styles
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

    // Font Awesome (Free) from CDN
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );




function register_room_post_type() {
  register_post_type('room', array(
    'labels' => array(
      'name' => __('Rooms'),
      'singular_name' => __('Room')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'rooms'),
    'supports' => array('title', 'editor', 'thumbnail'),
    'show_in_rest' => true,
  ));
}
add_action('init', 'register_room_post_type');

// functions.php
/**
 * Robust season detection (ACF-friendly, non-breaking).
 * - Accepts dates in Y-m-d or d/m/Y (or with time appended).
 * - Handles ranges that wrap across year boundary (e.g., Nov -> Mar).
 * - Never throws fatal errors; falls back to month-based logic.
 * - Writes helpful debug lines to WP debug.log for inspection.
 */

/* Add body class */
function add_season_body_class($classes) {
    $season = get_current_season();
    if ($season) $classes[] = $season;
    return $classes;
}
add_filter('body_class', 'add_season_body_class');

/* Main detection function */
function get_current_season() {
    // Read ACF options
    $summer_start_raw = get_field('summer_start_date', 'option');
    $summer_end_raw   = get_field('summer_end_date', 'option');
    $winter_start_raw = get_field('winter_start_date', 'option');
    $winter_end_raw   = get_field('winter_end_date', 'option');

    // Helper to write debug (only if WP_DEBUG_LOG true)
    $dbg = function($msg) {
        if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
            error_log('[SEASON] ' . $msg);
        }
    };

    $dbg("raw values: summer_start={$summer_start_raw} summer_end={$summer_end_raw} winter_start={$winter_start_raw} winter_end={$winter_end_raw}");

    // If any missing, fallback to month logic
    if (!$summer_start_raw || !$summer_end_raw || !$winter_start_raw || !$winter_end_raw) {
        $month = (int) date('n');
        $fallback = in_array($month, [4,5,6,7,8,9]) ? 'summer' : 'winter';
        $dbg("missing fields -> fallback month={$month} => {$fallback}");
        return $fallback;
    }

    // Normalize raw strings: take first 10 characters if contains time, trim spaces
    $norm = function($s) {
        $s = trim($s);
        if ($s === '') return null;
        // If contains space and time, take date portion
        if (preg_match('/^(\d{1,4}[-\/]\d{1,2}[-\/]\d{1,4})/', $s, $m)) {
            return $m[1];
        }
        // Otherwise, return as-is
        return $s;
    };

    $summer_start = $norm($summer_start_raw);
    $summer_end   = $norm($summer_end_raw);
    $winter_start = $norm($winter_start_raw);
    $winter_end   = $norm($winter_end_raw);

    $dbg("normalized: summer_start={$summer_start} summer_end={$summer_end} winter_start={$winter_start} winter_end={$winter_end}");

    // Try parsing with multiple known formats
    $parse_date = function($str) use ($dbg) {
        if (!$str) return false;
        $formats = ['Y-m-d', 'd/m/Y', 'd-n-Y', 'Y/n/j'];
        foreach ($formats as $fmt) {
            $d = DateTime::createFromFormat($fmt, $str);
            if ($d && $d->format($fmt) === $str) {
                $dbg("parsed '{$str}' via format {$fmt} -> " . $d->format('Y-m-d'));
                return $d->setTime(0,0,0)->getTimestamp();
            }
        }
        // Last attempt: try strtotime (handles many formats but less strict)
        $ts = strtotime($str);
        if ($ts !== false) {
            $dbg("parsed '{$str}' via strtotime -> " . date('Y-m-d', $ts));
            return strtotime(date('Y-m-d', $ts));
        }
        $dbg("failed to parse date: '{$str}'");
        return false;
    };

    // WordPress timezone-safe "today" (midnight)
    $today_ts = strtotime( date( 'Y-m-d', current_time('timestamp') ) );

    // Parse all dates to timestamps
    $ss = $parse_date($summer_start);
    $se = $parse_date($summer_end);
    $ws = $parse_date($winter_start);
    $we = $parse_date($winter_end);

    // If any parse failed -> fallback month logic
    if (!$ss || !$se || !$ws || !$we) {
        $month = (int) date('n');
        $fallback = in_array($month, [4,5,6,7,8,9]) ? 'summer' : 'winter';
        $dbg("parse failed -> fallback month={$month} => {$fallback}");
        return $fallback;
    }

    $dbg("timestamps: today=" . date('Y-m-d', $today_ts) . " ss=" . date('Y-m-d', $ss) . " se=" . date('Y-m-d', $se) . " ws=" . date('Y-m-d', $ws) . " we=" . date('Y-m-d', $we));

    // Helper to test inclusive range with wrap support
    $in_range = function($start_ts, $end_ts, $today_ts) {
        if ($start_ts <= $end_ts) {
            return ($today_ts >= $start_ts && $today_ts <= $end_ts);
        } else {
            // wrapped across year (start > end) e.g., Nov -> Mar
            return ($today_ts >= $start_ts || $today_ts <= $end_ts);
        }
    };

    if ($in_range($ss, $se, $today_ts)) {
        $dbg("today in SUMMER range");
        return 'summer';
    }

    if ($in_range($ws, $we, $today_ts)) {
        $dbg("today in WINTER range");
        return 'winter';
    }

    // final fallback
    $month = (int) date('n');
    $fallback = in_array($month, [4,5,6,7,8,9]) ? 'summer' : 'winter';
    $dbg("no range matched -> fallback month={$month} => {$fallback}");
    return $fallback;
}

function enqueue_magnific_popup_assets() {
    // Magnific Popup CSS
    wp_enqueue_style(
        'magnific-popup-css',
        'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.min.css',
        array(),
        '1.1.0'
    );

    // Magnific Popup JS
    wp_enqueue_script(
        'magnific-popup-js',
        'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js',
        array('jquery'),
        '1.1.0',
        true
    );

    // Your custom script to initialize it
    wp_add_inline_script('magnific-popup-js', "
        jQuery(document).ready(function($) {
            $('.gallery-grid').magnificPopup({
                delegate: 'a.popup-link',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'enqueue_magnific_popup_assets');



//theater
function register_custom_menus() {
    register_nav_menus(array(
        'primary'       => __('Primary Menu'),
        'theater_menu'  => __('Theater Caffen Menu'),
        'annen_menu'  => __('annen etage Menu'),
        'hc_events_menu'  => __('HC events Menu')
    ));
}
add_action('init', 'register_custom_menus');



// packages custom posts
function register_custom_post_type_packages() {
  register_post_type('packages', array(
  'labels' => array(
    'name' => 'Packages',
    'singular_name' => 'Package',
  ),
  'public' => true,
  'has_archive' => true,
  'rewrite' => array('slug' => 'package'),

  'supports' => array('title', 'editor', 'thumbnail'),
  'show_in_rest' => true,
));

}
add_action('init', 'register_custom_post_type_packages');




// rest/bars

function register_custom_post_type_restaurants() {
  register_post_type('restaurants', array(
    'labels' => array(
      'name' => 'Restaurants & Bars',
      'singular_name' => 'Restaurant or Bar',
      'add_new' => 'Add New',
      'add_new_item' => 'Add New Restaurant or Bar',
      'edit_item' => 'Edit Restaurant or Bar',
      'new_item' => 'New Restaurant or Bar',
      'view_item' => 'View Restaurant or Bar',
      'search_items' => 'Search Restaurants & Bars',
      'not_found' => 'No Restaurants or Bars found',
      'not_found_in_trash' => 'No Restaurants or Bars found in Trash',
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'restaurants-bars'),
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_icon' => 'dashicons-carrot', // You can change the icon
    'show_in_rest' => true,
  ));
}
add_action('init', 'register_custom_post_type_restaurants');



// function register_art_and_culture_cpt() {
//     register_post_type('art_and_culture', array(
//         'labels' => array(
//             'name' => 'Art & Culture',
//             'singular_name' => 'Art Item',
//         ),
//         'public' => true,
//         'menu_icon' => 'dashicons-format-gallery',
//         'supports' => array('title', 'thumbnail', 'editor'),
//         'has_archive' => false,
//         'rewrite' => array('slug' => 'art-culture'),
//         'show_in_rest' => true, // if using Gutenberg
//     ));
// }
// add_action('init', 'register_art_and_culture_cpt');


function register_art_and_culture_cpt() {
    $labels = array(
        'name' => 'Art & Culture',
        'singular_name' => 'Art Item',
        'menu_name' => 'Art & Culture',
        'name_admin_bar' => 'Art Item',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Art Item',
        'new_item' => 'New Art Item',
        'edit_item' => 'Edit Art Item',
        'view_item' => 'View Art Item',
        'all_items' => 'All Art & Culture',
        'search_items' => 'Search Art',
        'parent_item_colon' => 'Parent Art:',
        'not_found' => 'No art items found.',
        'not_found_in_trash' => 'No art items found in Trash.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'art-culture'),
        'show_in_rest' => true, // Enable for Gutenberg/REST API
        'hierarchical' => false,
    );

    register_post_type('art_and_culture', $args);
}
add_action('init', 'register_art_and_culture_cpt');


function enqueue_magnific_popup() {
  wp_enqueue_style('magnific-popup', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css');
  wp_enqueue_script('magnific-popup', 'https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js', array('jquery'), null, true);

  // Initialize script
  wp_add_inline_script('magnific-popup', "
    jQuery(document).ready(function($) {
      $('.patterned-gallery').magnificPopup({
        delegate: 'a.lightbox-link',
        type: 'image',
        gallery: {
          enabled: true
        },
        mainClass: 'mfp-fade'
      });
    });
  ");
}
add_action('wp_enqueue_scripts', 'enqueue_magnific_popup');


//contact us
function register_contact_cards_cpt() {
    $labels = array(
        'name'               => 'Contact Cards',
        'singular_name'      => 'Contact Card',
        'menu_name'          => 'Contact Cards',
        'name_admin_bar'     => 'Contact Card',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Contact Card',
        'new_item'           => 'New Contact Card',
        'edit_item'          => 'Edit Contact Card',
        'view_item'          => 'View Contact Card',
        'all_items'          => 'All Contact Cards',
        'search_items'       => 'Search Contact Cards',
        'not_found'          => 'No cards found.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array('slug' => 'contact-cards'),
        'supports'           => array('title', 'thumbnail'),
        'menu_icon'          => 'dashicons-phone',
        'show_in_rest'       => true,
    );

    register_post_type('contact_cards', $args);
}
add_action('init', 'register_contact_cards_cpt');


//continental rooms
function register_continental_rooms_cpt() {
    $labels = array(
        'name'               => 'Continental Rooms',
        'singular_name'      => 'Continental Room',
        'menu_name'          => 'Continental Rooms',
        'name_admin_bar'     => 'Continental Room',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Continental Room',
        'new_item'           => 'New Continental Room',
        'edit_item'          => 'Edit Continental Room',
        'view_item'          => 'View Continental Room',
        'all_items'          => 'All Continental Rooms',
        'search_items'       => 'Search Continental Rooms',
        'not_found'          => 'No rooms found.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true, 
        'rewrite'            => array('slug' => 'continental-rooms'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-building',
        'show_in_rest'       => true, 
    );

    register_post_type('continental_rooms', $args);
}
add_action('init', 'register_continental_rooms_cpt');


// Register More Information CPT
function register_more_information_cpt() {
    $labels = array(
        'name'               => 'More Information',
        'singular_name'      => 'More Information',
        'menu_name'          => 'More Information',
        'name_admin_bar'     => 'More Information',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Information',
        'new_item'           => 'New Information',
        'edit_item'          => 'Edit Information',
        'view_item'          => 'View Information',
        'all_items'          => 'All Information',
        'search_items'       => 'Search Information',
        'not_found'          => 'No information found.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'more-information'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-info',
        'show_in_rest'       => true,
    );

    register_post_type('more_information', $args);
}
add_action('init', 'register_more_information_cpt');

// Register Annen Cards CPT
function register_annen_cards_cpt() {
    $labels = array(
        'name'               => 'Annen Cards',          // ✅ Plural name
        'singular_name'      => 'Annen Card',           // ✅ Singular name
        'menu_name'          => 'Annen Cards',          // ✅ Admin menu name
        'name_admin_bar'     => 'Annen Card',           // ✅ Toolbar name
        'add_new'            => 'Add New',              // Button text
        'add_new_item'       => 'Add New Annen Card',   // Page title
        'new_item'           => 'New Annen Card',
        'edit_item'          => 'Edit Annen Card',
        'view_item'          => 'View Annen Card',
        'all_items'          => 'All Annen Cards',
        'search_items'       => 'Search Annen Cards',
        'not_found'          => 'No Annen cards found.',
        'not_found_in_trash' => 'No Annen cards found in Trash.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'annen-cards'), // ✅ Archive slug
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-screenoptions', // ✅ Icon for admin
        'show_in_rest'       => true, // ✅ Gutenberg & API support
    );

    register_post_type('annen_cards', $args); // ✅ CPT name
}
add_action('init', 'register_annen_cards_cpt');


//events
// 🔹 Register Custom Post Type: Events
// function register_custom_post_type_events() {

//     $labels = array(
//         'name'               => 'Events',
//         'singular_name'      => 'Event',
//         'menu_name'          => 'Events',
//         'name_admin_bar'     => 'Event',
//         'add_new'            => 'Add New',
//         'add_new_item'       => 'Add New Event',
//         'new_item'           => 'New Event',
//         'edit_item'          => 'Edit Event',
//         'view_item'          => 'View Event',
//         'all_items'          => 'All Events',
//         'search_items'       => 'Search Events',
//         'parent_item_colon'  => 'Parent Events:',
//         'not_found'          => 'No events found.',
//         'not_found_in_trash' => 'No events found in Trash.',
//     );

//     $args = array(
//         'labels'             => $labels,
//         'public'             => true,
//         'has_archive'        => true,
//         'rewrite'            => array('slug' => 'events'),
//         'menu_icon'          => 'dashicons-calendar-alt', // ✅ Adds a calendar icon in admin
//         'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
//         'show_in_rest'       => true, // ✅ Enables Gutenberg + API support
//     );

//     register_post_type('events', $args);
// }
// add_action('init', 'register_custom_post_type_events');


//wedding events

function create_wedding_events_cpt() {

    $labels = array(
        'name'               => 'Wedding Events',
        'singular_name'      => 'Wedding Event',
        'menu_name'          => 'Wedding Events',
        'name_admin_bar'     => 'Wedding Event',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Wedding Event',
        'new_item'           => 'New Wedding Event',
        'edit_item'          => 'Edit Wedding Event',
        'view_item'          => 'View Wedding Event',
        'all_items'          => 'All Wedding Events',
        'search_items'       => 'Search Wedding Events',
        'not_found'          => 'No Wedding Events found.',
        'not_found_in_trash' => 'No Wedding Events found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Wedding Events',
        'public'             => true,
        'menu_icon'          => 'dashicons-heart', 
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'wedding-events'),
        'show_in_rest'       => true, 
    );

    register_post_type('wedding_events', $args);
}
add_action('init', 'create_wedding_events_cpt');


// party
function create_party_events_cpt() {

    $labels = array(
        'name'               => 'Party Events',
        'singular_name'      => 'Party Event',
        'menu_name'          => 'Party Events',
        'name_admin_bar'     => 'Party Event',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Party Event',
        'new_item'           => 'New Party Event',
        'edit_item'          => 'Edit Party Event',
        'view_item'          => 'View Party Event',
        'all_items'          => 'All Party Events',
        'search_items'       => 'Search Party Events',
        'not_found'          => 'No Party Events found.',
        'not_found_in_trash' => 'No Party Events found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Party Events',
        'public'             => true,
        'menu_icon'          => 'dashicons-tickets-alt', 
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'party-events'),
        'show_in_rest'       => true,
    );

    register_post_type('party_events', $args);
}
add_action('init', 'create_party_events_cpt');

// hc event cards 
// ✅ Create Custom Post Type: HC Event Cards
function create_hc_event_cards_cpt() {

    $labels = array(
        'name'               => 'HC Event Cards',
        'singular_name'      => 'HC Event Card',
        'menu_name'          => 'HC Event Cards',
        'name_admin_bar'     => 'HC Event Card',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New HC Event Card',
        'new_item'           => 'New HC Event Card',
        'edit_item'          => 'Edit HC Event Card',
        'view_item'          => 'View HC Event Card',
        'all_items'          => 'All HC Event Cards',
        'search_items'       => 'Search HC Event Cards',
        'not_found'          => 'No HC Event Cards found.',
        'not_found_in_trash' => 'No HC Event Cards found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for HC Event Cards',
        'public'             => true,
        'menu_icon'          => 'dashicons-id', // ✅ Choose your preferred icon
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'hc-event-cards'), // ✅ URL slug
        'show_in_rest'       => true, // ✅ Enables Gutenberg + API
    );

    register_post_type('hc_event_cards', $args);
}
add_action('init', 'create_hc_event_cards_cpt');



//continental suites menu

function continental_register_menus() {
    register_nav_menus(array(
        'continental_menu' => __('Continental Suites Menu', 'your-theme-textdomain'),
    ));
}
add_action('after_setup_theme', 'continental_register_menus');




// download zip

add_action('init', function () {
    if (isset($_GET['download_gallery']) && $_GET['download_gallery'] == 1) {
        // 🔥 Always fetch from the page that triggered the button
        $post_id = url_to_postid(wp_get_referer()); 
        if (!$post_id) {
            $post_id = get_the_ID(); // fallback if referer missing
        }

        $images = get_field('gallery_images', $post_id);

        if ($images) {
            $zip = new ZipArchive();
            $zip_name = 'gallery-images.zip';
            $tmp_file = tempnam(sys_get_temp_dir(), $zip_name);

            if ($zip->open($tmp_file, ZipArchive::CREATE) === TRUE) {
                foreach ($images as $img) {
                    if (!empty($img['url'])) {
                        $img_url = $img['url'];
                        $img_name = !empty($img['filename']) 
                            ? $img['filename'] 
                            : basename(parse_url($img_url, PHP_URL_PATH));
                        $img_content = file_get_contents($img_url);

                        if ($img_content !== false) {
                            $zip->addFromString($img_name, $img_content);
                        }
                    }
                }
                $zip->close();

                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="'.$zip_name.'"');
                header('Content-Length: ' . filesize($tmp_file));
                readfile($tmp_file);
                unlink($tmp_file);
                exit;
            }
        }

        wp_die('No images found to download.');
    }
});



//enqueu custom
function my_custom_scripts() {
    // Enqueue your custom JS file
    wp_enqueue_script(
        'custom-js', // Handle (unique name)
        get_template_directory_uri() . '/js/custom.js',
        array('jquery'), 
        time(), 
        true 
    );
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');




// chambre cards
function create_chambre_cards_cpt() {

    $labels = array(
        'name'               => 'Chambre Cards',
        'singular_name'      => 'Chambre Card',
        'menu_name'          => 'Chambre Cards',
        'name_admin_bar'     => 'Chambre Card',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Chambre Card',
        'new_item'           => 'New Chambre Card',
        'edit_item'          => 'Edit Chambre Card',
        'view_item'          => 'View Chambre Card',
        'all_items'          => 'All Chambre Cards',
        'search_items'       => 'Search Chambre Cards',
        'not_found'          => 'No Chambre Cards found.',
        'not_found_in_trash' => 'No Chambre Cards found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Chambre Cards',
        'public'             => true,
        'menu_icon'          => 'dashicons-building', // ✅ Choose an icon you like
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'chambre-cards'), // ✅ URL slug
        'show_in_rest'       => true, // ✅ Enables Gutenberg + REST API
    );

    register_post_type('chambre_cards', $args);
}
add_action('init', 'create_chambre_cards_cpt');


//casbar
// Register Casbar header menu
function casbar_register_header_menu() {
    register_nav_menus(
        array(
            'casbar-header' => __( 'Casbar Header Menu', 'your-theme-textdomain' ),
        )
    );
}
add_action( 'after_setup_theme', 'casbar_register_header_menu' );



//////////mega 
function register_my_menus() {
  register_nav_menus([
    'primary-menu' => __('Primary Menu'),
    'mega-menu'    => __('Mega Menu'),
    'mega-menu-theatercafeen' => __('Mega Menu Theatercafeen'),
    'mega-menu-hc-events' => __('Mega Menu HC events'),
  ]);
}
add_action('after_setup_theme', 'register_my_menus');





add_filter('nav_menu_link_attributes', function($atts, $item) {
    // Get ACF fields from the linked page/post
    $image_summer   = get_field('image_summer', $item->object_id);
    $image_winter   = get_field('image_winter', $item->object_id);
    $image_green    = get_field('image_green',  $item->object_id);
    $image_room     = get_field('image_room',   $item->object_id);
    $section_image = get_field('room_sections')['section_image'];


    // Add data attributes if images exist
    if ($image_summer) {
        $atts['data-summer'] = esc_url($image_summer['url']);
    }
    if ($image_winter) {
        $atts['data-winter'] = esc_url($image_winter['url']);
    }
    if ($image_green) {
        $atts['data-green'] = esc_url($image_green['url']);
    }
    if ($image_room) { 
        $atts['data-room'] = esc_url($image_room['url']);
    }
    if ($section_image) { 
        $atts['data-section'] = esc_url($section_image['url']); // ✅ added
    }

    return $atts;
}, 10, 2);




//special ocsasions
// special occasion
function create_special_occasion_cpt() {

    $labels = array(
        'name'               => 'Special Occasions',
        'singular_name'      => 'Special Occasion',
        'menu_name'          => 'Special Occasions',
        'name_admin_bar'     => 'Special Occasion',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Special Occasion',
        'new_item'           => 'New Special Occasion',
        'edit_item'          => 'Edit Special Occasion',
        'view_item'          => 'View Special Occasion',
        'all_items'          => 'All Special Occasions',
        'search_items'       => 'Search Special Occasions',
        'not_found'          => 'No Special Occasions found.',
        'not_found_in_trash' => 'No Special Occasions found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Special Occasions',
        'public'             => true,
        'menu_icon'          => 'dashicons-calendar-alt', // 📅 icon for events/occasions
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'special-occasions', 'with_front' => true ), // URL slug
        'show_in_rest'       => true, // Enables Gutenberg + REST API
    );

    register_post_type('special_occasion', $args);
}
add_action('init', 'create_special_occasion_cpt');


// venue
function create_venue_cpt() {

    $labels = array(
        'name'               => 'Venues',
        'singular_name'      => 'Venue',
        'menu_name'          => 'Venues',
        'name_admin_bar'     => 'Venue',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Venue',
        'new_item'           => 'New Venue',
        'edit_item'          => 'Edit Venue',
        'view_item'          => 'View Venue',
        'all_items'          => 'All Venues',
        'search_items'       => 'Search Venues',
        'not_found'          => 'No Venues found.',
        'not_found_in_trash' => 'No Venues found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Venues',
        'public'             => true,
        'menu_icon'          => 'dashicons-location', // 📍 location icon
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'venue', 'with_front' => true ), // ✅ URL slug: yoursite.com/venues
        'show_in_rest'       => true, // ✅ Enables Gutenberg + REST API
    );

    register_post_type('venue', $args);
}
add_action('init', 'create_venue_cpt');



// ✅ Register Meetings & Conferences CPT
function create_meetings_conferences_cpt() {

    $labels = array(
        'name'               => 'Meetings & Conferences',
        'singular_name'     => 'Meeting/Conference',
        'menu_name'         => 'Meetings & Conferences',
        'name_admin_bar'    => 'Meeting/Conference',
        'add_new'           => 'Add New',
        'add_new_item'      => 'Add New Meeting/Conference',
        'new_item'          => 'New Meeting/Conference',
        'edit_item'         => 'Edit Meeting/Conference',
        'view_item'         => 'View Meeting/Conference',
        'all_items'         => 'All Meetings & Conferences',
        'search_items'      => 'Search Meetings & Conferences',
        'not_found'         => 'No Meetings or Conferences found.',
        'not_found_in_trash'=> 'No Meetings or Conferences found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Meetings and Conferences',
        'public'             => true,
        'menu_icon'          => 'dashicons-groups', // 👥 icon for events/meetings
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'meetings-conferences', 'with_front' => true ),
        'show_in_rest'       => true, // Enables Gutenberg + REST API
    );

    register_post_type('meetings_conferences', $args);
}
add_action('init', 'create_meetings_conferences_cpt');


// ✅ Register Offer HC CPT
function create_offer_hc_cpt() {

    $labels = array(
        'name'                  => 'Offer HC',
        'singular_name'         => 'Offer HC',
        'menu_name'             => 'Offer HC',
        'name_admin_bar'        => 'Offer HC',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Offer HC',
        'new_item'              => 'New Offer HC',
        'edit_item'             => 'Edit Offer HC',
        'view_item'             => 'View Offer HC',
        'all_items'             => 'All Offer HC',
        'search_items'          => 'Search Offer HC',
        'not_found'             => 'No Offer HC found.',
        'not_found_in_trash'    => 'No Offer HC found in Trash.',
    );

    $args = array(
        'labels'               => $labels,
        'description'          => 'Custom post type for Offer HC',
        'public'               => true,
        'menu_icon'            => 'dashicons-tag', // 🎫 icon for offers
        'supports'             => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'offer-hc'),
        'show_in_rest'        => true, // ✅ Enables Gutenberg + REST API
    );

    register_post_type('offer_hc', $args);
}
add_action('init', 'create_offer_hc_cpt');


// About Us HC CPT
function create_about_us_hc_cpt() {

    $labels = array(
        'name'               => 'About Us HC',
        'singular_name'      => 'About Us HC',
        'menu_name'          => 'About Us HC',
        'name_admin_bar'     => 'About Us HC',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New About Us HC',
        'new_item'           => 'New About Us HC',
        'edit_item'          => 'Edit About Us HC',
        'view_item'          => 'View About Us HC',
        'all_items'          => 'All About Us HC',
        'search_items'       => 'Search About Us HC',
        'not_found'          => 'No About Us HC found.',
        'not_found_in_trash' => 'No About Us HC found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for About Us HC section',
        'public'             => true,
        'menu_icon'          => 'dashicons-admin-users', // 👥 Good icon for "About Us"
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'about-us-hc'),
        'show_in_rest'       => true, // ✅ Enable Gutenberg + REST API
    );

    register_post_type('about_us_hc', $args);
}
add_action('init', 'create_about_us_hc_cpt');


///

add_action('template_redirect', function () {
    if (isset($_GET['download_gallery_section']) && $_GET['download_gallery_section'] == 1) {
        global $post;
        error_log('Download triggered for post ID: ' . $post->ID);

        $post_id = $post->ID;
        error_log('Gallery field: ' . print_r(get_field('gallery_images', $post_id), true));


        $images = get_field('gallery_images', $post_id);

        error_log('Images found: ' . print_r($images, true));

        if ($images) {
            $zip = new ZipArchive();
            $zip_name = 'section-gallery-images.zip';
            $tmp_file = tempnam(sys_get_temp_dir(), $zip_name);

            if ($zip->open($tmp_file, ZipArchive::CREATE) === TRUE) {
                foreach ($images as $img) {
                    if (!empty($img['url'])) {
                        $img_url = $img['url'];
                        $img_name = !empty($img['filename'])
                            ? $img['filename']
                            : basename(parse_url($img_url, PHP_URL_PATH));

                        $response = wp_remote_get($img_url);
                        if (!is_wp_error($response) && !empty($response['body'])) {
                            $zip->addFromString($img_name, $response['body']);
                        }
                    }
                }
                $zip->close();

                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $zip_name . '"');
                header('Content-Length: ' . filesize($tmp_file));
                readfile($tmp_file);
                unlink($tmp_file);
                exit;
            }
        }

        wp_die('No images found to download in this section.');
    }
});



// function my_acf_amenities_icons( $field ) {
//     $field['choices'] = array(
//         'fa-bed'           => 'Bed',
//         'fa-swimming-pool' => 'Swimming Pool',
//         'fa-wifi'          => 'Wi-Fi',
//         'fa-parking'       => 'Parking',
//         'fa-utensils'      => 'Restaurant',
//         'fa-coffee'        => 'Coffee Maker',
//         'fa-couch'         => 'Couch',
//         'fa-blender'       => 'Blender',
//         'fa-door-closed'   => 'Door',
//         'fa-washer'        => 'Washing Machine',
//         'fa-dumbbell'      => 'Gym',
//         'fa-spa'           => 'Spa',
//         'fa-hot-tub'       => 'Hot Tub',
//         'fa-bicycle'       => 'Bicycle Rental',
//         'fa-shuttle-van'   => 'Shuttle Service',
//     );
//     return $field;
// }

// // Target the sub field by its exact name "icon"
// add_filter('acf/load_field/name=icon', 'my_acf_amenities_icons');


add_filter('acf/load_field/name=icon', function ($field) {

    // Default SVG icons (these will appear first)
    $svg_icons = array(
        'icon1' => 'Default Icon 1',
        'icon2' => 'Default Icon 2',
    );

    // Font Awesome icons
    $fa_icons = array(
    'fa-bed'                 => 'King size bed 180 x 200 cm',
    'fa-tv'                  => 'Four LED TV screens',
    'fa-fan'                 => 'Air conditioning',
    'fa-volume-up'           => 'Surround sound system',
    'fa-coffee'              => 'Nespresso machine',
    'fa-seedling'            => 'Fresh flowers',
    'fa-glass-martini-alt'   => 'Wine cabinet and minibar',
    'fa-lock'                => 'Safe for secure storage of valuables',
    'fa-tshirt'              => 'Walk-in closet',
    'fa-warehouse'           => 'Wardrobe space',
    'fa-bath'                => 'Bathtub and rain shower',
    'fa-person-booth'        => 'Bathrobes, slippers and hairdryer',
    'fa-pump-soap'           => 'SPREKENHUS toiletries',
    'fa-concierge-bell'      => 'Turndown service',
    'fa-dumbbell'            => 'Private training room',
    'fa-wifi'                => 'Free WiFi',
    'fa-smoking-ban'         => 'No smoking',
    'fa-utensils'            => 'Fully equipped kitchen',
    'fa-chair'               => 'Dining table with lounge',
    'fa-restroom'            => 'Guest toilet',
    'fa-fire'                => 'Gas fireplace both inside and outside',
    'fa-music'               => 'Yamaha grand piano',
    'fa-spa'                 => 'Steam bath',
    'fa-lightbulb'           => 'Digital control of lights, music, blinds and curtains etc.',
    'fa-sun'                 => 'Two terraces - one on each floor',
    'fa-door-open'           => 'Private entrance and elevator',
    'fa-bed-alt'             => 'Connected junior suite for extra space',
);


    // Merge SVG + Font Awesome
    $field['choices'] = array_merge($svg_icons, $fa_icons);

    // Optionally, pre-select the first SVG icon as default
    $field['default_value'] = 'icon1';

    return $field;
});


// meeting room
function create_meeting_room_cpt() {

    $labels = array(
        'name'               => 'Meeting Rooms',
        'singular_name'      => 'Meeting Room',
        'menu_name'          => 'Meeting Rooms',
        'name_admin_bar'     => 'Meeting Room',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Meeting Room',
        'new_item'           => 'New Meeting Room',
        'edit_item'          => 'Edit Meeting Room',
        'view_item'          => 'View Meeting Room',
        'all_items'          => 'All Meeting Rooms',
        'search_items'       => 'Search Meeting Rooms',
        'not_found'          => 'No Meeting Rooms found.',
        'not_found_in_trash' => 'No Meeting Rooms found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Custom post type for Meeting Rooms',
        'public'             => true,
        'menu_icon'          => 'dashicons-building', // 🏢 Better icon for rooms/spaces
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => false,
        'rewrite'            => array('slug' => 'meeting-room', 'with_front' => true), // URL: yoursite.com/meeting-room
        'show_in_rest'       => true, // ✅ Gutenberg + REST API
    );

    register_post_type('meeting_room', $args);
}
add_action('init', 'create_meeting_room_cpt');
