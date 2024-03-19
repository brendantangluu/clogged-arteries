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
        <h1><?php the_field('company_name') ?></h1>
        <p><?php the_field('tagline') ?></p>
        <?php

        // Check if $_SESSION['restaurants'] is set and not empty
        if (isset($_SESSION['restaurants']) && !empty($_SESSION['restaurants'])) {
			$restaurants = get_posts(array('post_type' => 'cla-restaurant'));
			$restaurant_data = array();

			foreach($restaurants as $restaurant){
				$restaurant_data[] = $restaurant->post_name;
			}
			if(in_array($_SESSION['restaurants'], $restaurant_data)){
				echo "<section>";
					$taxonomy = 'cla-menu-categories';
					$post_type = 'cla-menu';
					$terms = get_the_terms(get_the_ID(), $taxonomy);
					
					if($terms && ! is_wp_error($terms)){
						foreach($terms as $term){
							$args = array(
								'post_type'      => $post_type,
								'posts_per_page' => -1,
								'orderby'		 => 'title',
								'order'			 => 'ASC',
								'tax_query'		 => array(
									array(
										'taxonomy'	=> $taxonomy,
										'field'		=> 'slug',
										'terms'  	=> $term->slug
									)
								
								)
							);
							$query = new WP_Query($args);
							if($query -> have_posts()){
								?> 
									<h2><?php echo $term->name?></h2>
								
								<?php
							}
						}
					}
				echo "</section>";
			}
		}
    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();
