<?php
/**
 * File for registering custom post type - Team.
 *
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2014 Tansh
 *
 */
 
/**
 * Registers team post type
 *
 * @since  1.0.0
 */
add_action( 'init', 'tcsn_register_team_posttype' );
function tcsn_register_team_posttype() {
	$labels = array(
		'name'               => _x( 'Team', 'post type general name', 'tcsn_theme' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name', 'tcsn_theme' ),
		'all_items'          => __( 'Team Members', 'tcsn_theme' ),
		'add_new'            => __( 'Add New', 'tcsn-team' ),
		'add_new_item'       => __( 'Add New Team Member', 'tcsn_theme' ),
		'edit_item'          => __( 'Edit Team Member', 'tcsn_theme' ),
		'new_item'           => __( 'New Team Member', 'tcsn_theme' ),
		'view_item'          => __( 'View Team Member', 'tcsn_theme' ),
		'search_items'       => __( 'Search Team Members', 'tcsn_theme' ),
		'not_found'          => __( 'No Team Members found', 'tcsn_theme' ),
		'not_found_in_trash' => __( 'No Team Members found in Trash', 'tcsn_theme' ),
    );
	$args = array(
		'labels'          => $labels,
	    'public'          => true,  
        'show_ui'         => true,  
        'capability_type' => 'post',  
        'hierarchical'    => false,  
        'can_export'      => true,
        'has_archive'     => false,
		'menu_icon'       => 'dashicons-businessman',
        'rewrite'         => array( 'slug' => 'team-members' ),
        'supports'        => array( 'title', 'editor', 'thumbnail', 'excerpt'  ),
	);
	register_post_type( 'tcsn_team', $args );
}