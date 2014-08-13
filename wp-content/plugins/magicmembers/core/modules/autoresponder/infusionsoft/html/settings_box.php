<!--infusionsoft box settings -->
<div id="module_settings_box_<?php echo $data['module']->code?>" class="module_settings_box box_max">	
	<div class="name">
		<input type="radio" name="module" value="<?php echo $data['module']->code?>" <?php echo ( $data['module']->is_enabled() ) ? 'checked' : ''; ?>/>
		<?php echo $data['module']->name?>
	</div>	
	<div class="clearfix"></div>
	<div class="description">
		<?php echo $data['module']->description?>
	</div>			
	<div class="fields">
		<div class="table">
	  		<div class="row">
	    		<div class="cell width26 textalignleft">
		    		<b><?php _e('Api Key','mgm'); ?></b>
				</div>
	    		<div class="cell width2 textaligncenter">
		    		<b>:</b>
				</div>
	    		<div class="cell textalignleft">
		    		<input type="text" name="setting[infusionsoft][api_key]" value="<?php echo $data['module']->setting['api_key']; ?>" size="40" />
				</div>
			</div>
	  		<div class="row">
	    		<div class="cell width26 textalignleft">
		    		<b><?php _e('Post Url','mgm'); ?></b>
				</div>
	    		<div class="cell width2 textaligncenter">
		    		<b>:</b>
				</div>
	    		<div class="cell textalignleft">
					<input type="text" name="setting[infusionsoft][post_url]" value="<?php echo $data['module']->setting['post_url']; ?>"  size="40"/>
					<div class="tips width100">
						<?php _e('Infusionsoft api post url','mgm'); ?><br/>
						<b><?php _e('E.g.','mgm'); ?>:</b> 
						<?php _e('https://ad192.infusionsoft.com/api/xmlrpc/','mgm'); ?>
					</div>
				</div>
			</div>
	 	</div>	
	</div>
</div>