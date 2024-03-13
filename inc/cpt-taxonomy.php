<?php

function cla_register_custom_post_types()
{
    // Labels for the Custom Post Type: 'Menu Items'
    $labels = array(
        'name'                  => _x('Menu Items', 'Post Type General Name', 'text-domain'),
        'singular_name'         => _x('Menu Item', 'Post Type Singular Name', 'text-domain'),
        'menu_name'             => __('Menu Items', 'text-domain'),
        'name_admin_bar'        => __('Menu Item', 'text-domain'),
        'add_new'               => __('Add New', 'text-domain'),
        'add_new_item'          => __('Add New Menu Item', 'text-domain'),
        'edit_item'             => __('Edit Menu Item', 'text-domain'),
        'new_item'              => __('New Menu Item', 'text-domain'),
        'all_items'             => __('All Menu Items', 'text-domain'),
        'view_item'             => __('View Menu Item', 'text-domain'),
        'search_items'          => __('Search Menu Items', 'text-domain'),
        'not_found'             => __('No Menu Items found', 'text-domain'),
        'not_found_in_trash'    => __('No Menu Items found in Trash', 'text-domain'),
        'parent_item_colon'     => __('Parent Menu Item:', 'text-domain'),
        'insert_into_item'      => __('Insert into menu', 'text-domain'),
        'uploaded_to_this_item' => __('Uploaded to this menu', 'text-domain'),
        'items_list'            => __('Menu list', 'text-domain'),
        'items_list_navigation' => __('Menu list navigation', 'text-domain'),
        'filter_items_list'     => __('Filter Menu list', 'text-domain'),
        'featured_image'        => __('Menu featured image', 'text-domain'),
        'set_featured_image'    => __('Set menu featured image', 'text-domain'),
        'remove_featured_image' => __('Remove menu featured image', 'text-domain'),
        'use_featured_image'    => __('Use as featured image', 'text-domain'),
    );

    // Arguments for the Custom Post Type
    $args = array(
        'labels'                => $labels,
        'description'           => 'Custom Post Type for Menu Items',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'our-menu'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-food',
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('cla-menu-categories', 'cla-location'),

    );

    register_post_type('cla-menu', $args);

    // Labels for the Custom Post Type: 'Restaurants'
    $restaurant_labels = array(
        'name'                  => _x('Restaurants', 'Post Type General Name', 'text-domain'),
        'singular_name'         => _x('Restaurant', 'Post Type Singular Name', 'text-domain'),
        'menu_name'             => __('Restaurants', 'text-domain'),
        'name_admin_bar'        => __('Restaurant', 'text-domain'),
        'add_new'               => __('Add New', 'text-domain'),
        'add_new_item'          => __('Add New Restaurant', 'text-domain'),
        'edit_item'             => __('Edit Restaurant', 'text-domain'),
        'new_item'              => __('New Restaurant', 'text-domain'),
        'all_items'             => __('All Restaurants', 'text-domain'),
        'view_item'             => __('View Restaurant', 'text-domain'),
        'search_items'          => __('Search Restaurants', 'text-domain'),
        'not_found'             => __('No restaurants found', 'text-domain'),
        'not_found_in_trash'    => __('No restaurants found in Trash', 'text-domain'),
        'parent_item_colon'     => __('Parent Restaurant:', 'text-domain'),
        'all_items'             => __('All Restaurants', 'text-domain'),
        'archives'              => __('Restaurant Archives', 'text-domain'),
        'attributes'            => __('Restaurant Attributes', 'text-domain'),
        'insert_into_item'      => __('Insert into restaurant', 'text-domain'),
        'uploaded_to_this_item' => __('Uploaded to this restaurant', 'text-domain'),
        'featured_image'        => __('Restaurant featured image', 'text-domain'),
        'set_featured_image'    => __('Set restaurant featured image', 'text-domain'),
        'remove_featured_image' => __('Remove restaurant featured image', 'text-domain'),
        'use_featured_image'    => __('Use as restaurant featured image', 'text-domain'),
    );

    // Arguments for the Restaurants CPT
    $restaurant_args = array(
        'labels'             => $restaurant_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'our-restaurants'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-store',
        'supports'           => array('title'),
    );

    // Register the Restaurants post type
    register_post_type('cla-restaurant', $restaurant_args);

    // Labels for the Custom Post Type: 'Careers'
    $career_labels = array(
        'name'                  => _x('Careers', 'Post Type General Name', 'text-domain'),
        'singular_name'         => _x('Career', 'Post Type Singular Name', 'text-domain'),
        'menu_name'             => __('Careers', 'text-domain'),
        'name_admin_bar'        => __('Career', 'text-domain'),
        'add_new'               => __('Add New', 'text-domain'),
        'add_new_item'          => __('Add New Career Position', 'text-domain'),
        'edit_item'             => __('Edit Career Position', 'text-domain'),
        'new_item'              => __('New Career Position', 'text-domain'),
        'all_items'             => __('All Career Positions', 'text-domain'),
        'view_item'             => __('View Career Position', 'text-domain'),
        'search_items'          => __('Search Career Positions', 'text-domain'),
        'not_found'             => __('No career positions found', 'text-domain'),
        'not_found_in_trash'    => __('No career positions found in Trash', 'text-domain'),
        'parent_item_colon'     => __('Parent Career Position:', 'text-domain'),
        'all_items'             => __('All Careers', 'text-domain'),
        'archives'              => __('Career Archives', 'text-domain'),
        'attributes'            => __('Career Attributes', 'text-domain'),
        'insert_into_item'      => __('Insert into career', 'text-domain'),
        'uploaded_to_this_item' => __('Uploaded to this career', 'text-domain'),
        'featured_image'        => __('Career featured image', 'text-domain'),
        'set_featured_image'    => __('Set career featured image', 'text-domain'),
        'remove_featured_image' => __('Remove career featured image', 'text-domain'),
        'use_featured_image'    => __('Use as career featured image', 'text-domain'),
    );

    // Arguments for the Careers CPT
    $career_args = array(
        'labels'             => $career_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'careers'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'thumbnail'),
        'taxonomies'         => array('cla-location'),
    );

    // Register the Careers post type
    register_post_type('cla-careers', $career_args);
}

add_action('init', 'cla_register_custom_post_types');

function cla_register_custom_taxonomies()
{
    // Taxonomy for the 'Locations' CPT
    $location_tax_labels = array(
        'name'              => _x('Locations', 'taxonomy general name', 'text-domain'),
        'singular_name'     => _x('Location', 'taxonomy singular name', 'text-domain'),
        'search_items'      => __('Search Locations', 'text-domain'),
        'all_items'         => __('All Locations', 'text-domain'),
        'parent_item'       => __('Parent Location', 'text-domain'),
        'parent_item_colon' => __('Parent Location:', 'text-domain'),
        'edit_item'         => __('Edit Location', 'text-domain'),
        'update_item'       => __('Update Location', 'text-domain'),
        'add_new_item'      => __('Add New Location', 'text-domain'),
        'new_item_name'     => __('New Location Name', 'text-domain'),
        'menu_name'         => __('Locations', 'text-domain'),
    );

    $location_tax_args = array(
        'hierarchical'      => true, // True means it's like categories, false means it's like tags.
        'labels'            => $location_tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'location-types'),
    );

    register_taxonomy('cla-location', array('cla-menu', 'cla-careers'), $location_tax_args);

    // Taxonomy for the 'Menu Categories' CPT
    $menu_category_labels = array(
        'name'              => _x('Menu Categories', 'taxonomy general name', 'text-domain'),
        'singular_name'     => _x('Menu Category', 'taxonomy singular name', 'text-domain'),
        'search_items'      => __('Search Menu Categories', 'text-domain'),
        'all_items'         => __('All Menu Categories', 'text-domain'),
        'parent_item'       => __('Parent Menu Category', 'text-domain'),
        'parent_item_colon' => __('Parent Menu Category:', 'text-domain'),
        'edit_item'         => __('Edit Menu Category', 'text-domain'),
        'update_item'       => __('Update Menu Category', 'text-domain'),
        'add_new_item'      => __('Add New Menu Category', 'text-domain'),
        'new_item_name'     => __('New Menu Category Name', 'text-domain'),
        'menu_name'         => __('Menu Category', 'text-domain'),
    );

    $menu_category_args = array(
        'hierarchical'      => true,
        'labels'            => $menu_category_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'menu-categories'),
    );

    register_taxonomy('cla-menu-categories', array('cla-menu'), $menu_category_args);
}

add_action('init', 'cla_register_custom_taxonomies');
