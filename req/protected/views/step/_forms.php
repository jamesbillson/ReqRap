

   <?php

                                    //$links = Form::model()->getStepForms($item['id']);

                                    $links = Step::model()->getStepLinks($item['id'], 2, 14); // centralise all these.

                                    foreach ($links as $link) {

                                        ?>

<span data-id="[[UF:<?php echo $link['form_id']; ?>]]"><a href="<?php echo Yii::app()->getBaseUrl();  ?>/form/view/id/<?php echo $link['form_id']; ?>">UF-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['name']; ?> <a href="<?php echo Yii::app()->getBaseUrl();  ?>/stepform/delete/id/<?php echo $link['xid']; ?>" class="unlink_object" data-id="[[UF:<?php echo $link['form_id']; ?>]]" ><i class="icon-unlink text-error" rel="tooltip" title="Unlink this form"></i></a><br/></span>

                                <?php

								

								} ?>

                                    



<?php $forms =Form::model()->getProjectForms($project); ?>  

                               

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(

        'id'=>'formsModal',

        'fade' => false,

        'options' => array(

            'backdrop' => false

        )

    ));

?>

 

<div class="modal-header">

    <a class="close" data-dismiss="modal">&times;</a>

    <h4>Add Forms</h4>

</div>

 

<div class="modal-body">

    <form action="<?php echo Yii::app()->getBaseUrl();  ?>/stepform/createinline/" method="POST">

        <input type="hidden" name="step_id" value="<?php echo $item['id']; ?>">

        <input type="hidden" name="project_id" value="<?php echo $project; ?>">

        <input type="hidden" name="step_db_id" value="<?php echo $item['id']; ?>">

        <select name="form">

        <?php
		$forms_text_transform=array();
		$form_id_name=array();
		$form_name=array();
		$form_id_value=array();
		foreach ($forms as $form) {
			
			$form['name']=str_replace("'",'',$form['name']);
			$form['name']=str_replace("\\",'',$form['name']);

			$forms_text_transform[$form['form_id']]='UF- '.str_pad($form['number'], 3, "0", STR_PAD_LEFT).' '.$form['name'];

			$form_name[]=$form['name'];

		$form_id_name[$form['name']]=$form['form_id'];

		$arr['value']=$form['form_id'];

		$arr['text']=$form['name'];		

		$form_id_value[]=$arr;

			?>

                <option value="<?php echo $form['form_id']; ?>"><?php echo $form['name']; ?></option>

        <?php } ?>

        </select>

        <br />Add a new one<br>

        <input type="text" name="new_form">

        <br>

        <input type="submit" value="add" class="btn primary">

    </form>

</div>

 

<?php $this->endWidget(); ?>                       

<style type="text/css">

    #formsModal{

        margin-left: 0px !important;

    }

</style>

<?php /*?><a href="#" onclick="$('#formsModal').modal('toggle'); var pos = $(this).offset(); $('#formsModal').css({'left': (pos.left - 260), 'top': pos.top - $(window, document).scrollTop() - 100}); return false;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Forms"></i> Add Forms</a><?php */?>

<script type="text/javascript">

var $form_name_array= <?php echo json_encode($form_name);?>;

var $form_json= $.parseJSON('<?php echo json_encode($form_id_name); ?>');

var $formvalue_json= $.parseJSON('<?php echo json_encode($form_id_value); ?>');

var $forms_text_transform=$.parseJSON('<?php echo json_encode($forms_text_transform); ?>');

$(document).ready(function(){

				$("#typeaheadSFormSearch").typeahead({

							 source:$form_name_array,

							 minLength: 2,

							 updater:function(form){

							 div1_html=$('#text_text_div_1').html();

							 form_id=$form_json[form];

							 form_title=$forms_text_transform[form_id];

							  ajax_data={form:form_id,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

							 makeFormAjax(ajax_data,'#text_text_div_1','#SForm_popup');

							 // return form;

							 },

							});

				$("#NewSFormSubmit").on('click',function(e){

								e.preventDefault();

								new_form=$("#typeaheadSFormSearch").val();

								if(new_form!='')

								{

									//$('#SForm_popup a[data-toggle="dropdown"]').parent().removeClass('open');

									$("#typeaheadSFormSearch").val('');

									ajax_data={new_form:new_form,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

									makeFormAjax(ajax_data,'#text_text_div_1','#SForm_popup');

									

								}

								

								

							});				

				

				$("#typeaheadSFormSearch2").typeahead({

							 source:$form_name_array,

							 minLength: 2,

							 updater:function(form){

					     	 form_id=$form_json[form];

							 form_title=$forms_text_transform[form_id];

							 ajax_data={form:form_id,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

							 makeFormAjax(ajax_data,'#result_text_div_2','#SForm_popup2');

							 //return form;

							 },

							});

				$("#NewSFormSubmit2").on('click',function(e){

								e.preventDefault();

								new_form=$("#typeaheadSFormSearch2").val();

								if(new_form!='')

								{

									//$('#SForm_popup2 a[data-toggle="dropdown"]').parent().removeClass('open');

									$("#typeaheadSFormSearch2").val('');

									 ajax_data={new_form:new_form,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

									makeFormAjax(ajax_data,'#result_text_div_2','#SForm_popup2');

								}

								

								

							});				

   

			   });



function makeFormAjax(ajax_data,div_id,popup_id)

{

	$.ajax({

			type:'POST',

			data:ajax_data,

			url:'<?php echo Yii::app()->getBaseUrl();  ?>/stepform/createinline/',

			dataType:'json',

			success:function(data){

				   if(data.status)

				   {

				   	div1_html=$(div_id).html();

					form_id=data.id;

					form_title=data.title;

				    pop_id='Form_'+form_id+makeid();

ui_link = '<span  contentEditable="true" data-id="[[UF:'+data.id+']]"><a data-id="[[UF:'+data.id+']]" data-url="<?php echo Yii::app()->getBaseUrl();  ?>/stepform/delete/id/'+data.xid+'" class="tlink" href="<?php echo Yii::app()->getBaseUrl();  ?>/iface/view/id/'+form_id+'" onclick="return false;" >'+form_title+'</a></span>&nbsp;&nbsp;  ';	

					//div1_html=div1_html.splice(window.result_div_offset ,  ui_link);			

					div1_html+=ui_link;

					$(popup_id+' a[data-toggle="dropdown"]').parent().removeClass('open');

					$(div_id).html(div1_html);
					$(div_id+" br").remove();

					//bindpopover('#'+pop_id,'/stepform/delete/id/'+data.xid,'[[UF:'+data.id+']]');

					if(!$('#StepFormTd span[data-id="[[UF:'+data.id+']]"]').length)

					{								  

					$("#StepFormTd").append('<span data-id="[[UF:'+data.id+']]" ><a href="<?php echo Yii::app()->getBaseUrl();  ?>/form/view/id/'+data.id+'">'+data.code+'</a> '+data.name+'<a href="<?php echo Yii::app()->getBaseUrl();  ?>/stepform/delete/id/'+data.xid+'" class="unlink_object" data-id="[[UF:'+data.id+']]"><i title="Unlink this interface" rel="tooltip" class="icon-link text-error"></i></a><br /></span>');

					}

				}

			},

		 });

}



</script>