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
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// a loop outputting all the job listings that are created in the backend (Careers CPT Items)
		$args = array(
			'post_type' => 'cla-careers',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order' => 'ASC',
		);
		$careers = new WP_Query($args);
		if ($careers->have_posts()) {
			while ($careers->have_posts()) {
				$careers->the_post();
	?>
				<div class="careers">
					<h2><?php the_title(); ?></h2>
					<p><?php the_field('role_description'); ?></p>
				</div>
	<?php
			}
		} else {
			echo 'No Careers Found';
		}
		wp_reset_postdata();


	endwhile; // End of the loop.
	?>

</main>

<?php
get_footer();
