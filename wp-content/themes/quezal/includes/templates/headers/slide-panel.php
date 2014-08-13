<?php
/**
 * The Slide Panel
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php if( $tcsn_option['tcsn_show_slide_panel'] == 1 ) { ?>

<div id="slide-top" class="clearfix">
  <div class="slide-top-inner">
    <div class="container">
      <div class="row">
        <?php
			$tcsn_slide_panel_columns = $tcsn_option['tcsn_columns_slide_panel'];
			switch ($tcsn_slide_panel_columns) {
			case 1:
				$class = 'col-md-12 col-sm-12 col-xs-12';
				break;
			
			case 2:
				$class = 'col-md-6 col-sm-6 col-xs-12';
				break;
			
			case 3:
				$class = 'col-md-4 col-sm-4 col-xs-12';
				break;
			
			case 4:
				$class = 'col-md-3 col-sm-3 col-xs-12';
				break;
			}
			
			for ($i = 1; $i <= $tcsn_slide_panel_columns; $i++) {
				echo "<div class='$class'>";
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Slide Panel - column - ' . $i)):
				endif;
				echo "</div>";
			}
			?>
      </div>
    </div>
  </div>
  <a href="#" class="slide-panel-btn"><span><i class="plus icon-circle-plus"></i><i class="minus icon-circle-minus"></i></span></a> </div>
<!-- #slide panel -->
<?php } ?>
