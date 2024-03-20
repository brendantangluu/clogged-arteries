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


		$args = array(
			'post_type' => 'cla-careers',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order' => 'ASC',
		);

		if (taxonomy_exists('cla-location')) {
			$locations = get_terms(array(
				'taxonomy' => 'cla-location',
				'hide_empty' => false,
			));
			if (!empty($locations)) {
				echo '<div class="filter-tabs">';
				foreach ($locations as $location) {
					echo '<button class="tab" data-location="' . esc_attr($location->slug) . '">' . esc_html($location->name) . '</button>';
				}
				echo '</div>';
			}
		}

		$careers = new WP_Query($args);
		if ($careers->have_posts()) {
			while ($careers->have_posts()) {
				$careers->the_post();

				$location_terms = get_the_terms(get_the_ID(), 'cla-location');
				if ($location_terms && !is_wp_error($location_terms)) {
					$location_slugs = wp_list_pluck($location_terms, 'slug');
					$data_location = esc_attr(implode(' ', $location_slugs));
				} else {
					$data_location = 'no-location';
				}
	?>
				<div class="careers" data-location="<?php echo $data_location; ?>">
					<h2><?php the_title(); ?></h2>
					<p><?php the_field('role_description'); ?></p>
					<a href="https://ca.indeed.com/q-restaurant-jobs.html?vjk=152b9f5a426d28cb" target="_blank" rel="noopener">Click here to Apply</a>
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
