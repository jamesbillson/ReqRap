     <?php

                            // $links = Rule::model()->getStepRules($item['id']);

                            $links = Step::model()->getStepLinks($item['id'], 1, 16);

                            foreach ($links as $link) {

                            ?>

                                    <span data-id="[[BR:<?php echo $link['rule_id']; ?>]]" ><a href="<?php echo Yii::app()->getBaseUrl();  ?>/rule/view/id/<?php echo $link['rule_id']; ?>"> BR-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['name']; ?> <a href="<?php echo Yii::app()->getBaseUrl();  ?>/steprule/delete/id/<?php echo $link['xid']; ?>" class="unlink_object" data-id="[[BR:<?php echo $link['rule_id']; ?>]]" ><i class="icon-unlink text-error" rel="tooltip" title="Unlink this rule"></i></a><br/></span>

                            <?php

							

							} ?>

                              

<?php $rules = Rule::model()->getProjectRules($project); ?>   

                                

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(

        'id'=>'rulesModal',

        'fade' => false,

        'options' => array(

            'backdrop' => false

        )

    ));

?>

 

<div class="modal-header">,

    <a class="close" data-dismiss="modal">&times;</a>

    <h4>Add Rules</h4>

</div>

 

<div class="modal-body">

    <form action="<?php echo Yii::app()->getBaseUrl();  ?>/steprule/createinline/" method="POST">

        <input type="hidden" name="step_id" value="<?php echo $item['id']; ?>">

        <input type="hidden" name="project_id" value="<?php echo $project; ?>">

        <input type="hidden" name="step_db_id" value="<?php echo $item['id']; ?>">

        <select name="rule">

        <?php 
		$rules_text_transform=array();
		$rule_name=array();
		$rule_id_name=array();
		$rule_id_value=array();
		foreach ($rules as $rule) {

			$rule['name']=str_replace("'",'',$rule['name']);
			$rule['name']=str_replace("\\",'',$rule['name']);
			$rules_text_transform[$rule['rule_id']]='BR- '.str_pad($rule['number'], 3, "0", STR_PAD_LEFT).' '.$rule['name'];

			$rule_name[]=$rule['name'];

		$rule_id_name[$rule['name']]=$rule['id'];

		
		$rule_id_value[$rule['id']]=$rule['rule_id'];

			

			?>

            <option value="<?php echo $rule['rule_id']; ?>"><?php echo $rule['name']; ?></option>

        <?php } ?>

        </select>

        <br />Add a new one<br>

        <input type="text" name="new_rule"><br>

        <input type="submit" value="add" class="btn primary">

    </form>

</div>

 

 

<?php $this->endWidget(); ?>

<style type="text/css">

    #rulesModal{

        margin-left: 0px !important;

    }

</style>                         

<?php /*?><a href="#" onclick="$('#rulesModal').modal('toggle'); var pos = $(this).offset(); $('#rulesModal').css({'left': (pos.left - 260), 'top': pos.top - $(window, document).scrollTop() - 100}); return false;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Rule"></i> Add Rule</a>             

<?php */?> <script type="text/javascript">

 var $rules_text_transform=$.parseJSON('<?php echo json_encode($rules_text_transform); ?>');



var $rule_name_array= <?php echo json_encode($rule_name);?>;

var $rule_json= $.parseJSON('<?php echo json_encode($rule_id_name); ?>');

var $rulevalue_json= $.parseJSON('<?php echo json_encode($rule_id_value); ?>');

$(document).ready(function(){

				$("#step-form .dropdown > a").on('click',function(){
					  var me=$(this);
					   setTimeout(function(){me.parent().find('.dropdown-menu').find('input').focus();},200);												  																
				});
				
				$("#typeaheadSRuleSearch").typeahead({

							 source:$rule_name_array,

							 minLength: 2,

							 updater:function(rule){

							 div1_html=$('#text_text_div_1').html();

							 rid=$rule_json[rule];
							 rule_id = $rulevalue_json[rid];
							 rule_title=$rules_text_transform[rule_id];

							 ajax_data={rule:rule_id,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>',rid:rid};

							 makeRuleAjax(ajax_data,'#text_text_div_1','#SRule_popup');

							 // return rule;

							 },

							});

				$("#NewSRuleSubmit").on('click',function(e){

								e.preventDefault();

								new_rule=$("#typeaheadSRuleSearch").val();

								if(new_rule!='')

								{

									//$('#SRule_popup a[data-toggle="dropdown"]').parent().removeClass('open');

									$("#typeaheadSRuleSearch").val('');

									ajax_data={new_rule:new_rule,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

									makeRuleAjax(ajax_data,'#text_text_div_1','#SRule_popup');

							

								}

								

								

							});				

				

				

				

						   

						   $("#typeaheadSRuleSearch2").typeahead({

							 source:$rule_name_array,

							 minLength: 2,

							 updater:function(rule){

					     	 rid=$rule_json[rule];
							 rule_id = $rulevalue_json[rid];
							 rule_title=$rules_text_transform[rule_id];

							 ajax_data={rule:rule_id,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>',rid:rid};

							 makeRuleAjax(ajax_data,'#result_text_div_2','#SRule_popup2');

							

							 },

							});

				$("#NewSRuleSubmit2").on('click',function(e){

								e.preventDefault();

								new_rule=$("#typeaheadSRuleSearch2").val();

								if(new_rule!='')

								{

									//$('#SRule_popup2 a[data-toggle="dropdown"]').parent().removeClass('open');

									$("#typeaheadSRuleSearch2").val('');

									  ajax_data={new_rule:new_rule,step_id:'<?php echo $item['id']; ?>',project_id:'<?php echo $project; ?>',step_db_id:'<?php echo $item['id']; ?>'};

									makeRuleAjax(ajax_data,'#result_text_div_2','#SRule_popup2');

									

								}

								

								

							});				

				});



function makeRuleAjax(ajax_data,div_id,popup_id)

{

			$.ajax({

					 type:'POST',

					 data:ajax_data,

					 url:'<?php echo Yii::app()->getBaseUrl();  ?>/steprule/createinline/',

					 dataType:'json',

					 success:function(data){

					   if(data.status)

					   {

					   	div1_html=$(div_id).html();

						rule_id=data.id;

						rule_title=data.title;

						pop_id='rule_'+rule_id+makeid();

						ui_link = '<span  contentEditable="true" data-id="[[BR:'+data.id+']]" ><a data-id="[[BR:'+data.id+']]" data-url="<?php echo Yii::app()->getBaseUrl();  ?>/steprule/delete/id/'+data.xid+'" class="tlink" href="<?php echo Yii::app()->getBaseUrl();  ?>/rule/view/id/'+rule_id+'" onclick="return false;">'+rule_title+'</a></span>&nbsp;&nbsp;  ';	

						//div1_html=div1_html.splice(window.result_div_offset ,  ui_link);											

						div1_html+=ui_link;

						$(popup_id+' a[data-toggle="dropdown"]').parent().removeClass('open');

						$(div_id).html(div1_html);
						$(div_id+" br").remove();

						//bindpopover('#'+pop_id,'/steprule/delete/id/'+data.xid,'[[BR:'+data.id+']]');

						if(!$('#StepRuleTd span[data-id="[[BR:'+data.id+']]"]').length)

						{

							$("#StepRuleTd").append('<span data-id="[[BR:'+data.id+']]" ><a href="<?php echo Yii::app()->getBaseUrl();  ?>/rule/view/id/'+data.id+'" >'+data.code+'</a> '+data.name+'<a href="<?php echo Yii::app()->getBaseUrl();  ?>/steprule/delete/id/'+data.xid+'" class="unlink_object" data-id="[[BR:'+data.id+']]" ><i title="Unlink this interface" rel="tooltip" class="icon-link text-error"></i></a><br /></span>');

						}

					}

				},

			});

}



</script>

                                            

                                

                                

                        

                        