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
	?>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</header>

		<?php clogged_arteries_post_thumbnail(); ?>

		<?php
		$args = array(
			'post_type' => 'cla-careers',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order' => 'ASC',
		);

		if (taxonomy_exists('cla-location')) {
			$items = get_terms(array(
				'taxonomy' => 'cla-location',
				'hide_empty' => false,
			));
			if (!empty($items)) {
				echo '<div class="filter-tabs">';
				foreach ($items as $item) {
					echo '<button class="tab" data-term="' . esc_attr($item->slug) . '">' . esc_html($item->name) . '</button>';
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

				<article class="tab-class careers" data-term="<?php echo $data_location; ?>">
					<h2><?php the_title(); ?></h2>
					<p><?php the_field('role_description'); ?></p>
					<a href="https://ca.indeed.com/q-restaurant-jobs.html?vjk=152b9f5a426d28cb" target="_blank" rel="noopener">Click here to Apply</a>
				</article>
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
