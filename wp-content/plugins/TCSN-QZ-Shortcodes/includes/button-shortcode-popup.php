<?php
// look up for the path
require_once('tcsn_config.php');
// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__( 'You are not allowed to be here', 'tcsn-shortcodes' ));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Theme Styled Buttons</title>
<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-content/plugins/TCSN-QZ-Shortcodes/js/jquery-1.9.1.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<link rel="stylesheet" href="<?php echo get_option( 'siteurl' ) ?>/wp-content/plugins/TCSN-QZ-Shortcodes/css/tinymce.css" />
<script type="text/javascript">
var TCSNDialog = {
    local_ed: 'ed',
    init: function (ed, url) {
        TCSNDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertButton(ed) {

        // set up variables to contain input values
		var style  = jQuery('#dialogwindow select#field-style').val();
		var size   = jQuery('#dialogwindow select#field-size').val();
		var target = jQuery('#dialogwindow select#field-target').val();
        var url    = jQuery('#dialogwindow input#field-url').val();
        var text   = jQuery('#dialogwindow input#field-text').val();
		var icon   = jQuery('#dialogwindow input#field-icon').val();

        var output = '';

        // setup the output of shortcode
        output = ' [button ';

        output += 'class="' + size + ' ' + style + '" ';
		output += 'target="' + target + '" ';

        if (url) {
            output += 'url="' + url + '" ';
		}
		
	    if (icon) {
            output += 'icon="' + icon + '" ';
		}

        if (text) {
            output += ']' + text + '[/button]';
        }
		
        // if it is blank, use the selected text, if present
        else {
            output += ']' + TCSNDialog.local_ed.selection.getContent() + '[/button] ';
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);

        // Return
        tinyMCEPopup.close();
    }
};
tinyMCEPopup.onInit.add(TCSNDialog.init, TCSNDialog);
</script>
</head>
<body>
<div id="dialogwindow">
  <form action="/" method="get" accept-charset="utf-8">
    <p class="clearfix">
      <label for="field-text">Button Text</label>
      <input type="text" name="field-text" value="" id="field-text" />
    </p>
    <p class="clearfix">
      <label for="field-url">Button URL</label>
      <input type="text" name="field-url" value="" id="field-url" />
    </p>
    <p class="clearfix">
      <label for="field-target">Target</label>
      <select name="field-target" id="field-target" size="1">
        <option value="_blank" selected="selected">_blank</option>
        <option value="_self"=>_self</option>
      </select>
    </p>
    <p class="clearfix">
      <label for="field-style">Button Style</label>
      <select name="field-style" id="field-style" size="1">
        <option value="">Normal Button >>>>>>>>>>>>>>></option>
        <option value="">Grey</option>
        <option value="mybtn-green" selected="selected">Green</option>
        <option value="mybtn-blue">Blue</option>
        <option value="mybtn-red">Red</option>
        <option value="mybtn-olive">Olive</option>
        <option value="mybtn-cyan">Cyan</option>
        <option value="mybtn-white">White</option>
        <option value="">Transparent Button With Border >>>>>>>>>>>>>>></option>
        <option value="mybtn-flat">Grey With Border</option>
        <option value="mybtn-flat-green">Green With Border</option>
        <option value="mybtn-flat-blue">Blue With Border</option>
        <option value="mybtn-flat-red">Red With Border</option>
        <option value="mybtn-flat-olive">Olive With Border</option>
        <option value="mybtn-flat-cyan">Cyan With Border</option>
        <option value="mybtn-flat-white">White With Border</option>
      </select>
    </p>
    <p class="clearfix">
      <label for="field-size">Button Size</label>
      <select name="field-size" id="field-size" size="1">
        <option value="mybtn" selected="selected">Normal</option>
        <option value="mybtn mybtn-big ">Big</option>
      </select>
    </p>
    <p class="clearfix">
      <label for="field-icon">Icon Name</label>
      <input type="text" name="field-icon" value="" id="field-icon" />
    </p>
  </form>
  <div class="clearfix"></div>
  <a class="mybtn" href="javascript:TCSNDialog.insert(TCSNDialog.local_ed)">Insert Button</a>
  <div class="clearfix"></div>
</div>
</body>
</html>