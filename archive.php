<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */

get_header(); ?>


<main id="main" class="site-main" role="main">
	<div class="content-wrapper">

		<?php 
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$wp_query = new WP_Query( 
			array(
				'posts_per_page' => 10,
				'paged' => $paged
			)
		 ); ?>


		<?php if ( $wp_query->have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ($wp_query->have_posts()) : $wp_query->the_post();

				get_template_part( 'content', 'archive' );

			// End the loop.
			endwhile;


		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		<?php numeric_posts_nav(); ?>
	</div>
</main><!-- .site-main -->


<?php get_footer(); ?>
