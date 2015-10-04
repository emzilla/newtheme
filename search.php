<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="content-wrapper">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				//Run the loop for the search to output the results.
				get_template_part( 'content', 'search' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page' ),
				'next_text'          => __( 'Next page' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>
</main><!-- .site-main -->

<?php get_footer(); ?>
