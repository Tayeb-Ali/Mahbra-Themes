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
		<div class="single-post-image">
			<figure><?php the_post_thumbnail( 'eggnews-single-large' ); ?></figure>
		</div><!-- .single-post-image -->
	<?php } ?>
	<header class="entry-header">
		<?php do_action( 'eggnews_post_categories' ); ?>
		<h1 class="entry-title"><?php the_title();?></h1>
		<div class="entry-meta">
			<?php eggnews_posted_on(); ?>
			<?php eggnews_post_comment(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'eggnews' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eggnews' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php eggnews_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
