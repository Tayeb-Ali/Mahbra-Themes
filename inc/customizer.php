<?php
/**
 * Eggnews Theme Customizer.
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eggnews_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'eggnews_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eggnews_customize_preview_js() {
	global $eggnews_version;
	wp_enqueue_script( 'eggnews_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), esc_attr( $eggnews_version ), true );
}
add_action( 'customize_preview_init', 'eggnews_customize_preview_js' );

/**
 * Customizer Callback functions
 */
function eggnews_related_articles_option_callback( $control ) {
    if ( $control->manager->get_setting( 'eggnews_related_articles_option' )->value() != 'disable' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Load customizer panels
 */
require get_template_directory() . '/inc/admin/assets/panels/general-panel.php'; //General settings panel
require get_template_directory() . '/inc/admin/assets/panels/header-panel.php'; //header settings panel
require get_template_directory() . '/inc/admin/assets/panels/design-panel.php'; //Design Settings panel
require get_template_directory() . '/inc/admin/assets/panels/additional-panel.php'; //Additional settings panel