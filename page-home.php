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
									?> 
										<img src="<?php the_field('food_image') ?>" alt="">
										<h2><?php the_title(); ?></h2>
										<p><?php the_field('food_description') ?></p>
										<aside><?php the_field('food_price')?></aside>
									<?php

                                }
                                wp_reset_postdata(); // Reset the post data    
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
?>
