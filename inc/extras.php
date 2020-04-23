<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

/**
 * Adds custom contain in head sections
 */
if ( ! function_exists( 'eggnews_categories_color' ) ):
	function eggnews_categories_color() {

		$teg_theme_color = esc_attr( get_theme_mod( 'eggnews_theme_color', '' ) );

		$get_categories = get_terms( 'category', array( 'hide_empty' => false ) );

		$cat_color_css = '';
		foreach ( $get_categories as $category ) {

			$cat_color       = esc_attr( get_theme_mod( 'eggnews_category_color_' . strtolower( $category->name ), $teg_theme_color ) );
			$cat_hover_color = esc_attr( eggnews_hover_color( $cat_color, '-50' ) );
			$cat_id          = esc_attr( $category->term_id );

			if ( ! empty( $cat_color ) ) {
				$cat_color_css .= ".category-button.teg-cat-" . $cat_id . " a { background: " . $cat_color . "}\n";

				$cat_color_css .= ".category-button.teg-cat-" . $cat_id . " a:hover { background: " . $cat_hover_color . "}\n";

				$cat_color_css .= ".block-header.teg-cat-" . $cat_id . " { border-left: 2px solid " . $cat_color . " }\n";

				$cat_color_css .= ".rtl .block-header.teg-cat-" . $cat_id . " { border-left: none; border-right: 2px solid " . $cat_color . " }\n";

				$cat_color_css .= ".archive .page-header.teg-cat-" . $cat_id . " { border-left: 4px solid " . $cat_color . " }\n";

				$cat_color_css .= ".rtl.archive .page-header.teg-cat-" . $cat_id . " { border-left: none; border-right: 4px solid " . $cat_color . " }\n";

				$cat_color_css .= "#site-navigation ul li.teg-cat-" . $cat_id . " { border-bottom-color: " . $cat_color . " }\n";
			}
		}

		$teg_dynamic_css = '';

		if ( !empty( $teg_theme_color ) ) {


			$teg_dynamic_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.edit-link .post-edit-link ,.reply .comment-reply-link,.home-icon,.search-main,.header-search-wrapper .search-form-main .search-submit,.teg-slider-section .bx-controls a:hover,.widget_search .search-submit,.error404 .page-title,.archive.archive-classic .entry-title a:after,#teg-scrollup,.widget_tag_cloud .tagcloud a:hover,.sub-toggle,#site-navigation ul > li:hover > .sub-toggle, #site-navigation ul > li.current-menu-item .sub-toggle, #site-navigation ul > li.current-menu-ancestor .sub-toggle{ background:" . $teg_theme_color . "}\n";

			$teg_dynamic_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.widget_tag_cloud .tagcloud a:hover{ border-color:" . $teg_theme_color . "}\n";

			$teg_dynamic_css .= ".comment-list .comment-body ,.header-search-wrapper .search-form-main{ border-top-color:" . $teg_theme_color . "}\n";

			$teg_dynamic_css .= "#site-navigation ul li,.header-search-wrapper .search-form-main:before{ border-bottom-color:" . $teg_theme_color . "}\n";

			$teg_dynamic_css .= ".archive .page-header,.block-header, .widget .widget-title-wrapper, .related-articles-wrapper .widget-title-wrapper{ border-left-color:" . $teg_theme_color . "}\n";

			$teg_dynamic_css .= "a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before, .logged-in-as a,.top-menu ul li a:hover,#footer-navigation ul li a:hover,#site-navigation ul li a:hover,#site-navigation ul li.current-menu-item a,.teg-slider-section .slide-title a:hover,.featured-post-wrapper .featured-title a:hover,.eggnews_block_grid .post-title a:hover,.slider-meta-wrapper span:hover,.slider-meta-wrapper a:hover,.featured-meta-wrapper span:hover,.featured-meta-wrapper a:hover,.post-meta-wrapper > span:hover,.post-meta-wrapper span > a:hover ,.grid-posts-block .post-title a:hover,.list-posts-block .single-post-wrapper .post-content-wrapper .post-title a:hover,.column-posts-block .single-post-wrapper.secondary-post .post-content-wrapper .post-title a:hover,.widget a:hover::before,.widget li:hover::before,.entry-title a:hover,.entry-meta span a:hover,.post-readmore a:hover,.archive-classic .entry-title a:hover,
            .archive-columns .entry-title a:hover,.related-posts-wrapper .post-title a:hover, .widget .widget-title a:hover,.related-articles-wrapper .related-title a:hover { color:" . $teg_theme_color . "}\n";
			$teg_dynamic_css .= "#content .block-header,#content .widget .widget-title-wrapper,#content .related-articles-wrapper .widget-title-wrapper {background-color: " . eggnews_sass_lighten( $teg_theme_color, '20%' ) . ";}\n";
			$teg_dynamic_css .= ".block-header .block-title, .widget .widget-title, .related-articles-wrapper .related-title {background-color: " . $teg_theme_color . ";}\n";
			$teg_dynamic_css .= ".block-header, .widget .widget-title-wrapper, .related-articles-wrapper .widget-title-wrapper {border-left-color: " . $teg_theme_color . ";border-bottom-color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= "#content .block-header .block-title:after, #content .widget .widget-title:after, #content .related-articles-wrapper .related-title:after {border-bottom-color: " . $teg_theme_color . ";border-bottom-color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= ".archive .page-header {background-color: " . eggnews_sass_lighten( $teg_theme_color, '20%' ) . "}\n";
			$teg_dynamic_css .= "#site-navigation ul li.current-menu-item a,.bx-default-pager .bx-pager-item a.active {border-color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= ".bottom-header-wrapper {border-color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= ".top-menu ul li, .eggnews-ticker-wrapper ~ .top-header-section {border-color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= ".ticker-caption {background-color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= ".ticker-content-wrapper .news-post a:hover, .eggnews-carousel .item .carousel-content-wrapper a:hover{color: " . $teg_theme_color . "}\n";
			$teg_dynamic_css .= ".eggnews-carousel .item .carousel-content-wrapper h3 a:hover, body .eggnews-carousel h3 a:hover, footer#colophon .eggnews-carousel h3 a:hover, footer#colophon a:hover{color: " . $teg_theme_color . "}\n";
		}

		?>
		<style type="text/css">
			<?php
				if( !empty( $cat_color_css ) ) {
					echo $cat_color_css;
				}

				if( !empty( $teg_dynamic_css ) ) {
					echo $teg_dynamic_css;
				}
			?>
		</style>
		<?php
	}
endif;
add_action( 'wp_head', 'eggnews_categories_color' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function eggnews_body_classes( $classes ) {

	global $post;
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	/**
	 * option for web site layout
	 */
	$eggnews_website_layout = esc_attr( get_theme_mod( 'site_layout_option', 'fullwidth_layout' ) );

	if ( ! empty( $eggnews_website_layout ) ) {
		$classes[] = $eggnews_website_layout;
	}

	/**
	 * sidebar option for post/page/archive
	 */
	if ( is_single() || is_page() ) {
		$sidebar_meta_option = esc_attr( get_post_meta( $post->ID, 'eggnews_sidebar_location', true ) );
	}

	if ( is_home() ) {
		$set_id              = esc_attr( get_option( 'page_for_posts' ) );
		$sidebar_meta_option = esc_attr( get_post_meta( $set_id, 'eggnews_sidebar_location', true ) );
	}

	if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
		$sidebar_meta_option = 'default_sidebar';
	}
	$eggnews_archive_sidebar      = esc_attr( get_theme_mod( 'eggnews_archive_sidebar', 'right_sidebar' ) );
	$eggnews_post_default_sidebar = esc_attr( get_theme_mod( 'eggnews_default_post_sidebar', 'right_sidebar' ) );
	$eggnews_page_default_sidebar = esc_attr( get_theme_mod( 'eggnews_default_page_sidebar', 'right_sidebar' ) );

	if ( $sidebar_meta_option == 'default_sidebar' ) {
		if ( is_single() ) {
			if ( $eggnews_post_default_sidebar == 'right_sidebar' ) {
				$classes[] = 'right-sidebar';
			} elseif ( $eggnews_post_default_sidebar == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $eggnews_post_default_sidebar == 'no_sidebar' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $eggnews_post_default_sidebar == 'no_sidebar_center' ) {
				$classes[] = 'no-sidebar-center';
			}
		} elseif ( is_page() ) {
			if ( $eggnews_page_default_sidebar == 'right_sidebar' ) {
				$classes[] = 'right-sidebar';
			} elseif ( $eggnews_page_default_sidebar == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $eggnews_page_default_sidebar == 'no_sidebar' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $eggnews_page_default_sidebar == 'no_sidebar_center' ) {
				$classes[] = 'no-sidebar-center';
			}
		} elseif ( $eggnews_archive_sidebar == 'right_sidebar' ) {
			$classes[] = 'right-sidebar';
		} elseif ( $eggnews_archive_sidebar == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $eggnews_archive_sidebar == 'no_sidebar' ) {
			$classes[] = 'no-sidebar';
		} elseif ( $eggnews_archive_sidebar == 'no_sidebar_center' ) {
			$classes[] = 'no-sidebar-center';
		}
	} elseif ( $sidebar_meta_option == 'right_sidebar' ) {
		$classes[] = 'right-sidebar';
	} elseif ( $sidebar_meta_option == 'left_sidebar' ) {
		$classes[] = 'left-sidebar';
	} elseif ( $sidebar_meta_option == 'no_sidebar' ) {
		$classes[] = 'no-sidebar';
	} elseif ( $sidebar_meta_option == 'no_sidebar_center' ) {
		$classes[] = 'no-sidebar-center';
	}

	if ( is_archive() ) {
		$eggnews_archive_layout = get_theme_mod( 'eggnews_archive_layout', 'classic' );
		if ( ! empty( $eggnews_archive_layout ) ) {
			$classes[] = 'archive-' . $eggnews_archive_layout;
		}
	}

	return $classes;
}

add_filter( 'body_class', 'eggnews_body_classes' );
