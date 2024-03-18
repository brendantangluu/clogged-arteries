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
			echo "<section>";
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
								<?php
									$id = get_the_id();
								?>
									<a href="#<?php echo $id ?>">
										<?php the_title() ?>
									</a>
							<?php
						endwhile;
						wp_reset_postdata();
					endif;
			echo "</section>";
		?>

	</main><!-- #main -->

<?php
get_footer();
