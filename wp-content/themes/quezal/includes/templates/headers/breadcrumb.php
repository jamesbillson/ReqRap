<?php
/**
 * The Breadcrumb
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php global $tcsn_option; ?>
<?php if( $tcsn_option['tcsn_show_breadcrumb'] == 1 ) { ?>
<ul class="breadcrumbs">
  <?php if(function_exists('bcn_display_list'))
    {
        bcn_display_list();
    }?>
</ul>
<?php } ?>

