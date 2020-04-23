<?php
/**
 *  Define extra or custom functions
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

/**
 * Enqueue Scripts and styles for admin
 */
function eggnews_admin_scripts_style( $hook ) {

	global $eggnews_version;

	if ( 'widgets.php' != $hook && 'customize.php' != $hook ) {
		return;
	}

	if ( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_register_script( 'eggnews-media-uploader', get_template_directory_uri() . '/inc/admin/js/media-uploader.js', array( 'jquery' ), 1.70 );
	wp_enqueue_script( 'eggnews-media-uploader' );
	wp_localize_script( 'eggnews-media-uploader', 'eggnews_l10n', array(
		'upload' => esc_html__( 'Upload', 'eggnews' ),
		'remove' => esc_html__( 'Remove', 'eggnews' )
	) );

	wp_enqueue_script( 'eggnews-admin-script', get_template_directory_uri() . '/inc/admin/js/admin-script.js', array( 'jquery' ), esc_attr( $eggnews_version ), true );

	wp_enqueue_style( 'eggnews-admin-style', get_template_directory_uri() . '/inc/admin/css/admin-style.css', array(), esc_attr( $eggnews_version ) );
}

add_action( 'admin_enqueue_scripts', 'eggnews_admin_scripts_style' );

/**
 * Enqueue scripts and styles.
 */
function eggnews_scripts() {

	global $eggnews_version;

	$query_args = array(
		'family' => 'Poppins',
	);

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/lib/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );

	wp_enqueue_style( 'eggnews-google-font', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );

	wp_enqueue_style( 'eggnews-style-1', get_template_directory_uri() . '/assets/css/eggnews.css', array(), esc_attr( $eggnews_version ) );

	wp_enqueue_style( 'eggnews-style', get_stylesheet_uri(), array(), esc_attr( $eggnews_version ) );

	wp_enqueue_style( 'eggnews-responsive', get_template_directory_uri() . '/assets/css/eggnews-responsive.css', array(), esc_attr( $eggnews_version ) );

	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri() . '/assets/lib/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );

	// Start : Owl Carousel

	wp_register_style( 'owl-carousel2-style', get_template_directory_uri() . '/assets/lib/owl/assets/owl.carousel.css', array(), esc_attr( $eggnews_version ) );

	wp_register_style( 'owl-carousel2-theme', get_template_directory_uri() . '/assets/lib/owl/assets/owl.theme.default.css', array(), esc_attr( $eggnews_version ) );

	wp_register_script( 'owl-carousel2-script', get_template_directory_uri() . '/assets/lib/owl/owl.carousel.min.js', array( 'jquery' ), esc_attr( $eggnews_version ), true );

	//End : Owl Carousel


	$menu_sticky_option = get_theme_mod( 'eggnews_sticky_option', 'enable' );
	if ( $menu_sticky_option != 'disable' ) {
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/lib/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );

		wp_enqueue_script( 'eggnews-sticky-menu-setting', get_template_directory_uri() . '/assets/lib/sticky/sticky-setting.js', array( 'jquery-sticky' ), '20150309', true );
	}

	wp_enqueue_script( 'eggnews-custom-script', get_template_directory_uri() . '/assets/js/custom-script.js', array( 'jquery-bxslider' ), esc_attr( $eggnews_version ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'eggnews_scripts' );

/*------------------------------------------------------------------------------------------------*/
/**
 * Current date at top header
 */
add_action( 'eggnews_current_date', 'eggnews_current_date_hook' );
if ( ! function_exists( 'eggnews_current_date_hook' ) ):
	function eggnews_current_date_hook() {
		$date_option = get_theme_mod( 'eggnews_header_date', 'enable' );
		if ( $date_option != 'disable' ) {
			?>
			<div class="date-section">
				<?php echo esc_html( date_i18n( 'l, F d, Y' ) ); ?>
			</div>
			<?php
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * News Ticker
 */
add_action( 'eggnews_news_ticker', 'eggnews_news_ticker_hook' );
if ( ! function_exists( 'eggnews_news_ticker_hook' ) ):
	function eggnews_news_ticker_hook() {
		$eggnews_ticker_option          = get_theme_mod( 'eggnews_ticker_option', 'enable' );
		$all_page_eggnews_ticker_option = get_theme_mod( 'all_page_eggnews_ticker_option', 'no' );

		if ( $eggnews_ticker_option != 'disable'
		     && ( ( is_front_page() && $all_page_eggnews_ticker_option == 'no' ) || $all_page_eggnews_ticker_option == 'yes' )
		) {
			$eggnews_ticker_caption = get_theme_mod( 'eggnews_ticker_caption', esc_html__( 'Latest', 'eggnews' ) );
			?>
			<div class="eggnews-ticker-wrapper">
				<span class="ticker-caption"><?php echo esc_html( $eggnews_ticker_caption ); ?></span>
				<div class="ticker-content-wrapper">
					<?php
					$ticker_args  = eggnews_query_args( $cat_id = null, 5 );
					$ticker_query = new WP_Query( $ticker_args );
					if ( $ticker_query->have_posts() ) {
						echo '<ul id="teg-newsTicker" class="cS-hidden">';
						while ( $ticker_query->have_posts() ) {
							$ticker_query->the_post();
							?>
							<li>
								<div class="news-post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</div>
							</li>
							<?php
						}
						echo '</ul>';
					}
					?>
				</div><!-- .ticker-content-wrapper -->
				<div style="clear:both"></div>
			</div><!-- .teg-container -->
			<?php
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Define categories lists in array
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'eggnews_category_array' ) ) :
	function eggnews_category_array() {
		$eggnews_categories = get_categories( array( 'hide_empty' => 0 ) );
		foreach ( $eggnews_categories as $eggnews_category ) {
			$eggnews_category_array[ $eggnews_category->term_id ] = $eggnews_category->cat_name;
		}

		return $eggnews_category_array;
	}
endif;

/**
 * categories in dropdown
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'eggnews_category_dropdown' ) ) :
	function eggnews_category_dropdown() {
		$eggnews_categories             = get_categories( array( 'hide_empty' => 0 ) );
		$eggnews_category_dropdown['0'] = esc_html__( 'Select Category', 'eggnews' );
		foreach ( $eggnews_categories as $eggnews_category ) {
			$eggnews_category_dropdown[ $eggnews_category->term_id ] = $eggnews_category->cat_name;
		}

		return $eggnews_category_dropdown;
	}
endif;


//no of columns
$eggnews_grid_columns = array(
	''  => esc_html__( 'Select No. of Columns', 'eggnews' ),
	'2' => esc_html__( '2 Columns', 'eggnews' ),
	'3' => esc_html__( '3 Columns', 'eggnews' ),
	'4' => esc_html__( '4 Columns', 'eggnews' )
);

/*------------------------------------------------------------------------------------------------*/
/**
 * Custom function for wp_query args
 */
if ( ! function_exists( 'eggnews_query_args' ) ):
	function eggnews_query_args( $cat_id, $post_count = null ) {
		if ( ! empty( $cat_id ) ) {
			$eggnews_args = array(
				'post_type'      => 'post',
				'cat'            => $cat_id,
				'posts_per_page' => $post_count
			);
		} else {
			$eggnews_args = array(
				'post_type'           => 'post',
				'posts_per_page'      => $post_count,
				'ignore_sticky_posts' => 1
			);
		}

		return $eggnews_args;
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * block widget title
 */
if ( ! function_exists( 'eggnews_block_title' ) ):
	function eggnews_block_title( $block_title, $block_cat_id ) {
		$block_cat_name = get_cat_name( $block_cat_id );
		$cat_id_class   = '';
		if ( ! empty( $block_cat_id ) ) {
			$cat_id_class = 'teg-cat-' . $block_cat_id;
			$cat_link     = get_category_link( $block_cat_id );
		}
		if ( ! empty( $block_title ) ) {
			$teg_widget_title = $block_title;
		} elseif ( ! empty( $block_cat_name ) ) {
			$teg_widget_title = $block_cat_name;
		} else {
			$teg_widget_title = '';
		}
		?>
		<div class="block-header <?php echo esc_attr( $cat_id_class ); ?>">
			<h3 class="block-title">
				<?php
				if ( ! empty( $block_cat_id ) ) {
					?>
					<a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $teg_widget_title ); ?></a>
					<?php
				} else {
					echo esc_html( $teg_widget_title );
				}
				?>
			</h3>
		</div>
		<?php
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Posts Categories with dynamic colors
 */
add_action( 'eggnews_post_categories', 'eggnews_post_categories_hook' );
if ( ! function_exists( 'eggnews_post_categories_hook' ) ):
	function eggnews_post_categories_hook() {
		global $post;
		$post_id         = $post->ID;
		$categories_list = get_the_category( $post_id );
		if ( ! empty( $categories_list ) ) {
			?>
			<div class="post-cat-list">
				<?php
				foreach ( $categories_list as $cat_data ) {
					$cat_name = $cat_data->name;
					$cat_id   = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
					?>
					<span class="category-button teg-cat-<?php echo esc_attr( $cat_id ); ?>"><a
							href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * widget posts excerpt in words
 */
if ( ! function_exists( 'eggnews_post_excerpt' ) ):
	function eggnews_post_excerpt( $content, $word_limit ) {
		$get_content   = strip_tags( $content );
		$strip_content = strip_shortcodes( $get_content );
		$excerpt_words = explode( ' ', $strip_content );

		return implode( ' ', array_slice( $excerpt_words, 0, $word_limit ) );
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Define function to show the social media icons
 */
if ( ! function_exists( 'eggnews_social_icons' ) ):
	function eggnews_social_icons() {
		$social_fb_link    = get_theme_mod( 'social_fb_link', '' );
		$social_tw_link    = get_theme_mod( 'social_tw_link', '' );
		$social_gp_link    = get_theme_mod( 'social_gp_link', '' );
		$social_lnk_link   = get_theme_mod( 'social_lnk_link', '' );
		$social_yt_link    = get_theme_mod( 'social_yt_link', '' );
		$social_vm_link    = get_theme_mod( 'social_vm_link', '' );
		$social_pin_link   = get_theme_mod( 'social_pin_link', '' );
		$social_insta_link = get_theme_mod( 'social_insta_link', '' );

		$social_fb_icon = 'fa-facebook';
		$social_fb_icon = apply_filters( 'eggnews_social_fb_icon', $social_fb_icon );

		$social_tw_icon = 'fa-twitter';
		$social_tw_icon = apply_filters( 'eggnews_social_tw_icon', $social_tw_icon );

		$social_gp_icon = 'fa-google-plus';
		$social_gp_icon = apply_filters( 'eggnews_social_gp_icon', $social_gp_icon );

		$social_lnk_icon = 'fa-linkedin';
		$social_lnk_icon = apply_filters( 'eggnews_social_lnk_icon', $social_lnk_icon );

		$social_yt_icon = 'fa-youtube';
		$social_yt_icon = apply_filters( 'eggnews_social_yt_icon', $social_yt_icon );

		$social_vm_icon = 'fa-vimeo';
		$social_vm_icon = apply_filters( 'eggnews_social_vm_icon', $social_vm_icon );

		$social_pin_icon = 'fa-pinterest';
		$social_pin_icon = apply_filters( 'eggnews_social_pin_icon', $social_pin_icon );

		$social_insta_icon = 'fa-instagram';
		$social_insta_icon = apply_filters( 'eggnews_social_insta_icon', $social_insta_icon );

		if ( ! empty( $social_fb_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_fb_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_fb_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_tw_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_tw_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_tw_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_gp_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_gp_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_gp_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_lnk_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_lnk_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_lnk_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_yt_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_yt_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_yt_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_vm_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_vm_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_vm_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_pin_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_pin_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_pin_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_insta_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_insta_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_insta_icon ) . '"></i></a></span>';
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Top header social icon section
 */
add_action( 'eggnews_top_social_icons', 'eggnews_top_social_icons_hook' );
if ( ! function_exists( 'eggnews_top_social_icons_hook' ) ):
	function eggnews_top_social_icons_hook() {
		$top_social_icons = get_theme_mod( 'eggnews_header_social_option', 'enable' );
		if ( $top_social_icons != 'disable' ) {
			?>
			<div class="top-social-wrapper">
				<?php eggnews_social_icons(); ?>
			</div><!-- .top-social-wrapper -->
			<?php
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Add cat id in menu class
 */
function eggnews_category_nav_class( $classes, $item ) {
	if ( 'category' == $item->object ) {
		$category  = get_category( $item->object_id );
		$classes[] = 'teg-cat-' . $category->term_id;
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'eggnews_category_nav_class', 10, 2 );

/*------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
if ( ! function_exists( 'eggnews_hover_color' ) ) :
	function eggnews_hover_color( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( - 255, min( 255, $steps ) );

		// Normalize into a six character long hex string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {
			$color = hexdec( $color ); // Convert to decimal
			$color = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 */
if ( ! function_exists( 'eggnews_sidebar' ) ):
	function eggnews_sidebar() {
		global $post;
		if ( is_single() || is_page() ) {
			$sidebar_meta_option = get_post_meta( $post->ID, 'eggnews_sidebar_location', true );
		}

		if ( is_home() ) {
			$set_id              = get_option( 'page_for_posts' );
			$sidebar_meta_option = get_post_meta( $set_id, 'eggnews_sidebar_location', true );
		}

		if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
			$sidebar_meta_option = 'default_sidebar';
		}

		$eggnews_archive_sidebar      = get_theme_mod( 'eggnews_archive_sidebar', 'right_sidebar' );
		$eggnews_post_default_sidebar = get_theme_mod( 'eggnews_default_post_sidebar', 'right_sidebar' );
		$eggnews_page_default_sidebar = get_theme_mod( 'eggnews_default_page_sidebar', 'right_sidebar' );

		if ( $sidebar_meta_option == 'default_sidebar' ) {
			if ( is_single() ) {
				if ( $eggnews_post_default_sidebar == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $eggnews_post_default_sidebar == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( is_page() ) {
				if ( $eggnews_page_default_sidebar == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $eggnews_page_default_sidebar == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $eggnews_archive_sidebar == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $eggnews_archive_sidebar == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $sidebar_meta_option == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $sidebar_meta_option == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Get author info
 */
add_action( 'eggnews_author_box', 'eggnews_author_box_hook' );
if ( ! function_exists( 'eggnews_author_box_hook' ) ):
	function eggnews_author_box_hook() {
		global $post;
		$author_id             = $post->post_author;
		$author_avatar         = get_avatar( $author_id, '132' );
		$author_nickname       = get_the_author_meta( 'display_name' );
		$eggnews_author_option = get_theme_mod( 'eggnews_author_box_option', 'show' );
		if ( $eggnews_author_option != 'hide' ) {
			?>
			<div class="eggnews-author-wrapper clearfix">
				<div class="author-avatar">
					<a class="author-image"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo $author_avatar; ?></a>
				</div><!-- .author-avatar -->
				<div class="author-desc-wrapper">
					<a class="author-title"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( $author_nickname ); ?></a>
					<div class="author-description"><?php echo get_the_author_meta( 'description' ); ?></div>
					<a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>"
					   target="_blank"><?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?></a>
				</div><!-- .author-desc-wrapper-->
			</div><!--eggnews-author-wrapper-->
			<?php
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Related articles
 */
add_action( 'eggnews_related_articles', 'eggnews_related_articles_hook' );
if ( ! function_exists( 'eggnews_related_articles_hook' ) ):
	function eggnews_related_articles_hook() {
		$eggnews_related_option = esc_attr( get_theme_mod( 'eggnews_related_articles_option', 'enable' ) );
		$eggnews_related_title  = get_theme_mod( 'eggnews_related_articles_title', esc_html__( 'Related Articles', 'eggnews' ) );
		if ( $eggnews_related_option != 'disable' ) {
			?>
			<div class="related-articles-wrapper">
				<div class="widget-title-wrapper">
					<h2 class="related-title"><?php echo esc_html( $eggnews_related_title ); ?></h2>
				</div>
				<?php
				global $post;
				if ( empty( $post ) ) {
					$post_id = '';
				} else {
					$post_id = $post->ID;
				}

				$eggnews_related_type = get_theme_mod( 'eggnews_related_articles_type', 'category' );
				$related_post_count   = 3;
				$related_post_count   = apply_filters( 'eggnews_related_posts_count', $related_post_count );

				// Define related post arguments
				$related_args = array(
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
					'ignore_sticky_posts'    => 1,
					'orderby'                => 'rand',
					'post__not_in'           => array( $post_id ),
					'posts_per_page'         => $related_post_count
				);


				if ( $eggnews_related_type == 'tag' ) {
					$tags = wp_get_post_tags( $post_id );
					if ( $tags ) {
						$tag_ids = array();
						foreach ( $tags as $tag_ed ) {
							$tag_ids[] = $tag_ed->term_id;
						}
						$related_args['tag__in'] = $tag_ids;
					}
				} else {
					$categories = get_the_category( $post_id );
					if ( $categories ) {
						$category_ids = array();
						foreach ( $categories as $category_ed ) {
							$category_ids[] = $category_ed->term_id;
						}
						$related_args['category__in'] = $category_ids;
					}
				}

				$related_query = new WP_Query( $related_args );
				if ( $related_query->have_posts() ) {
					echo '<div class="related-posts-wrapper clearfix">';
					while ( $related_query->have_posts() ) {
						$related_query->the_post();
						?>
						<div class="single-post-wrap">
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php the_post_thumbnail( 'eggnews-block-medium' ); ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->
							<div class="related-content-wrapper">
								<?php do_action( 'eggnews_post_categories' ); ?>
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php eggnews_posted_on(); ?>
								</div>
							</div><!-- related-content-wrapper -->
						</div><!--. single-post-wrap -->
						<?php
					}
					echo '</div>';
				}
				wp_reset_postdata();
				?>
			</div><!-- .related-articles-wrapper -->
			<?php
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Filter the category title
 */
if ( ! function_exists( 'eggnews_get_the_archive_title' ) ) {

	add_filter( 'get_the_archive_title', 'eggnews_get_the_archive_title', 10, 1 );
	function eggnews_get_the_archive_title( $title ) {

		if ( is_category() ) {
			$title = single_cat_title( '', false );
		}

		return $title;
	}
}
