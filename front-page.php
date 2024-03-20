<?php
session_start();
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
		endwhile;
		?>
	<?php
	?>

</main><!-- #main -->

<?php
