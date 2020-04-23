<?php
/**
 * Customizer option for Design Settings
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'customize_register', 'eggnews_design_settings_register' );

function eggnews_design_settings_register( $wp_customize ) {

	/**
	 * Add Design Panel
	 */
	$wp_customize->add_panel(
		'eggnews_design_settings_panel',
		array(
			'priority'       => 6,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Design Settings', 'eggnews' ),
		)
	);

	/*--------------------------------------------------------------------------------*/
	/**
	 * Archive page Settings
	 */
	$wp_customize->add_section(
		'eggnews_archive_section',
		array(
			'title'    => esc_html__( 'Archive Settings', 'eggnews' ),
			'priority' => 10,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'eggnews_archive_sidebar',
		array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Eggnews_Image_Radio_Control(
			$wp_customize,
			'eggnews_archive_sidebar',
			array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'eggnews' ),
				'description' => esc_html__( 'Select sidebar for whole site archives, categories, search page etc.', 'eggnews' ),
				'section'     => 'eggnews_archive_section',
				'priority'    => 4,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png'
				)
			)
		)
	);

	//Archive page layouts
	$wp_customize->add_setting(
		'eggnews_archive_layout',
		array(
			'default'           => 'classic',
			'sanitize_callback' => 'eggnews_sanitize_archive_layout',
		)
	);
	$wp_customize->add_control(
		'eggnews_archive_layout',
		array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Archive Page Layout', 'eggnews' ),
			'description' => esc_html__( 'Choose available layout for all archive pages.', 'eggnews' ),
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'classic' => esc_html__( 'Classic Layout', 'eggnews' ),
				'columns' => esc_html__( 'Columns Layout', 'eggnews' )
			),
			'priority'    => 5
		)
	);

	/*--------------------------------------------------------------------------------*/
	/**
	 * Single post Settings
	 */
	$wp_customize->add_section(
		'eggnews_single_post_section',
		array(
			'title'    => esc_html__( 'Post Settings', 'eggnews' ),
			'priority' => 15,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'eggnews_default_post_sidebar',
		array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Eggnews_Image_Radio_Control(
			$wp_customize,
			'eggnews_default_post_sidebar',
			array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'eggnews' ),
				'description' => esc_html__( 'Select sidebar for whole single post page.', 'eggnews' ),
				'section'     => 'eggnews_single_post_section',
				'priority'    => 4,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png'
				)
			)
		)
	);

	//Author box
	$wp_customize->add_setting(
		'eggnews_author_box_option',
		array(
			'default'           => 'show',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_author_box_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Author Option', 'eggnews' ),
				'description' => esc_html__( 'Enable/disable author information at single post page.', 'eggnews' ),
				'priority'    => 5,
				'section'     => 'eggnews_single_post_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'eggnews' ),
					'hide' => esc_html__( 'Hide', 'eggnews' )
				)
			)
		)
	);

	//Related Articles
	$wp_customize->add_setting(
		'eggnews_related_articles_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_related_articles_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Related Articles Option', 'eggnews' ),
				'description' => esc_html__( 'Enable/disable related articles section at single post page.', 'eggnews' ),
				'priority'    => 7,
				'section'     => 'eggnews_single_post_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews' ),
					'disable' => esc_html__( 'Disable', 'eggnews' )
				)
			)
		)
	);

	//Related articles section title
	$wp_customize->add_setting(
		'eggnews_related_articles_title',
		array(
			'default'           => esc_html__( 'Related Articles', 'eggnews' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'eggnews_related_articles_title',
		array(
			'type'            => 'text',
			'label'           => esc_html__( 'Section Title', 'eggnews' ),
			'section'         => 'eggnews_single_post_section',
			'active_callback' => 'eggnews_related_articles_option_callback',
			'priority'        => 8
		)
	);

	// Types of Related articles
	$wp_customize->add_setting(
		'eggnews_related_articles_type',
		array(
			'default'           => 'category',
			'sanitize_callback' => 'eggnews_sanitize_related_type',
		)
	);
	$wp_customize->add_control(
		'eggnews_related_articles_type',
		array(
			'type'            => 'radio',
			'label'           => esc_html__( 'Types of Related Articles', 'eggnews' ),
			'description'     => esc_html__( 'Option to display related articles from category/tags.', 'eggnews' ),
			'section'         => 'eggnews_single_post_section',
			'choices'         => array(
				'category' => esc_html__( 'by Category', 'eggnews' ),
				'tag'      => esc_html__( 'by Tags', 'eggnews' )
			),
			'active_callback' => 'eggnews_related_articles_option_callback',
			'priority'        => 9
		)
	);
	/*--------------------------------------------------------------------------------*/
	/**
	 * Single page Settings
	 */
	$wp_customize->add_section(
		'eggnews_single_page_section',
		array(
			'title'    => esc_html__( 'Page Settings', 'eggnews' ),
			'priority' => 20,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'eggnews_default_page_sidebar',
		array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Eggnews_Image_Radio_Control(
			$wp_customize,
			'eggnews_default_page_sidebar',
			array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'eggnews' ),
				'description' => esc_html__( 'Select sidebar for whole single page.', 'eggnews' ),
				'section'     => 'eggnews_single_page_section',
				'priority'    => 4,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png'
				)
			)
		)
	);

	/*--------------------------------------------------------------------------------------------------------*/
	/**
	 * Footer widget area
	 */
	$wp_customize->add_section(
		'eggnews_footer_widget_section',
		array(
			'title'    => esc_html__( 'Footer Settings', 'eggnews' ),
			'priority' => 25,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);
	// Footer widget area
	$wp_customize->add_setting(
		'footer_widget_option',
		array(
			'default'           => 'column3',
			'sanitize_callback' => 'eggnews_footer_widget_sanitize',
		)
	);
	$wp_customize->add_control(
		'footer_widget_option',
		array(
			'type'        => 'radio',
			'priority'    => 4,
			'label'       => esc_html__( 'Footer Widget Area', 'eggnews' ),
			'description' => esc_html__( 'Choose option to display number of columns in footer area.', 'eggnews' ),
			'section'     => 'eggnews_footer_widget_section',
			'choices'     => array(
				'column1' => esc_html__( 'One Column', 'eggnews' ),
				'column2' => esc_html__( 'Two Columns', 'eggnews' ),
				'column3' => esc_html__( 'Three Columns', 'eggnews' ),
				'column4' => esc_html__( 'Four Columns', 'eggnews' ),
			),
		)
	);

	//Copyright text
	$wp_customize->add_setting(
		'eggnews_copyright_text',
		array(
			'default'           => esc_html__( '2017 eggnews', 'eggnews' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'eggnews_copyright_text',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Copyright Info', 'eggnews' ),
			'section'  => 'eggnews_footer_widget_section',
			'priority' => 5
		)
	);
	

}
