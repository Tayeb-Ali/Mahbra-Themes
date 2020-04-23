<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ) { ?>
			<div class="post-image">
				<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
					<figure><?php the_post_thumbnail( 'eggnews-single-large' ); ?></figure>
				</a>
			</div>
	<?php } ?>

	<div class="archive-desc-wrapper clearfix">
		<header class="entry-header">
			<?php
				do_action( 'eggnews_post_categories' );
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
					 $content = get_the_content(); echo mb_strimwidth($content, 0, 500, '...');
					 ?>
<a href="<?php the_permalink();?>">قرأءة المزيد</a>

<?php
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					 $content = get_the_content(); echo mb_strimwidth($content, 0, 500, '...');
					 ?>
				<a href="<?php the_permalink();?>">قرأءة المزيد</a>

				    <?php

				}
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php eggnews_posted_on(); ?>
				<?php eggnews_post_comment(); ?>
			</div><!-- .entry-meta -->
			<?php eggnews_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .archive-desc-wrapper -->
</article><!-- #post-## -->
