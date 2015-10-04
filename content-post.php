<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php // if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
	<header class="entry-header">
		<span class="date"><?php the_date('F j, Y'); ?></span>
		<h1 class="entry-title"><?php the_title(); ?></h1>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail();
			} 
		?>
		<?php the_content(); ?>
	</div><!-- .entry-content -->


	<footer class="entry-footer">
		<?php 
		$args = array (
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'title_li'           => __( '<h4>Posted In</h4>' ),
			'hide_empty'         => 1
			);
		wp_list_categories( $args ); 
		?> 
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
