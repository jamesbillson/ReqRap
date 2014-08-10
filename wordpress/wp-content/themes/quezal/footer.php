<?php
/**
 * The Footer for theme.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php if( $tcsn_option['tcsn_show_take_top'] == 1 ) { ?>

<div class="clearfix"></div>
<a id="take-me-top"><i class="icon-arrow-up12"></i></a>
<?php } ?>
<footer id="footer">
  <div class="container">
    <div class="row">
      <?php
			$footer_columns = $tcsn_option['tcsn_columns_footer'];
			switch ($footer_columns) {
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
			
			for ($i = 1; $i <= $footer_columns; $i++) {
				echo "<div class='$class'>";
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column - ' . $i)):
				endif;
				echo "</div>";
			}
			?>
    </div>
  </div>
</footer>
<!-- #footer -->

<?php if(isset($tcsn_option['tcsn_footer_tracking'])) { echo $tcsn_option['tcsn_footer_tracking']; } ?>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<?php wp_footer(); ?>
</body></html>