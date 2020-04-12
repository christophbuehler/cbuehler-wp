<?php
/**
 * cbuehlerli functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cbuehlerli
 */

if ( ! function_exists( 'cbuehlerli_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cbuehlerli_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on cbuehlerli, use a find and replace
		 * to change 'cbuehlerli' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cbuehlerli', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cbuehlerli' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'cbuehlerli_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		
	}

	function theme_section_description () {
		echo '<p>Settings for your theme.</p>';
	}
endif;
add_action( 'after_setup_theme', 'cbuehlerli_setup' );
add_action('admin_menu', 'add_cbuehlerli_menu');
function add_cbuehlerli_menu() {
	add_menu_page(
		'Cbuehlerli Theme',
		'Cbuehlerli Theme',
		'manage_options',
		'cbuehlerli_theme'
	);

    // add_settings_section (
	// 	'cbuehlerli_design', //section name for the section to add
	// 	'Buehler Theme Settings', //section title visible on the page
	// 	'theme_section_description', //callback for section description
	// 	'Cbuehlerli Theme'//page to which section will be added.
	// );

	// add_settings_field (
	// 	'first_field_option', //ID for the settings field to add
	// 	'TestField', //settings title visible on the page
	// 	'options_callback', //callback for displaying the settings field
	// 	'Cbuehlerli Theme', // settings page to where option is displayed
	// 	'first_section'// section id for parent section.
	// );
} 


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cbuehlerli_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'cbuehlerli_content_width', 640 );
}
add_action( 'after_setup_theme', 'cbuehlerli_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cbuehlerli_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cbuehlerli' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cbuehlerli' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cbuehlerli_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cbuehlerli_scripts() {
	wp_enqueue_style( 'cbuehlerli-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cbuehlerli-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'cbuehlerli-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cbuehlerli_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

