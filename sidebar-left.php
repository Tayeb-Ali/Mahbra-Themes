<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'eggnews_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'eggnews_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'eggnews_left_sidebar' ); ?>
	<?php do_action( 'eggnews_after_sidebar' ); ?>
</aside><!-- #secondary -->
