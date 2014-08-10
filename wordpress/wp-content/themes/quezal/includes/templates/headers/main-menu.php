<?php
/**
 * The Main Menu
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php 
if( has_nav_menu( 'primary_menu' ) ) {
wp_nav_menu( array( 
	'theme_location'  	=> 'primary_menu',
	'container'       	=> '',
	'container_class'	=> '',
	'container_id'   	=> '',
	'menu_class'      	=> 'sf-menu',
	'menu_id'         	=> 'menu',
	'depth'           	=> 0,
	'walker' 		  	=> new TCSN_Dropdown_Walker_Nav_Menu,
	) 
); 
}
