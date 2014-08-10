<?php
/**
 * The sidebar containing the widget area, displays on posts and pages.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<div class="col-md-4 col-sm-4 col-xs-12 sidebar">
    <?php if(is_page()){
		dynamic_sidebar('widgets-page'); 
	} else {
		if ( dynamic_sidebar('widgets-blog') );
	}	
	?>
</div>