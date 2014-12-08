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
if ( is_user_logged_in() ) { ?>
<script type="text/javascript">
<!--
		jQuery(document).ready(function() {
			if(jQuery('#menu').size()) {
				jQuery('#menu').append('<li class="menu-item menu-item-type-post_type menu-item-object-page" ><a href="/req/">Main Project</a></li>');
			}
		});
//-->
</script>
<?php } ?>
