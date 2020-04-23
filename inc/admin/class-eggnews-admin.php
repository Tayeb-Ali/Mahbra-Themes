<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'EggNews_Admin' ) ) :

	/**
	 * EggNews_Admin Class.
	 */
	class EggNews_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
			add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		}

		/**
		 * Add admin menu.
		 */
		public function admin_menu() {
			$theme = wp_get_theme( get_template() );

			$page = add_theme_page( esc_html__( 'ووردبريس العرب', 'eggnews' ) . ' ' , esc_html__( 'ووردبريس العرب', 'eggnews' ) . ' ' , 'activate_plugins', 'eggnews-welcome', array(
				$this,
				'welcome_screen'
			) );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function enqueue_styles() {
			global $eggnews_version;

			wp_enqueue_style( 'eggnews-welcome-admin', get_template_directory_uri() . '/inc/admin/css/welcome-admin.css', array(), $eggnews_version );
		}

		/**
		 * Add admin notice.
		 */
		public function admin_notice() {
			global $eggnews_version, $pagenow;
			wp_enqueue_style( 'eggnews-message', get_template_directory_uri() . '/inc/admin/css/admin-notices.css', array(), $eggnews_version );

			// Let's bail on theme activation.
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
				update_option( 'eggnews_admin_notice_welcome', 1 );

				// No option? Let run the notice wizard again..
			} elseif ( ! get_option( 'eggnews_admin_notice_welcome' ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			}
		}

		/**
		 * Hide a notice if the GET variable is set.
		 */
		public static function hide_notices() {
			if ( isset( $_GET['eggnews-hide-notice'] ) && isset( $_GET['_eggnews_notice_nonce'] ) ) {
				if ( ! wp_verify_nonce( wp_unslash($_GET['_eggnews_notice_nonce']), 'eggnews_hide_notices_nonce' ) ) {
					wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'eggnews' ) );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( esc_html__( 'Cheatin&#8217; huh?', 'eggnews' ) );
				}

				$hide_notice = sanitize_text_field( wp_unslash($_GET['eggnews-hide-notice']) );
				update_option( 'eggnews_admin_notice_' . $hide_notice, 1 );
			}
		}

		/**
		 * Show welcome notice.
		 */
		public function welcome_notice() {
			?>
			<div id="message" class="updated eggnews-message">
				<a class="eggnews-message-close notice-dismiss"
				   href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'eggnews-hide-notice', 'welcome' ) ), 'eggnews_hide_notices_nonce', '_eggnews_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'eggnews' ); ?></a>
				<p><?php
					/* translators: 1: anchor tag start, 2: anchor tag end*/
					printf( esc_html__( 'تم تطوير وتعريب هذا القالب بدعم من ووردبريس العرب ، ونحن سعداء بتحميلك لنسخة القالب العربية ، ونأمل أن تستفيد منه كل الفائدة . لمزيد من القوالب والإضافات والشروحات الحصرية ، بامكانكم زيارة موقع ووردبريس العرب', 'eggnews' ), '<a href="' . esc_url( admin_url( 'themes.php?page=eggnews-welcome' ) ) . '">', '</a>' );
					?></p>
				<p class="submit">
					<a class="button-secondary"
					   href="<?php echo esc_url( admin_url( 'themes.php?page=eggnews-welcome' ) ); ?>"><?php esc_html_e( 'انطلق مع ووردبريس العرب', 'eggnews' ); ?></a>
				</p>
			</div>
			<?php
		}

		/**
		 * Intro text/links shown to all about pages.
		 *
		 * @access private
		 */
		private function intro() {
			global $eggnews_version;
			$theme = wp_get_theme( get_template() );

			// Drop minor version if 0
			$major_version = substr( $eggnews_version, 0, 3 );
			?>
			<div class="eggnews-theme-info">
				<h1>
					<?php esc_html_e( 'About', 'eggnews' ); ?>
					<?php echo esc_html($theme->display( 'Name' )); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

				<div class="welcome-description-wrap">
					<div class="about-text"><?php echo esc_html($theme->display( 'Description' )); ?></div>

					<div class="eggnews-screenshot">
						<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>"/>
					</div>
				</div>
			</div>

			<p class="eggnews-actions">
				<a href="<?php echo esc_url( 'https://wp-ar.net' ); ?>"
				   class="button button-secondary" target="_blank"><?php esc_html_e( 'ووردبريس العرب', 'eggnews' ); ?></a>

			</p>


			<?php
		}

		/**
		 * Welcome screen page.
		 */
		public function welcome_screen() {
			$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( wp_unslash($_GET['tab']));

			// Look for a {$current_tab}_screen method.
			if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
				return $this->{$current_tab . '_screen'}();
			}

			// Fallback to about screen.
			return $this->about_screen();
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			$theme = wp_get_theme( get_template() );
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>



			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function changelog_screen() {
			global $wp_filesystem;

			?>

			<?php
		}

		/**
		 * Parse changelog from readme file.
		 *
		 * @param  string $content
		 *
		 * @return string
		 */
		private function parse_changelog( $content ) {
			$matches   = null;
			$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
			$changelog = '';

			if ( preg_match( $regexp, $content, $matches ) ) {
				$changes = explode( '\r\n', trim( $matches[1] ) );

				$changelog .= '<pre class="changelog">';

				foreach ( $changes as $index => $line ) {
					$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
				}

				$changelog .= '</pre>';
			}

			return wp_kses_post( $changelog );
		}


		/**
		 * Output the supported plugins screen.
		 */
		public function supported_plugins_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'eggnews' ); ?></p>
				<ol>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Social Icons', 'eggnews' ); ?></a>
						<?php esc_html_e( ' by ThemeEgg', 'eggnews' ); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'eggnews' ); ?></a>
						<?php esc_html_e( ' by ThemeEgg', 'eggnews' ); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Contact Form 7', 'eggnews' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/wp-pagenavi/' ); ?>"
					       target="_blank"><?php esc_html_e( 'WP-PageNavi', 'eggnews' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>"
					       target="_blank"><?php esc_html_e( 'WooCommerce', 'eggnews' ); ?></a></li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/polylang/' ); ?>"
						   target="_blank"><?php esc_html_e( 'Polylang', 'eggnews' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'eggnews' ); ?>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wpml.org/' ); ?>"
						   target="_blank"><?php esc_html_e( 'WPML', 'eggnews' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'eggnews' ); ?>
					</li>
				</ol>

			</div>
			<?php
		}

		/**
		 * Output the free vs pro screen.
		 */
		public function free_vs_pro_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'eggnews' ); ?></p>

				<table>
					<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'eggnews' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'EggNews', 'eggnews' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'EggNews Pro', 'eggnews' ); ?></h3></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Support', 'eggnews' ); ?></h3></td>
						<td><?php esc_html_e( 'Forum', 'eggnews' ); ?></td>
						<td><?php esc_html_e( 'Forum + Emails/Support Ticket', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Color Options', 'eggnews' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'eggnews' ); ?></td>
						<td><?php esc_html_e( '22', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Primary color option', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Font Size Options', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Google Fonts Options', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '600+', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom Widgets', 'eggnews' ); ?></h3></td>
						<td><?php esc_html_e( '7', 'eggnews' ); ?></td>
						<td><?php esc_html_e( '16', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Social Icons', 'eggnews' ); ?></h3></td>
						<td><?php esc_html_e( '6', 'eggnews' ); ?></td>
						<td><?php esc_html_e( '18 + 6 Custom', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Social Sharing', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom Menu', 'eggnews' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'eggnews' ); ?></td>
						<td><?php esc_html_e( '2', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Footer Sidebar', 'eggnews' ); ?></h3></td>
						<td><?php esc_html_e( '4', 'eggnews' ); ?></td>
						<td><?php esc_html_e( '7', 'eggnews' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Site Layout Option', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Options in Breaking News', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Unique Post System', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Change Read More Text', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Related Posts', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Author Biography', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Author Biography with Social Icons', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Footer Copyright Editor', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: 125x125 Advertisement', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: 300x250 Advertisement', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: 728x90 Advertisement', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Category Slider', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Highlighted Posts', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Random Posts Widget', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Tabbed Widget', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Videos', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 1)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 2)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 3)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 4)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 5)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 6)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts (Style 7)', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Category Color Options', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'WPML Compatible', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Polylang Compatible', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'WooCommerce Compatible', 'eggnews' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'eggnews_pro_theme_url', 'http://themeegg.com/themes/eggnews-pro/' ) ); ?>"
							   class="button button-secondary docs"
							   target="_blank"><?php esc_html_e( 'View Pro', 'eggnews' ); ?></a>
						</td>
					</tr>
					</tbody>
				</table>

			</div>
			<?php
		}
	}

endif;

return new EggNews_Admin();
