<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
function eggnews_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eggnews' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This sidebar will appear only if you choose right sidebar.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'eggnews' ),
		'id'            => 'eggnews_left_sidebar',
		'description'   => esc_html__( 'This sidebar will appear only if you choose left sidebar.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Ads', 'eggnews' ),
		'id'            => 'eggnews_header_ads_area',
		'description'   => esc_html__( 'This sidebar will appear on header section of a page.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Slider Area', 'eggnews' ),
		'id'            => 'eggnews_home_slider_area',
		'description'   => esc_html__( 'This sidebar will appear below header(after menu) section of News Home Page Template.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Content Area', 'eggnews' ),
		'id'            => 'eggnews_home_content_area',
		'description'   => esc_html__( 'This sidebar will appear below Home Page Slider section of News Home Page Template. ' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Sidebar', 'eggnews' ),
		'id'            => 'eggnews_home_sidebar',
		'description'   => esc_html__( 'Home page sidebar of News Home Page Template.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1st Column', 'eggnews' ),
		'id'            => 'eggnews_footer_one',
		'description'   => esc_html__( 'First column of footer section. Appear only if at least one column footer widget area selected from customizer footer settings.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2nd Column', 'eggnews' ),
		'id'            => 'eggnews_footer_two',
		'description'   => esc_html__( 'Second column of footer section. Appear only if at least two column footer widget area selected from customizer footer settings.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3rd Column', 'eggnews' ),
		'id'            => 'eggnews_footer_three',
		'description'   => esc_html__( 'Third column of footer section. Appear only if at least three column footer widget area selected from customizer footer settings.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4th Column', 'eggnews' ),
		'id'            => 'eggnews_footer_four',
		'description'   => esc_html__( 'Fourth column of footer section. Appear only if at least four column footer widget area selected from customizer footer settings.' , 'eggnews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

}

add_action( 'widgets_init', 'eggnews_widgets_init' );


/**
 * Load widgets files
 */
require get_template_directory() . '/inc/widgets/eggnews-widget-fields.php';
require get_template_directory() . '/inc/widgets/eggnews-featured-slider.php';
require get_template_directory() . '/inc/widgets/eggnews-post-carousel.php';
require get_template_directory() . '/inc/widgets/eggnews-block-grid.php';
require get_template_directory() . '/inc/widgets/eggnews-block-column.php';
require get_template_directory() . '/inc/widgets/eggnews-block-layout.php';
require get_template_directory() . '/inc/widgets/eggnews-posts-list.php';
require get_template_directory() . '/inc/widgets/eggnews-block-list.php';
