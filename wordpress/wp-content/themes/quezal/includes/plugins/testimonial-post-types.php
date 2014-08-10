<?php
/**
 * File for registering custom post type - Testimonial.
 *
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2014 Tansh
 *
 */
 
/**
 * Registers testimonial post type
 *
 * @since  1.0.0
 */
add_action( 'init', 'tcsn_register_testimonial_posttype' );
function tcsn_register_testimonial_posttype() {
	$labels = array(
		'name'               => _x( 'Testimonial Items', 'post type general name', 'tcsn_theme' ),
		'singular_name'      => _x( 'Testimonial Item', 'post type singular name', 'tcsn_theme' ),
		'all_items'          => __( 'Testimonial Items', 'tcsn_theme' ),
		'add_new'            => __( 'Add New', 'tcsn_theme' ),
		'add_new_item'       => __( 'Add New Testimonial Item', 'tcsn_theme' ),
		'edit_item'          => __( 'Edit Testimonial Item', 'tcsn_theme' ),
		'new_item'           => __( 'New Testimonial Item', 'tcsn_theme' ),
		'view_item'          => __( 'View Testimonial Item', 'tcsn_theme' ),
		'search_items'       => __( 'Search Testimonial Items', 'tcsn_theme' ),
		'not_found'          => __( 'No Testimonial Items found', 'tcsn_theme' ),
		'not_found_in_trash' => __( 'No Testimonial Items found in Trash', 'tcsn_theme' ),
    );
	$args = array(
		'labels'          => $labels,
	    'public'          => true,  
        'show_ui'         => true,  
        'capability_type' => 'post',  
        'hierarchical'    => false,  
        'can_export'      => true,
        'has_archive'     => false,
		'menu_icon'       => 'dashicons-editor-quote',
        'rewrite'         => array( 'slug' => 'testimonial-items' ),
        'supports'        => array( 'title', 'editor', 'thumbnail' ),
	);
	register_post_type( 'tcsn_testimonial', $args );
}