<?php

                            //$links = Iface::model()->getStepIfaces($item['id']);

                            $links = Step::model()->getStepLinks($item['id'], 12, 15);

                            foreach ($links as $link) {

                               $category=Iface::model()->getIfaceType($link['iface_id']);

                                

                                ?>



                                <span data-id="[[UI:<?php echo $link['iface_id']; ?>]]" ><a href="<?php echo Yii::app()->getBaseUrl();  ?>/iface/view/id/<?php echo $link['iface_id']; ?>"> 

                                    <?php echo Version::$numberformat[12]['prepend']?>-

                                    <?php echo str_pad($category['typenumber'], 2, "0", STR_PAD_LEFT ).str_pad($link['number'], Version::$numberformat[12]['padding'], "0", STR_PAD_LEFT); ?>  </a>

                                <?php echo $link['name']; ?> <a href="<?php echo Yii::app()->getBaseUrl();  ?>/stepiface/delete/id/<?php echo $link['xid']; ?>" class="unlink_object" data-id="[[UI:<?php echo $link['iface_id']; ?>]]" ><i class="icon-unlink text-error" rel="tooltip" title="Unlink this interface"></i></a><br /></span>

                            <?php

							

							} ?>

                      



<?php $interfaces = Iface::model()->getProjectIfaces($project); ?>   

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(

        'id'=>'interfaceModal',

        'fade' => false,

        'options' => array(

            'backdrop' => false

        )

    ));

?>

 

<div class="modal-header">

    <a class="close" data-dismiss="modal">&times;</a>

    <h4>Add Interfaces</h4>

</div>

 

<div class="modal-body">

    <form action="<?php echo Yii::app()->getBaseUrl();  ?>/stepiface/createinline/" method="POST">

        <input type="hidden" name="step_id" value="<?php echo $item['step_id']; ?>">

        <input type="hidden" name="project_id" value="<?php echo $project; ?>">

        <input type="hidden" name="step_db_id" value="<?php echo $item['id']; ?>">

		<select name="interface">

		<?php 

		
		 $interfaces_text_transform=array();
		 $iface_name=array();
		 $iface_id_name=array();
		 $iface_id_value=array();
		foreach ($interfaces as $iface) { 

		 $category=Iface::model()->getIfaceType($iface['iface_id']);
			$iface['name']=str_replace("'",'',$iface['name']);
			$iface['name']=str_replace("\\",'',$iface['name']);
		 $interfaces_text_transform[$iface['iface_id']]=Version::$numberformat[12]['prepend'].'- '.str_pad($category['typenumber'], 2, "0", STR_PAD_LEFT ).str_pad($iface['number'], Version::$numberformat[12]['padding'], "0", STR_PAD_LEFT).' '.$iface['name'];

		 

		$iface_name[]=$iface['name'];

		$iface_id_name[$iface['name']]=$iface['itemid'];

		$iface_id_value[$iface['itemid']]=$iface['iface_id'];?>

         <option value="<?php echo $iface['iface_id']; ?>"><?php echo $iface['name']; ?></option>

		<?php } ?>

         </select>

        

        <br />Add a new one

        <br>

        <input type="text" name="new_interface">

        <br>

        <input type="submit" value="add" class="btn primary">

    </form>

</div>

 

 

<?php $this->endWidget(); ?>

<style type="text/css">

    #interfaceModal{

        margin-left: 0px !important;

    }

</style>                          

<?php /*?><a href="#" onclick="$('#interfaceModal').modal('toggle'); var pos = $(this).offset(); $('#interfaceModal').css({'left': (pos.left - 260), 'top': pos.top - $(window, document).scrollTop() - 100}); return false;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Interface"></i> Add Interface</a><?php */?>

<script type="text/javascript">

var $interfaces_text_transform=$.parseJSON('<?php echo json_encode($interfaces_text_transform); ?>');

var $iface_name_array= <?php echo json_encode($iface_name);?>;

var $iface_json= $.parseJSON('<?php echo json_encode($iface_id_name); ?>');

var $iface_value_json= $.parseJSON('<?php echo json_encode($iface_id_value); ?>');

$(document).ready(function(){

				$("#typeaheadIfaceSearch").typeahead({

							 source:$iface_name_array,

							 minLength: 2,

							 updater:function(iface){

					     	 div1_html=$('#text_text_div_1').html();

							 ifid=$iface_json[iface];
							 iface_id=$iface_value_json[ifid];
							 iface_title=$interfaces_text_transform[iface_id];

							 ajax_data={interface:iface_id,step_id:'<?php echo $item['step_id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>',ifid:ifid};	

							 makeIfaceAjax(ajax_data,'#text_text_div_1','#Iface_popup');

						},

					});

				$("#NewIfaceSubmit").on('click',function(e){

								e.preventDefault();

								new_iface=$("#typeaheadIfaceSearch").val();

								if(new_iface!='')

								{

									

									$("#typeaheadIfaceSearch").val('');

									 ajax_data={new_interface:new_iface,step_id:'<?php echo $item['step_id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

									makeIfaceAjax(ajax_data,'#text_text_div_1','#Iface_popup');

								}

								

								

							});				



$("#typeaheadIfaceSearch2").typeahead({

							 source:$iface_name_array,

							 minLength: 2,

							 updater:function(iface){

					     	 div1_html=$('#result_text_div_2').html();

							 ifid=$iface_json[iface];
							 iface_id=$iface_value_json[ifid];
							 iface_title=$interfaces_text_transform[iface_id];

							 ajax_data={interface:iface_id,step_id:'<?php echo $item['step_id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>',ifid:ifid};

							 makeIfaceAjax(ajax_data,'#result_text_div_2','#Iface_popup2');

								

							 },

							});



				$("#NewIfaceSubmit2").on('click',function(e){

								e.preventDefault();

								new_iface=$("#typeaheadIfaceSearch2").val();

								if(new_iface!='')

								{

									//$('#Iface_popup2 a[data-toggle="dropdown"]').parent().removeClass('open');

									ajax_data={new_interface:new_iface,step_id:'<?php echo $item['step_id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

									$("#typeaheadIfaceSearch2").val('');

									 makeIfaceAjax(ajax_data,'#result_text_div_2','#Iface_popup2');

								}

									

});



});

function makeIfaceAjax(ajax_data,div_id,popup_id)

{

									

									$.ajax({

										   type:'POST',

										   data:ajax_data,

										   url:'<?php echo Yii::app()->getBaseUrl();  ?>/stepiface/createinline/',

										   dataType:'json',

										   success:function(data){

											   if(data.status)

											   {

												    div1_html=$(div_id).html();

							 						iface_id=data.id;

													iface_title=data.title;

							 						pop_id='iface_'+iface_id+makeid();

							 						ui_link = ' <span  contentEditable="true" data-id="[[UI:'+data.id+']]" ><a data-id="[[UI:'+data.id+']]" data-url="<?php echo Yii::app()->getBaseUrl();  ?>/stepiface/delete/id/'+data.xid+'" class="tlink" href="<?php echo Yii::app()->getBaseUrl();  ?>/iface/view/id/'+iface_id+'" onclick="return false;" >'+iface_title+'</a></span>&nbsp;&nbsp; ';	

							 						//div1_html=div1_html.splice(window.result_div_offset ,  ui_link);											

													div1_html+=ui_link;

							 						$(popup_id+' a[data-toggle="dropdown"]').parent().removeClass('open');

											    	$(div_id).html(div1_html);
													$(div_id+" br").remove();

													//bindpopover('#'+pop_id,'/stepiface/delete/id/'+data.xid ,'[[UI:'+data.id+']]');

										if(!$('#StepInterfaceTd span[data-id="[[UI:'+data.id+']]"]').length)

											{		

													$("#StepInterfaceTd").append('<span data-id="[[UI:'+data.id+']]" ><a href="<?php echo Yii::app()->getBaseUrl();  ?>/iface/view/id/'+data.id+'">'+data.code+'</a> '+data.name+'<a href="<?php echo Yii::app()->getBaseUrl();  ?>/stepiface/delete/id/'+data.xid+'" class="unlink_object" data-id="[[UI:'+data.id+']]" ><i title="Unlink this interface" rel="tooltip" class="icon-link text-error"></i></a><br /></span>');

											}

												   

											   }

										   },

										});

};





</script>

              