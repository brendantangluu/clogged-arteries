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
	<section class="hero-section">
		<?php
		if (function_exists("get_field") and isset($_SESSION['restaurants'])) :
			if (get_field("company_name") or get_field("tagline")) :
		?>
				<h1><?php the_field('company_name') ?></h1>
				<p><?php the_field('tagline') ?></p>
				<!-- Output the City banner -->
		<?php
				$args = array(
					'post_type' => 'cla-restaurant',
					'posts_per_page' => -1,
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) :
					while ($query->have_posts()) :
						$query->the_post();
						$restaurant_title = sanitize_title(get_the_title());
						if ($_SESSION['restaurants'] == $restaurant_title) {
							the_post_thumbnail();
						}
					endwhile;
					wp_reset_postdata();
				endif;
			endif;
		endif;
		?>
	</section>
	<section class="exclusive-items">
		<?php
		if (isset($_SESSION['restaurants']) && !empty($_SESSION['restaurants'])) :
			$restaurants = get_posts(array('post_type' => 'cla-restaurant'));
			$restaurant_data = array();
			foreach ($restaurants as $restaurant) {
				$restaurant_data[] = $restaurant->post_name;
			}
			if (in_array($_SESSION['restaurants'], $restaurant_data)) :
				$menu_category_slug = 'exclusive';
				$taxonomy = 'cla-menu-categories';
				$post_type = 'cla-menu';
				$terms = get_terms(array(
					'taxonomy'      => $taxonomy,
					'slug'          => $menu_category_slug,
				));
				if ($terms && !is_wp_error($terms)) :
					foreach ($terms as $term) {
						$args = array(
							'post_type'      => $post_type,
							'posts_per_page' => -1,
							'orderby'        => 'title',
							'order'          => 'ASC',
							'tax_query'      => array(
								'relation' => 'AND',
								array(
									'taxonomy' => $taxonomy,
									'field'    => 'slug',
									'terms'    => $term->slug,
								),
								array(
									'taxonomy' => 'cla-location',
									'field'    => 'slug',
									'terms'    => $_SESSION['restaurants'],
								),
							)
						);
						$query = new WP_Query($args);
						if ($query->have_posts()) :
							while ($query->have_posts()) {
								$query->the_post();
								if (function_exists('get_field')) {
									if (get_field('food_image')) {
										$exclusives = get_field('food_image');
									}
								}
		?>
								<article>
									<!-- Image output code referenced from ACF Docs - https://www.advancedcustomfields.com/resources/image/ -->
									<?php
									if (!empty($exclusives)) :
										echo wp_get_attachment_image($exclusives, 'large');
									endif; ?>
									<h2><?php the_title(); ?></h2>
									<?php
									if (function_exists('get_field')) :
										if (get_field('food_description') and get_field('food_price')) :
									?>
											<p><?php the_field('food_description') ?></p>
											<p><?php the_field('food_price') ?></p>
									<?php
										endif;
									endif;
									?>
								</article>
				<?php
							}
							wp_reset_postdata(); // Reset the post data    
						endif;
					}
				endif;

				?>
		<?php
			endif;
		endif;
		?>
	</section>
	<section class="instagram-gallery">
		<?php echo do_shortcode('[instagram-feed feed=1]'); ?>
	</section>
	<section class="testimonial">
		<article>
		</article>
	</section>
	<section class="about-us">
		<?php
		while (have_posts()) :
			the_post();
			$about = get_field('original_restaurant');

			if (function_exists("get_field")) :
				if (get_field('header') and get_field('company_description') or get_field('original_restaurant')) :
		?>
					<?php
					if (!empty($about)) :
						echo wp_get_attachment_image($about, 'large');
					endif;
					?>
					<div class="right">
						<h2><?php the_field('header') ?></h2>
						<p><?php the_field('company_description') ?></p>
					</div>
		<?php
				endif;
			endif;
		endwhile;
		?>
	</section>
	<div class="restaurant-wrapper">
		<section class="restaurant-info">
			<?php
			if (isset($_SESSION['restaurants']) && !empty($_SESSION['restaurants'])) :
				$restaurants = get_posts(array('post_type' => 'cla-restaurant'));
				$restaurant_data = array();

				foreach ($restaurants as $restaurant) {
					$restaurant_data[] = $restaurant->post_name;
				}

				if (in_array($_SESSION['restaurants'], $restaurant_data)) :
					$post_type = 'cla-restaurant';
					if ($terms && !is_wp_error($terms)) :
						foreach ($terms as $term) {
							$args = array(
								'post_type'      => $post_type,
								'posts_per_page' => -1,
								'orderby'        => 'title',
								'order'          => 'ASC',
							);
							$query = new WP_Query($args);

							if ($query->have_posts()) :
								while ($query->have_posts()) :
									$query->the_post();
									$restaurant_title = sanitize_title(get_the_title());
			?>
									<?php
									if ($_SESSION['restaurants'] == $restaurant_title) :
										if (function_exists('get_field')) {
											$restaurant_image = get_field('restaurant_image');	
									?>
											<h2><?php the_title() ?></h2>
											<p><?php the_field('restaurant_header') ?></p>
											<p><?php the_field('origins') ?></p>
											<?php
											echo wp_get_attachment_image($restaurant_image, 'large');
											?>

								<?php

										}
									endif;
								endwhile;
								?>
					<?php
								wp_reset_postdata(); // Reset the post data    
							endif;
						}
					endif;
					?>
			<?php
				endif;
			endif;
			?>
		</section>
	</div>
</main><!-- #main -->

<?php
get_footer();
