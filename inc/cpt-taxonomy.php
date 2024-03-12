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
}

add_action('init', 'cla_register_custom_post_types');
