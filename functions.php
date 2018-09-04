<?php
/**
 * carousel-post functions and definitions

  *
  * @link https://developer.wordpress.org/themes/basics/theme-functions/
  *
  * @package carousel-post
  */
  // Register Custom Navigation Walker
  require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

  if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
  	// file does not exist... return an error.
  	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
  } else {
  	// file exists... require it.
  	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
  }
	/*
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package carousel-post
 */

if ( ! function_exists( 'carousel_post_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function carousel_post_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on carousel-post, use a find and replace
		 * to change 'carousel-post' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'carousel-post', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'carousel-post' ),
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
		add_theme_support( 'custom-background', apply_filters( 'carousel_post_custom_background_args', array(
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
			'height'      => 53,
			'width'       => 120,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'carousel_post_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function carousel_post_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'carousel_post_content_width', 1170 );
}
add_action( 'after_setup_theme', 'carousel_post_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function carousel_post_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'carousel-post' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'carousel-post' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'carousel_post_widgets_init' );



/**
 * adding carousel bootstrap option in the theme
 */


function carousel_slider_option(){

  register_post_type('carouselslider', array(
    'labels'          => array(

      'name'          => 'Carousel Slider',
      'add_new_item'  => 'Add New Carousel'
    ),
    'public'          => true,
    'menu_icon'       =>'dashicons-images-alt',
    'supports'         =>array('title', 'editor', 'thumbnail')

  ));
}
add_action('after_setup_theme', 'carousel_slider_option');




   /**
    * condition for adding bootstrap class "fixed-top" and "navclass-jq " to  display nav bootstrap over the carousel.
    */

    function main_js() {

      wp_register_script('main_js', get_template_directory_uri() . '/js/main.js', false, null, true);

        if ( is_front_page() ) {

    	  wp_enqueue_script('main_js');
        }

      }

      add_action( 'wp_enqueue_scripts', 'main_js' );






/**
 * Enqueue scripts and styles.
 */
function carousel_post_scripts() {
	wp_enqueue_style( 'carousel-post-style', get_stylesheet_uri() );

  wp_enqueue_style( 'Custom_carousel', get_template_directory_uri() . '/style/custom_style_carousel.css');
	wp_enqueue_style( 'lato_font', '//fonts.googleapis.com/css?family=Lato');
	wp_enqueue_style( 'wpbootstrap_css', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
	wp_enqueue_style( 'animated_css', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css');
	wp_enqueue_script( 'wpbootstrap_js', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'popper_js', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), '', true );
  wp_enqueue_script('jquery');

	wp_enqueue_script( 'carousel-post-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'carousel_post_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
