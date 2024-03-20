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
		if (function_exists("get_field")):
			?>
			<section class="hero-section">
				<h1><?php the_field('company_name') ?></h1>
				<p><?php the_field('tagline') ?></p>
				
				<!-- Output the City banner -->

				<?php 
					$args = array(
						'post_type' => 'cla-restaurant',
						'posts_per_page' => -1,
					);
				$query = new WP_Query($args);
				if($query -> have_posts()):
					while($query -> have_posts()):
						$query -> the_post();
						$restaurant_title = sanitize_title(get_the_title());
						if($_SESSION['restaurants'] == $restaurant_title){
							the_post_thumbnail();

						}
					endwhile;
				endif;
				
				
				
				?>

			</section>
	<!-- Exclusive Section START -->
			<?php
			if (isset($_SESSION['restaurants']) && !empty($_SESSION['restaurants'])) :

				// Get all the restaurant posts in the CPT and converting into an array in order to compare the session location with the restaurant post name and see if it matches

				$restaurants = get_posts(array('post_type' => 'cla-restaurant'));
				$restaurant_data = array();

				foreach($restaurants as $restaurant){
					$restaurant_data[] = $restaurant->post_name;
				}

				if(in_array($_SESSION['restaurants'], $restaurant_data)){
					echo "<section class='location-exclusives'>";
						$menu_category_slug = 'exclusive'; 	
						$taxonomy = 'cla-menu-categories';
						$post_type = 'cla-menu';
						$terms = get_terms(array(
							'taxonomy'      => $taxonomy,
							'slug'          => $menu_category_slug,
						));
						if($terms && ! is_wp_error($terms)){
							foreach($terms as $term){
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

								if($query -> have_posts()){
									while ($query->have_posts()) {
										$query->the_post();
										$exclusives = get_field('food_image');
										?>
										<article>
											<!-- Image output code referenced from ACF Docs - https://www.advancedcustomfields.com/resources/image/ -->
											<?php
												if( !empty( $exclusives ) ): ?>
													<img src="<?php echo esc_url($exclusives['url']); ?>" alt="<?php echo esc_attr($exclusives['alt']); ?>" />
											<?php endif; ?>
												<h2><?php the_title(); ?></h2>
												<p><?php the_field('food_description') ?></p>
												<aside><?php the_field('food_price')?></aside>
										</article> 
										<?php

									}
									wp_reset_postdata(); // Reset the post data    
								}
							}
						}
					echo "</section>";
					?>
					<?php
				}
			endif;
		endif;
		?>
	<!-- Exclusive Section END -->
		<section class="instagram-gallery">
			<article>
				 <?php echo do_shortcode('[instagram-feed feed=1]'); ?> 
			</article>
			<article class="slider">

			</article>	
		</section>
		<section class="about-us">
			<article>
				<?php 
					while ( have_posts() ) :
						the_post();
						$about = get_field('original_restaurant');
						
						if(function_exists("get_field")):
							if(get_field('header') AND get_field('company_description') OR get_field('original_restaurant')):
								?>
									<h2><?php the_field('header') ?></h2>
									<p><?php the_field('company_description') ?></p>
									
									<!-- Image output code referenced from ACF Docs - https://www.advancedcustomfields.com/resources/image/ -->
									
									<?php
										if( !empty( $about ) ): ?>
											<img src="<?php echo esc_url($about['url']); ?>" alt="<?php echo esc_attr($about['alt']); ?>" />
									<?php endif; ?>
								<?php
							endif;
						endif;
					endwhile; // End of the loop.
					?>		
			</article>
		</section>
		<section class="restaurant-info">
			<?php 
			if (isset($_SESSION['restaurants']) && !empty($_SESSION['restaurants'])) :
				$restaurants = get_posts(array('post_type' => 'cla-restaurant'));
				$restaurant_data = array();

				foreach($restaurants as $restaurant){
					$restaurant_data[] = $restaurant->post_name;
					
				}

				if(in_array($_SESSION['restaurants'], $restaurant_data)):
						$post_type = 'cla-restaurant';
						if($terms && ! is_wp_error($terms)):
							foreach($terms as $term){
								$args = array(
									'post_type'      => $post_type,
									'posts_per_page' => -1,
									'orderby'        => 'title',
									'order'          => 'ASC',
								);
								$query = new WP_Query($args);

								if($query -> have_posts()):
									echo "<article>";
										while ($query->have_posts()) :
											$query->the_post();
											$restaurant_title = sanitize_title(get_the_title());
											?>
											<?php
											if($_SESSION['restaurants'] == $restaurant_title):
												if(function_exists('get_field')){
													if(get_field('restaurant_header') AND get_field('origins')){
														?>
															<h2><?php the_title(); ?></h2>
															<h3><?php the_field('restaurant_header') ?></h3>
															<p><?php the_field('origins') ?></p>
														<?php
													}
												}
											endif; 
										endwhile;
									echo "</article>";
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
	</main><!-- #main -->

<?php
get_footer();
?>
