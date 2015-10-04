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
		<?php $date = get_the_date('F j, Y'); ?>
		<span class="date"><?php echo $date ?></span>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php echo excerpt(100); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
