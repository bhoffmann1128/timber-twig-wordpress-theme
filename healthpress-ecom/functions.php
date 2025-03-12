<?php
/**
 * HPP Ecomm Child Theme
 * Based off Timber Starter Theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/ChildStarterSite.php';

function theme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'theme_add_woocommerce_support');

function timber_set_product($post)
{
    global $product;

    if (is_woocommerce()) {
        $product = wc_get_product($post->ID);
    }
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 15;
  return $cols;
}

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
    function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 5; // 4 related products
    $args['columns'] = 5; // arranged in 2 columns
    return $args;
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );

function custom_ajax_get_cart_count() {
    $cart_number = WC()->cart->get_cart_contents_count();
    $cart_total = WC()->cart->get_cart_total();
    

    echo json_encode([$cart_number, $cart_total]);
    wp_die();
}
add_action('wp_ajax_get_cart_count', 'custom_ajax_get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'custom_ajax_get_cart_count');

/**
 * Customize product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {

	$tabs['author-bio']['callback'] = 'woo_custom_authorbio_tab_content';	// Custom description callback

	return $tabs;
}

function woo_custom_authorbio_tab_content() {

    $productAuthor = get_field('product_author');

    if($productAuthor){
        foreach($productAuthor as $author){
            echo '<div class="authorbio__tabbio">';
            echo "<h2>" . $author->post_title . "</h2>";
            echo "<div>" . $author->post_content . "</div>";
            echo '</div>';
        };
    }
}

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new ChildStarterSite();
