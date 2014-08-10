<?php
/**
 * File for registering custom post type - portfolio.
 *
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2014 Tansh
 *
 */

/**
 * Registers portfolio post type
 *
 * @since  1.0.0
 */
add_action( 'init', 'tcsn_register_portfolio_posttype' );
function tcsn_register_portfolio_posttype() {
	$labels = array(
		'name'               => _x( 'Portfolio Items', 'post type general name', 'tcsn_theme' ),
		'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'tcsn_theme' ),
		'all_items'          => __( 'Portfolio Items', 'tcsn_theme' ),
		'add_new'            => __( 'Add New', 'tcsn_theme' ),
		'add_new_item'       => __( 'Add New Portfolio Item', 'tcsn_theme' ),
		'edit_item'          => __( 'Edit Portfolio Item', 'tcsn_theme' ),
		'new_item'           => __( 'New Portfolio Item', 'tcsn_theme' ),
		'view_item'          => __( 'View Portfolio Item', 'tcsn_theme' ),
		'search_items'       => __( 'Search Portfolio Items', 'tcsn_theme' ),
		'not_found'          => __( 'No Portfolio Items found', 'tcsn_theme' ),
		'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'tcsn_theme' ),
    );
	$args = array(
		'labels'          => $labels,
	    'public'          => true,  
        'show_ui'         => true,  
        'capability_type' => 'post',  
        'hierarchical'    => false,  
        'can_export'      => true,
        'has_archive'     => false,
		'menu_icon'       => 'dashicons-portfolio',
        'rewrite'         => array( 'slug' => 'portfolio-items' ),
        'supports'        => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	);
	register_post_type( 'tcsn_portfolio', $args );
}

/**
 * Register custom taxonomy for portfolio items.
 *
 * @since  1.0.0
 */
add_action( 'init', 'tcsn_register_portfolio_taxonomy' );
function tcsn_register_portfolio_taxonomy() {
    $labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'tcsn_theme' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'tcsn_theme' ),
        'search_items'      => __( 'Search Portfolio Categories', 'tcsn_theme' ),
        'all_items'         => __( 'All Portfolio Categories', 'tcsn_theme' ),
		'edit_item'         => __( 'Edit Portfolio Category', 'tcsn_theme' ),
		'view_item'         => __( 'View Portfolio Category', 'tcsn_theme' ),
        'parent_item'       => __( 'Parent Portfolio Category', 'tcsn_theme' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'tcsn_theme' ),
        'update_item'       => __( 'Update Portfolio Category', 'tcsn_theme' ),
        'add_new_item'      => __( 'Add New Portfolio Category', 'tcsn_theme' ),
        'new_item_name'     => __( 'New Portfolio Category Name', 'tcsn_theme' ),
    );
    $args = array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'rewrite'      => true,
    );
    register_taxonomy( 'tcsn_portfoliotags', array( 'tcsn_portfolio' ), $args );
}