<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */
?>

	</div><!-- .container -->

	<footer id="footer" class="site-footer" role="contentinfo">

		<div class="wrapper">

			<div class="site-info">
				<p class="small">Copyright &copy; <?php the_date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</p>
			</div><!-- .site-info -->
			
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav id="social" class="social" role="navigation">
					<?php
						// Social links navigation menu.
						wp_nav_menu( array(
							'theme_location' => 'social',
							'depth'          => 1
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>
			
		</div>

	</footer><!-- .site-footer -->


</div><!-- .site -->

</div><!-- .push-container -->
<?php wp_footer(); ?>

</body>
</html>
