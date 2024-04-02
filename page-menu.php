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
<div class="menu-bg-container">
	<div class="menu-bg-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
	</div>
</div>
<div class="menu-page-wrapper">
	<?php
	$args = array(
		'post_type' 		=> 'cla-menu',
		'posts_per_page'	=> -1,
		'order'				=> 'ASC',
		'orderby'			=> 'title'
	);

	if (taxonomy_exists('cla-menu-categories')) :
		$items = get_terms(array(
			'taxonomy'		=> 'cla-menu-categories',
			'order'			=> 'ASC',
			'orderby'		=> 'ID'
		));
		if (!empty($items)) :
			echo '<section class="menu-filter-aside">';
			foreach ($items as $item) :
				echo '<button id="menu-button" class="tab food-filter" data-term="' . esc_attr($item->slug) . '">' . esc_html($item->name) . '</button>';
			endforeach;
			echo '</section>';
		endif;
	endif;

	echo '<section class="menu-items-full">';
	$query = new WP_Query($args);
	if ($query->have_posts()) :
		while ($query->have_posts()) :
			$query->the_post();

			$menu_terms = get_the_terms(get_the_ID(), 'cla-menu-categories');
			if ($menu_terms && !is_wp_error($menu_terms)) {
				$menu_slugs = wp_list_pluck($menu_terms, 'slug');
				$data_menu_category = esc_attr(implode(' ', $menu_slugs));
			} else {
				$data_menu_category = 'no-menu';
			}

			echo '<article class="cla-menu tab-class" data-term="' . $data_menu_category . '">';
			if (isset($_SESSION['restaurants'])) :
				$location = ucwords(str_replace('-', ' ', $_SESSION['restaurants']));
				if (has_term('exclusive', 'cla-menu-categories') && strpos(get_the_title(), $location) === 0) {
					if (function_exists('get_field')) :

						$food_image = get_field('food_image');
						if ($food_image) :
							echo wp_get_attachment_image($food_image, 'large');
						endif;

						echo '<div class="food-info-wrapper">';
							echo '<div class="food-title-price">';
								echo '<h2>' . get_the_title() . '</h2>';
								if (get_field('food_price')) :
									echo '<p>' . get_field('food_price') . '</p>';
								endif;
							echo '</div>';

							if (get_field('food_description')) :
								echo '<p>' . get_field('food_description') . '</p>';
							endif;

							$food_sizes = get_field('food_size');

							if ($food_sizes) :
								if ($food_sizes['size_small'] && $food_sizes['size_medium'] && $food_sizes['size_large']) :
									echo '<p class="size-price">S: '. $food_sizes['size_small'] .' | M: '. $food_sizes['size_medium'] .' | L: '. $food_sizes['size_large'] .'</p>';
								endif;
							endif;
						echo '</div>';

					endif;
				} else if (!has_term('exclusive', 'cla-menu-categories')) {
					if (function_exists('get_field')) :

						$food_image = get_field('food_image');
						if ($food_image) :
							echo wp_get_attachment_image($food_image, 'large');
						endif;

						echo '<div class="food-info-wrapper">';
							echo '<div class="food-title-price">';
								echo '<h2>' . get_the_title() . '</h2>';
								if (get_field('food_price')) :
									echo '<p>' . get_field('food_price') . '</p>';
								endif;
							echo '</div>';

							if (get_field('food_description')) :
								echo '<p>' . get_field('food_description') . '</p>';
							endif;

							$food_sizes = get_field('food_size');

							if ($food_sizes) :
								if ($food_sizes['size_small'] && $food_sizes['size_medium'] && $food_sizes['size_large']) :
									echo '<p class="size-price">S: '. $food_sizes['size_small'] .' | M: '. $food_sizes['size_medium'] .' | L: '. $food_sizes['size_large'] .'</p>';
								endif;
							endif;
						echo '</div>';

					endif;
				}
			endif;
			echo '</article>';
		endwhile;
		wp_reset_postdata();
	endif;
	echo '</section>';
	?>
</div>
</main><!-- #main -->

<?php
get_footer();
