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
		$args = array(
			'post_type'			=> 'cla-menu',
			'posts_per_page'	=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'title'
		);
		$query = new WP_Query( $args );
		if ( $query -> have_posts() ):
			while ( $query -> have_posts() ):
				$query -> the_post();
				echo '<article>';
				echo '<h2>' . get_the_title() . '</h2>';
				$food_image = get_field('food_image');
				if ($food_image):
					echo '<img src="'. esc_url($food_image['url']) .'" alt="'. esc_attr(get_the_title()) .'">';
				endif;
				if ( function_exists( 'get_field' ) ):
					if ( get_field( 'food_description' ) ):
						echo '<p>'. get_field('food_description') .'</p>';
					endif;
				endif;
				echo '</article>';
			endwhile;
			wp_reset_postdata();
		endif;

		?>	

	</main><!-- #main -->

<?php
get_footer();
