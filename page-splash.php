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
			if(function_exists('get_field')):
				if (get_field('logo') OR get_field('prompt')):
					?> <img class = "splash-logo" src="<?php the_field('logo')?>" alt="This is the Clogged Arteries Logo">
						<p><?php the_field('prompt') ?></p>
					<?php

				endif;
			endif;
			?>
				<form action="<?php echo get_permalink('86')?>">
					<?php
						$args = array(
							'post_type'			=> 'cla-restaurant',
							'posts_per_page' 	=> -1,
							'order'				=> 'DESC',
							'orderby'			=> 'title'
						);
							$query = new WP_Query($args);
							if($query -> have_posts()) :
								while($query -> have_posts()) :
									$query -> the_post();					
									?>
									<fieldset>
										<?php 
											global $post;
											$post_slug = $post -> post_name;
										?>
										<input type="radio" name="restaurants" value = "<?php echo $post_slug ?>" id="<?php the_title()?>" checked="checked">
										<label for="<?php the_title()?>"><?php the_title() ?></label>
									</fieldset>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
					?>
					<input type="submit" value = "Submit">
				</form>
			<?php
		?>

	</main><!-- #main -->

<?php
get_footer();
