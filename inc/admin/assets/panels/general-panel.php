<?php
/**
 * Customizer settings for General purpose
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'customize_register', 'eggnews_general_settings_register' );

function eggnews_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel        = 'eggnews_general_settings_panel';
	$wp_customize->get_section( 'title_tagline' )->priority     = '3';
	$wp_customize->get_section( 'colors' )->panel               = 'eggnews_general_settings_panel';
	$wp_customize->get_section( 'colors' )->priority            = '4';
	$wp_customize->get_section( 'background_image' )->panel     = 'eggnews_general_settings_panel';
	$wp_customize->get_section( 'background_image' )->priority  = '5';
	$wp_customize->get_section( 'static_front_page' )->panel    = 'eggnews_general_settings_panel';
	$wp_customize->get_section( 'static_front_page' )->priority = '6';

	/**
	 * Add General Settings Panel
	 */
	$wp_customize->add_panel(
		'eggnews_general_settings_panel',
		array(
			'priority'       => 3,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'General Settings', 'eggnews' ),
		)
	);

	/*-----------------------------------------------*/
	//Theme color
	$wp_customize->add_setting(
		'eggnews_theme_color',
		array(
			'default'           => '#1b651b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'eggnews_theme_color',
			array(
				'label'    => esc_html__( 'Theme color', 'eggnews' ),
				/*'description'   => esc_html__( 'Choose color to make different your website.', 'eggnews' ),*/
				'section'  => 'colors',
				'priority' => 5
			)
		)
	);

	/*---------------------------------------------------------------------------------------------------------------*/
	/**
	 * Website layout
	 */
	$wp_customize->add_section(
		'eggnews_site_layout',
		array(
			'title'       => esc_html__( 'Website Layout', 'eggnews' ),
			'description' => esc_html__( 'Choose a site to display your website more effectively.', 'eggnews' ),
			'priority'    => 5,
			'panel'       => 'eggnews_general_settings_panel',
		)
	);

	$wp_customize->add_setting(
		'site_layout_option',
		array(
			'default'           => 'fullwidth_layout',
			'sanitize_callback' => 'eggnews_sanitize_site_layout',
		)
	);
	$wp_customize->add_control(
		'site_layout_option',
		array(
			'type'     => 'radio',
			'priority' => 10,
			'label'    => esc_html__( 'Site Layout', 'eggnews' ),
			'section'  => 'eggnews_site_layout',
			'choices'  => array(
				'fullwidth_layout' => esc_html__( 'FullWidth Layout', 'eggnews' ),
				'boxed_layout'     => esc_html__( 'Boxed Layout', 'eggnews' )
			),
		)
	);
}
