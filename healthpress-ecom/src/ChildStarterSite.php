<?php

use Timber\Site;

/**
 * Class StarterSite
 */
class ChildStarterSite extends Site {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );

		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber/twig/environment/options', [ $this, 'update_twig_environment_options' ] );

		parent::__construct();
	}

	/**
	 * This is where you can register custom post types.
	 */
	public function register_post_types() {

	}

	/**
	 * This is where you can register custom taxonomies.
	 */
	public function register_taxonomies() {

	}

	/**
	 * This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['cart_count'] = WC()->cart->get_cart_contents_count();
        $context['cart_total'] = WC()->cart->get_cart_total();
		$context['cart_url'] = wc_get_cart_url();
		$context['menu']  = Timber::get_menu();
		$context['site']  = $this;

		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/**
	 * his would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @param Twig\Environment $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		/**
		 * Required when you want to use Twig’s template_from_string.
		 * @link https://twig.symfony.com/doc/3.x/functions/template_from_string.html
		 */
		// $twig->addExtension( new Twig\Extension\StringLoaderExtension() );


		$twig->addFunction(new Twig\TwigFunction('child_global_script', function () {
			wp_register_script(
			  'child_global_script',
			  get_stylesheet_directory_uri() . '/static/site-min.js',
			  [],
			  '0.01'
			);
			wp_enqueue_script('child_global_script');
		}));

		$twig->addFunction(new Twig\TwigFunction('wc_ajax_script', function () {
			wp_enqueue_script('ajax-cart-script', get_stylesheet_directory_uri() . '/static/woocommerce-cart-min.js', array(), null, true);
			wp_localize_script('ajax-cart-script', 'wc_cart_params', array('ajax_url' => admin_url('admin-ajax.php')));
		}));

		
		$twig->addFunction(new Twig\TwigFunction('get_featured_products', function ($category = null) {
			if(!$category)$category=332;
			$args = array(
				'post_type'             => 'product',
				'post_status'           => 'publish',
				'ignore_sticky_posts'   => 1
			);
			$products = new WP_Query($args);
			return $products->posts;
	     }));

		 $twig->addFunction(new Twig\TwigFunction('get_products_by_category', function ($category = null) {
			
			$args = array(
				'post_type'             => 'product',
				'post_status'           => 'publish',
				'ignore_sticky_posts'   => 1,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'term_id',
						'terms' => $category
					)
				)
			);
			
			$products = new WP_Query($args);
			return $products->posts;
	     }));

		$twig->addFunction(new Twig\TwigFunction('productprice', function ($product) {
			$wcproduct = wc_get_product( $product );
			$myprice = $wcproduct->get_price();
			return $myprice;
		}));

		$twig->addFunction(new Twig\TwigFunction('get_bf_upcoming_trainings', function () {
			
			$external_url = "http://bestfriendpdev.wpenginepowered.com/wp-json/bestfriends/upcomingtrainings";
			$trainings = wp_remote_get($external_url, array(
				'headers' => array(
					'Content-Type' => 'application/json'
				)
			));
			$upcomingtrainings = json_decode(wp_remote_retrieve_body( $trainings));
			return $upcomingtrainings;
			
		}));

		$twig->addFunction(new Twig\TwigFunction('get_acf_product_authors', function($product){
			
			$productAuthors = get_field('product_author', $product->ID);
			
			return $productAuthors;
		}));

		
		 

		return $twig;
	}

	/**
	 * Updates Twig environment options.
	 *
	 * @link https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * \@param array $options An array of environment options.
	 *
	 * @return array
	 */
	function update_twig_environment_options( $options ) {
	    // $options['autoescape'] = true;

	    return $options;
	}
}
