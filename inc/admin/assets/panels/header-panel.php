<?php
/**
 * Customizer option for Header sections
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'customize_register', 'eggnews_header_settings_register' );

function eggnews_header_settings_register( $wp_customize ) {
	/**
	 * Add header panels
	 */
	$wp_customize->add_panel(
		'eggnews_header_settings_panel',
		array(
			'priority'       => 4,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Header Settings', 'eggnews' ),
		)
	);
	/*----------------------------------------------------------------------------------------------------*/
	/**
	 * Top Header Section
	 */
	$wp_customize->add_section(
		'eggnews_top_header_section',
		array(
			'title'    => esc_html__( 'Top Header Section', 'eggnews' ),
			'priority' => 5,
			'panel'    => 'eggnews_header_settings_panel'
		)
	);

	//Ticker display option
	$wp_customize->add_setting(
		'eggnews_ticker_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_ticker_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'News Ticker Option', 'eggnews' ),
				'description' => esc_html__( 'Enable/disable news ticker at header.', 'eggnews' ),
				'priority'    => 1,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews' ),
					'disable' => esc_html__( 'Disable', 'eggnews' )
				)
			)
		)
	);


	//Ticker Caption
	$wp_customize->add_setting(
		'eggnews_ticker_caption',
		array(
			'default'           => esc_html__( 'Latest', 'eggnews' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'eggnews_ticker_caption',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'News Ticker Caption', 'eggnews' ),
			'section'  => 'eggnews_top_header_section',
			'priority' => 2
		)
	);
	// Show ticker in all page or only front page /*
	$wp_customize->add_setting(
		'all_page_eggnews_ticker_option',
		array(
			'default'           => 'no',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_all_page_ticker_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'all_page_eggnews_ticker_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Show on all page', 'eggnews' ),
				'description' => esc_html__( 'Select yes, if you want to show ticker on all page.', 'eggnews' ),
				'priority'    => 3,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'yes' => esc_html__( 'Yes', 'eggnews' ),
					'no'  => esc_html__( 'No', 'eggnews' )
				)
			)
		)
	);

	// Display Current Date
	$wp_customize->add_setting(
		'eggnews_header_date',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_header_date',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Current Date Option', 'eggnews' ),
				'description' => esc_html__( 'Enable/disable current date from top header.', 'eggnews' ),
				'priority'    => 4,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews' ),
					'disable' => esc_html__( 'Disable', 'eggnews' )
				)
			)
		)
	);

	// Option about top header social icons
	$wp_customize->add_setting(
		'eggnews_header_social_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_header_social_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Social Icon Option', 'eggnews' ),
				'description' => esc_html__( 'Enable/disable social icons from top header (right).', 'eggnews' ),
				'priority'    => 5,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews' ),
					'disable' => esc_html__( 'Disable', 'eggnews' )
				)
			)
		)
	);
	/*----------------------------------------------------------------------------------------------------*/
	/**
	 * Sticky Header
	 */
	$wp_customize->add_section(
		'eggnews_sticky_header_section',
		array(
			'title'    => esc_html__( 'Sticky Menu', 'eggnews' ),
			'priority' => 10,
			'panel'    => 'eggnews_header_settings_panel'
		)
	);

	//Sticky header option
	$wp_customize->add_setting(
		'eggnews_sticky_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_sticky_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Menu Sticky', 'eggnews' ),
				'description' => esc_html__( 'Enable/disable option for Menu Sticky', 'eggnews' ),
				'priority'    => 4,
				'section'     => 'eggnews_sticky_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews' ),
					'disable' => esc_html__( 'Disable', 'eggnews' )
				)
			)
		)
	);

	/*----------------------------------------------------------------------------------------------------*/
}
