<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */


get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="content-wrapper">	
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php _e( 'Nothing was found at this location.' ); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div>
</main><!-- .site-main -->


<?php get_footer(); ?>
 