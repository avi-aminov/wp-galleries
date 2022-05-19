<?php

/**
 * custom post type "galleries"
 */
function gallery_post_type() {
    $labels = array(
        'name'                  => _x( 'Galleries', 'Post Type General Name', 'wp-galleries' ),
        'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'wp-galleries' ),
        'menu_name'             => __( 'Galleries', 'wp-galleries' ),
        'name_admin_bar'        => __( 'Gallery', 'wp-galleries' ),
        'archives'              => __( 'Item Archives', 'wp-galleries' ),
        'attributes'            => __( 'Item Attributes', 'wp-galleries' ),
        'parent_item_colon'     => __( 'Parent Item:', 'wp-galleries' ),
        'all_items'             => __( 'All Items', 'wp-galleries' ),
        'add_new_item'          => __( 'Add New Item', 'wp-galleries' ),
        'add_new'               => __( 'Add New', 'wp-galleries' ),
        'new_item'              => __( 'New Item', 'wp-galleries' ),
        'edit_item'             => __( 'Edit Item', 'wp-galleries' ),
        'update_item'           => __( 'Update Item', 'wp-galleries' ),
        'view_item'             => __( 'View Item', 'wp-galleries' ),
        'view_items'            => __( 'View Items', 'wp-galleries' ),
        'search_items'          => __( 'Search Item', 'wp-galleries' ),
        'not_found'             => __( 'Not found', 'wp-galleries' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'wp-galleries' ),
        'featured_image'        => __( 'Featured Image', 'wp-galleries' ),
        'set_featured_image'    => __( 'Set featured image', 'wp-galleries' ),
        'remove_featured_image' => __( 'Remove featured image', 'wp-galleries' ),
        'use_featured_image'    => __( 'Use as featured image', 'wp-galleries' ),
        'insert_into_item'      => __( 'Insert into item', 'wp-galleries' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-galleries' ),
        'items_list'            => __( 'Items list', 'wp-galleries' ),
        'items_list_navigation' => __( 'Items list navigation', 'wp-galleries' ),
        'filter_items_list'     => __( 'Filter items list', 'wp-galleries' ),
    );
    $args = array(
        'label'                 => __( 'Gallery', 'wp-galleries' ),
        'description'           => __( 'Gallery information page.', 'wp-galleries' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-page',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'galleries', $args );
}