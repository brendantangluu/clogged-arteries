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
<main id="primary" class="site-main restaurant-page">
    
    <?php

    while(have_posts()):
        the_post();

        $args = array(
        'post_type'         => 'cla-restaurant',
        'posts_per_page'    => -1,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                
                echo '<article class="info-map">';
                    echo '<div class="restaurant-card">';
                            $pinpoint = get_field('pinpoint_image');
                            if (function_exists('get_field')) :
                                if (get_field('pinpoint_image')) :
                                    echo wp_get_attachment_image($pinpoint, 'large');
                                endif;
                                echo '<h2>';
                                the_title();
                                echo '</h2>';
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
                         
                    echo "</div>";
                        // Google Map Field
                        ?>
                    <div class = 'acf-map'>
                            <?php
                            if (get_field('map')) :
                                $map = get_field('map')
                                ?>
                                    <div class = "marker" data-lat="<?php echo $map['lat']?>" data-lng="<?php echo $map['lng']?>">

                                    </div>
                                
                                <?php
                            endif;
                            ?>
                    </div>
                    <?php
                echo '</article>';
                endif;
            endwhile;
            wp_reset_postdata();
        endif;
    endwhile;

    ?>

</main><!-- #main -->
<?php 
 get_footer();