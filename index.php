<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */

get_header(); ?>

		<main id="main" class="site-main" role="main">
			<div class="wrapper home-content">
				<?php 
				$wp_query = new WP_Query( 
					array(
						'posts_per_page' => 9
					)
				 ); ?>

				<?php if ( $wp_query->have_posts() ) : ?>

				<?php
				// Start the loop.
				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					get_template_part( 'content', 'home' );

				// End the loop.
				endwhile;

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );

				endif; ?>	
			</div>

		</main><!-- .site-main -->

<?php get_footer(); ?>
