<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage New Theme
 * @since New Theme v1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php get_template_part( 'header' , 'meta' ); ?>
	<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>

<div id="push-container" class="push-container">

<?php if ( has_nav_menu('primary') ): ?>
<nav class="primary">
	<h2 class="visuallyhidden">Primary Navigation</h2>
	<?php wp_nav_menu(array(
		'theme_location' => 'primary',
		'container' => false
	)); ?>
</nav>
<?php endif; ?>


<div id="page" class="hfeed site menu-push">
	<a class="skip-link visuallyhidden" href="#content"><?php _e( 'Skip to content' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
			<div class="utility">
				<?php if ( has_nav_menu('utility') ): ?>
			        <nav class="utility">
						<h2 class="visuallyhidden">Utility Navigation</h2>
						<?php wp_nav_menu(array(
							'theme_location' => 'utility',
							'container' => false
						)); ?>
			    	</nav>
				<?php endif; ?>
			</div>
			
			<div class="site-branding">
				<?php 
				// Site Settings
			    $theme_dir 	= get_template_directory();
			    $images_dir = $theme_dir . '/img/';?>

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						</a>
				
			</div>

			<a href="#menu" class="menu-toggle">Menu</a>

			
		</div>
	</header>

	<div id="content" class="container">
