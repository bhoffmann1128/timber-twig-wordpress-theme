<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/StarterSite.php';

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


add_action('admin_enqueue_scripts', 'register_admin_scripts');
function register_admin_scripts() {
    wp_enqueue_script('custom_admin_scripts', get_template_directory_uri() . '/static/admin-script-min.js', array( 'acf-input' ));
}


function knolaust_override_MCE_options($init)
{
    // Define custom colors with their corresponding HEX codes and names
    $custom_colors = '
        "8b1e20", "Best Friends Red",
        "037172", "Best Friends Green",
        "006fba", "HPP Blue",
        "0f8c44", "HPP Green",
        "ffffff", "White",
        "000000", "Black",
        "333333", "Charcoal",
        "eaeaea", "Light Gray"
    ';

    // Build the color grid palette using custom colors
    $init['textcolor_map'] = '[' . $custom_colors . ']';

    // Change the number of rows in the color grid (1 row in this case)
    $init['textcolor_rows'] = 1;

    return $init;
}

// Add a filter to apply the custom color settings
add_filter('tiny_mce_before_init', 'knolaust_override_MCE_options');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function hpp_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Left',
		'id'            => 'hpp_footer__left',
		'before_widget' => '<div class="footer__widget_left">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer__widget_title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
		'name'          => 'Footer Center',
		'id'            => 'hpp_footer__center',
		'before_widget' => '<div class="footer__widget_center">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer__widget_title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
		'name'          => 'Footer Right',
		'id'            => 'hpp_footer__right',
		'before_widget' => '<div class="footer__widget_right">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer__widget_title">',
		'after_title'   => '</h2>',
	) );


}
add_action( 'widgets_init', 'hpp_widgets_init' );

function custom_excerpt_more( $more ) {
    return '';//you can change this to whatever you want
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new StarterSite();
