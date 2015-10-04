<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="content-wrapper">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

		// End the loop.
		endwhile;
		?>
	</div>
</main><!-- .site-main -->


<?php get_footer(); ?>
