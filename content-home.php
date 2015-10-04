<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */
?>

<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('block'); ?> <?php if ($url) : ?>style="background-image: url('<?php echo $url; ?>')" <?php endif; ?>>
	<a href="<?php the_permalink(); ?>" class="block-overlay">	
		<div class="block-content">
			<?php the_title( '<h1>', '</h1>' ); ?>
			<?php echo excerpt(20); ?>
		</div><!-- .block-content -->
	</a>
</article><!-- #post-## -->

