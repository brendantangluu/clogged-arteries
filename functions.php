<?php

/**
 * Clogged Arteries functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Clogged_Arteries
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function clogged_arteries_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Clogged Arteries, use a find and replace
		* to change 'clogged-arteries' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('clogged-arteries', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/	
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'clogged-arteries'),
			'footer' => esc_html__('Footer', 'clogged-arteries')
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'clogged_arteries_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clogged_arteries_content_width()
{
	$GLOBALS['content_width'] = apply_filters('clogged_arteries_content_width', 640);
}
add_action('after_setup_theme', 'clogged_arteries_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/**
 * Enqueue scripts and styles.
 */
function clogged_arteries_scripts()
{
	wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyD8KAvyVe1stczbdQpFAeDxud3pTmblB8I', array(), _S_VERSION, true);

	wp_enqueue_script('googleMapCustomJs', get_template_directory_uri() . '/js/map.js', array('googleMap'), _S_VERSION, true);

	wp_enqueue_style('clogged-arteries-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('clogged-arteries-style', 'rtl', 'replace');

	wp_enqueue_script('clogged-arteries-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	wp_enqueue_script('jquery');

	wp_enqueue_script(
		'careers-tabs',
		get_template_directory_uri() . '/js/career-tabs.js',
		array('jquery'),
		'1.0.0',
		true
	);

	wp_enqueue_script(
		'locationSwitcher',
		get_template_directory_uri() . '/js/location-switcher.js',
		array(),
		'1.0',
	);

	wp_enqueue_style(
		'cla-googlefonts',
		'https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Oswald:wght@200..700&display=swap',
		array(),
		null
	);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if ( is_page( '86' ) ) {

		wp_enqueue_style(
			'swiper-styles',
			get_template_directory_uri() . '/css/swiper-bundle.css',
			array(),
			'11.1.0'
		);

		wp_enqueue_script(
			'swiper-scripts',
			get_template_directory_uri() . '/js/swiper-bundle.min.js',
			array(),
			'11.1.0',
			array( 'strategy' => 'defer' )
		);

		wp_enqueue_script(
			'swiper-settings',
			get_template_directory_uri () . '/js/swiper-settings.js',
			array( 'swiper-scripts' ),
			_S_VERSION,
			array( 'strategy' => 'defer' )
		);

	}
}
add_action('wp_enqueue_scripts', 'clogged_arteries_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

// Start session
function start_session()
{
	if (!session_id()) {
		session_start();
	}
}
add_action('init', 'start_session');

// Google Map API
function my_acf_google_map_api($api)
{
	$api['key'] = 'AIzaSyD8KAvyVe1stczbdQpFAeDxud3pTmblB8I';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Remove admin menu links for non-Administrator accounts
function fwd_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'edit.php' );           // Remove Posts link
		remove_menu_page( 'edit-comments.php' );  // Remove Comments link
	}
}
add_action( 'admin_menu', 'fwd_remove_admin_links' );
