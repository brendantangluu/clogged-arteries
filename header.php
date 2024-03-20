<?php

if(isset($_GET['restaurants'])):
	$_SESSION['restaurants'] = $_GET['restaurants'];
endif;

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clogged_Arteries
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'clogged-arteries' ); ?></a>
	<header id="masthead" class="site-header">
		<!-- If the user hasn't selected a location, pop up a prompt and select a location -->
		<?php
			if(!isset($_SESSION['restaurants'])) :
				if (function_exists('get_field')) :
						if (get_field('logo') || get_field('prompt')) : ?>
							<img class="splash-logo" src="<?php the_field('logo') ?>" alt="This is the Clogged Arteries Logo">
							<h2><?php the_field('prompt') ?></h2>
					<?php endif;
					endif; ?>
				
					<form action="<?php echo get_permalink('86') ?>" method="get">
						<?php
						$args = array(
							'post_type'         => 'cla-restaurant',
							'posts_per_page'    => -1,
							'order'             => 'DESC',
							'orderby'           => 'title'
						);
				
						$query = new WP_Query($args);
						if ($query->have_posts()) :
							while ($query->have_posts()) :
								$query->the_post();
								$post_slug = $post->post_name;
						?>
								<fieldset>
									<input type="radio" name="restaurants" value="<?php echo $post_slug ?>" id="<?php the_title() ?>">
									<label for="<?php the_title() ?>"><?php the_title() ?></label>
								</fieldset>
						<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
						<input type="submit" value="Submit">
					</form>
				<?php
			endif;
		?>
		<!-- Location Switcher -->
		<?php 
		if($_SESSION['restaurants']):
			$location = ucwords(str_replace('-', ' ', $_SESSION['restaurants']));
			?>
			<h2>My Location: <?php echo $location ?></h2>
			<button id = "switch-location-btn">Switch Location</button>
			<form id = 'location-switch-form' class = 'location-switch' action="<?php echo get_permalink('86')?>" method="get">
				<?php
				$args = array(
					'post_type'         => 'cla-restaurant',
					'posts_per_page'    => -1,
					'order'             => 'DESC',
					'orderby'           => 'title'
				);

				$query = new WP_Query($args);
				if ($query->have_posts()) :
					while ($query->have_posts()) :
						$query->the_post();
						$post_slug = $post->post_name;
						?>
						<fieldset>
							<input type="radio" name="restaurants" value="<?php echo $post_slug ?>" id="<?php the_title() ?>">
							<label for="<?php the_title() ?>"><?php the_title() ?></label>
						</fieldset>
					<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
				<input type="submit" value="Submit">
			</form>
			<?php
		endif;
		?>
		<div class="site-branding">
			<a href="<?php get_permalink('86')?>">
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
			</a>
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/home' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			endif;
			$clogged_arteries_description = get_bloginfo( 'description', 'display' );
			if ( $clogged_arteries_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $clogged_arteries_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'clogged-arteries' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
