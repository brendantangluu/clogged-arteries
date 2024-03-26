<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Clogged_Arteries
 */
get_header();
?>


<main id="primary" class="site-main">
	<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div class="bg-container">
				<div class="bg-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
				</div>
			</div>
			<section class="splash-form">
				<article class="logo">
					<?php
					if (function_exists('get_field')) :
						if (get_field('logo')) : ?>
							<div class="logo-container">
								<img class="splash-logo" src="<?php the_field('logo') ?>" alt="This is the Clogged Arteries Logo">
							</div>
						<?php 
						endif;
						?>
				</article>
				<article class="splash-location-selector">
						<?php
							if(get_field('prompt')):
								?>
								<h2><?php the_field('prompt') ?></h2>
								<?php
							endif;
					endif; 
					?>
					<form class="location-splash" action="<?php echo get_permalink('86')?>" method="get">
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
									<input type="radio" name="restaurants" value="<?php echo $post_slug?>" id="<?php echo $post_slug?>">
									<label id="location-label" class="city-label" for="<?php echo $post_slug?>"><?php the_title()?></label>
								</fieldset>
						<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
						<input class="location-submit" type="submit" value="Enter">
					</form>
				</article>
			</section>
			<?php
		endwhile;
		?>
	<?php
	?>

</main><!-- #main -->

<?php
get_footer();
