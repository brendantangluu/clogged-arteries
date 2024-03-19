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


 $args = array(
    'post_type'         => 'cla-restaurant',
    'posts_per_page'    => -1,
);
$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
        echo '<h2>';
        the_title();
        echo '</h2>';

       
        if (function_exists('get_field')) :
            
			// Pinpoint Image
            if (get_field('pinpoint_image')) :
                $pinpoint_image = get_field('pinpoint_image');
                $pinpoint_image_url = $pinpoint_image['url'];
                $pinpoint_image_alt = $pinpoint_image['alt'];
                echo '<img src="' . esc_url($pinpoint_image_url) . '" alt="' . esc_attr($pinpoint_image_alt) . '">';
            endif;

            // Address
            if (get_field('address')) :
                echo '<p>';
                the_field('address');
                echo '</p>';
            endif;

            // Phone Number
            if (get_field('phone_number')) :
                echo '<p>';
                the_field('phone_number');
                echo '</p>';
            endif;

            // Hours
            if (get_field('hours')) :
                echo '<p>';
                the_field('hours');
                echo '</p>';
            endif;
		endif;
    endwhile;
    wp_reset_postdata();
endif;
 
 get_footer();