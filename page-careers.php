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

<main id="primary" class="site-main page-careers">
	<?php
	while (have_posts()) :
		the_post();
	?>
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
		?>
			<div class="article-wrapper">
				<?php
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
					<article class="tab-class" data-term="<?php echo $data_location; ?>">
						<?php
						if (function_exists('get_field')) {
							if (get_field('role_description') and get_field('role_url')) {
						?>
								<?php if (get_field('headshot')) {
									$headshot = get_field('headshot');
									$size = 'thumbnail';
									$thumb = $headshot['sizes'][$size];
									$width = $headshot['sizes'][$size . '-width'];
									$height = $headshot['sizes'][$size . '-height'];
								} ?>
								<?php if ($thumb) { ?>
									<img src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $headshot['alt']; ?>" />
								<?php } ?>
								<div class="right">
									<p class="description"><?php the_field('role_description'); ?></p>
									<div class="interactions">
										<p class="status">Position: Open</p>
										<a href="<?php the_field('role_url') ?>" target="_blank" rel="noopener">Click here to Apply</a>
									</div>
								</div>
						<?php
							}
						}
						?>
					</article>
		<?php
				}
			} else {
				echo 'No Careers Found';
			}
			wp_reset_postdata();
		endwhile; // End of the loop.
		?>
			</div>
</main>

<?php
get_footer();
