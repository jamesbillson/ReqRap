<style type="text/css">

    .modal {

        width: 252px;

        margin-left: -126px;

    }



.custom_editable_textarea {

width: 500px;

margin: 0;

overflow: auto;

padding: 7px;

text-align: justify;

background: transparent;

min-height:80px;

background-color: #fff;

border: 1px solid #ccc;

border-radius:5px;

box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;

transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;

}



</style>

<script type="text/javascript">

var action_div_offset;

var result_div_offset;

function makeid()

{

    var text = "";

    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";



    for( var i=0; i < 5; i++ )

        text += possible.charAt(Math.floor(Math.random() * possible.length));



    return text;

}







String.prototype.splice = function( position, newstring ) {

    return (this.slice(0,position) + newstring + this.slice(position));

};

function getCharacterOffsetWithin(range, node) {

    var treeWalker = document.createTreeWalker(

        node,

        NodeFilter.SHOW_TEXT,

        function(node) {

            var nodeRange = document.createRange();

            nodeRange.selectNode(node);

            return nodeRange.compareBoundaryPoints(Range.END_TO_END, range) < 1 ?

                NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;

        },

        false

    );



    var charCount = 0;

    while (treeWalker.nextNode()) {

        charCount += treeWalker.currentNode.length;

		console.log("current Node length:"+treeWalker.currentNode.length);

    }

    if (range.startContainer.nodeType == 3) {

        charCount += range.startOffset;

    }

    return charCount;

}

function echoRange(element)

{

	var el = document.getElementById(element);

	

    var range = window.getSelection().getRangeAt(0);

  	return getCharacterOffsetWithin(range, el);

}

function bindpopover(element,url,data_id)

{
;
}



</script>

<?php

$project = Yii::App()->session['project'];

 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;

$steps = Step::model()->getFlowSteps($model->flow_id);

if (count($steps)):

    ?>  

    <table class="table"> 

        <tbody>

            <?php foreach ($steps as $key => $item) : // Go through each un answered question? ?>

                <tr class="odd">

                    <?php if ($item['id'] == $id && $edit) { // THIS IS THE STEP WE ARE EDITING ?>

                        <td style="border-right: 1px solid #DDDDDD"> 

                            <?php

                            $form = $this->beginWidget('CActiveForm', array(

                                'id' => 'step-form',

                                'enableAjaxValidation' => false,

                            ));

                            ?>

                            <?php echo $form->errorSummary($step); ?>

                            <?php echo $form->hiddenfield($step, 'flow_id', array('value' => $model->id)); ?>

                            <b>Step <?php echo $item['number']; ?></b><br>

                            <ul class="nav pull-right" style="margin-right:25px;" id="sRuleP">

       						   <li class="dropdown" id="SRule_popup">

                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" id="SRuleRefrence"><i class="icon-gears"></i></a>

                             <div class="dropdown-menu" id="srule_drop_form" style="padding:14px;min-width:280px;">

                    <div style="float:left;">

                            <span style="width:80px;float:left;"> Add/Search</span> <input name="new_rule"  style="width:150px;float:left;" type="text" id="typeaheadSRuleSearch" placeholder="Business Rule" autocomplete="off" />&nbsp;<a href="#" id="NewSRuleSubmit" style="width:15px;float:left;margin-left:10px;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Rule"></i> </a> </div></div></li></ul>

                            

                            <ul class="nav pull-right" style="margin-right:6px;">

       						   <li class="dropdown" id="SForm_popup">

                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" id="SFormRefrence"><i class="icon-list-alt"></i></a>

                             <div class="dropdown-menu" id="SForm_form" style="padding:14px;min-width:280px;">

                    <div style="float:left;">

                            <span style="width:80px;float:left;"> Add/Search</span> <input name="new_form"  style="width:150px;float:left;" type="text" id="typeaheadSFormSearch" placeholder="User Form" autocomplete="off" />&nbsp;<a href="#" id="NewSFormSubmit" style="width:15px;float:left;margin-left:10px;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Form"></i> </a> </div></div></li></ul>

                             <ul class="nav pull-right" style="margin-right:6px;">

       						   <li class="dropdown" id="Iface_popup">

                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" id="interfaceRefrence"><i class="icon-picture"></i></a>

                             <div class="dropdown-menu" id="drop_form" style="padding:14px;min-width:280px;">

                    <div style="float:left;">

                            <span style="width:80px;float:left;"> Add/Search</span> <input name="new_interface"  style="width:150px;float:left;" type="text" id="typeaheadIfaceSearch" placeholder="User Interface" autocomplete="off" />&nbsp;<a href="#" id="NewIfaceSubmit" style="width:15px;float:left;margin-left:10px;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Interface"></i> </a> </div></div></li></ul>

                            

                            

                            

                            <br />

                             <div class="custom_editable_textarea" id="text_text_div_1">

                            <?php echo Version::model()->wikiOutput($step->text,0); ?>

                            </div>

                            <?php echo $form->textArea($step, 'text', array('rows' => 3, 'cols' => 180, "style" => "width:500px;display:none;")); ?>

                            <?php echo $form->error($step, 'text'); ?>

                            <br />

                            

                            <b>Result</b>

                            <br>

                            <ul class="nav pull-right" style="margin-right:25px;">

       						   <li class="dropdown" id="SRule_popup2">

                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" id="SRuleRefrence2"><i class="icon-gears"></i></a>

                             <div class="dropdown-menu" id="srule_drop_form2" style="padding:14px;min-width:280px;">

                    <div style="float:left;">

                            <span style="width:80px;float:left;"> Add/Search</span> <input name="new_rule"  style="width:150px;float:left;" type="text" id="typeaheadSRuleSearch2" placeholder="Business Rule" />&nbsp;<a href="#" id="NewSRuleSubmit2" style="width:15px;float:left;margin-left:10px;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Rule"></i> </a> </div></div></li></ul>

                            

                            <ul class="nav pull-right" style="margin-right:6px;">

       						   <li class="dropdown" id="SForm_popup2">

                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" id="SFormRefrence2"><i class="icon-list-alt"></i></a>

                             <div class="dropdown-menu" id="SForm_form2" style="padding:14px;min-width:280px;">

                    <div style="float:left;">

                            <span style="width:80px;float:left;"> Add/Search</span> <input name="new_form"  style="width:150px;float:left;" type="text" id="typeaheadSFormSearch2" placeholder="User Form" />&nbsp;<a href="#" id="NewSFormSubmit2" style="width:15px;float:left;margin-left:10px;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Form"></i> </a> </div></div></li></ul>

                             <ul class="nav pull-right" style="margin-right:6px;">

       						   <li class="dropdown" id="Iface_popup2">

                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" id="interfaceRefrence2"><i class="icon-picture"></i></a>

                             <div class="dropdown-menu" id="drop_form2" style="padding:14px;min-width:280px;">

                    <div style="float:left;">

                            <span style="width:80px;float:left;"> Add/Search</span> <input name="new_interface"  style="width:150px;float:left;" type="text" id="typeaheadIfaceSearch2" placeholder="User Interface" />&nbsp;<a href="#" id="NewIfaceSubmit2" style="width:15px;float:left;margin-left:10px;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Interface"></i> </a> </div></div></li></ul>

                            

                          

                            

                            <br>

                           

                            <div class="custom_editable_textarea" id="result_text_div_2">

                             <?php echo Version::model()->wikiOutput($step->result,0); ?>

                            </div><br/>

                            <?php echo $form->textArea($step, 'result', array('rows' => 3, 'cols' => 180, "style" => "width:500px;display:none;")); ?>

                            <?php echo $form->error($step, 'result'); ?>

                            <?php $actors = Actor::model()->getProjectActors($project); ?><br>

                          <br />

                            <select name="Step[actor_id]">

                                <?php

                                foreach ($actors as $actor) {

                                    echo '<option value="' . $actor['actor_id'] . '"';

                                    if ($actor['actor_id'] == $usecase['actor_id'])

                                        echo 'selected';

                                    echo'>' . $actor['name'] . '</option>';

                                }

                                ?> 

                            </select><br>

                            <?php

                            echo CHtml::submitButton($step->isNewRecord ? 'Create' : 'Save');

                            $this->endWidget();

                            ?>

                            <?php

                            $key++;

                            if (isset($steps[$key])) {

                                ?>

                                <table style="width: 100%;">

                                    <tr>

                                        <td>  

                                            <?php if ($edit) { ?>

                                                <a href="<?php echo Yii::app()->getBaseUrl();  ?>/step/insert/id/<?php echo $steps[$key]['id'] ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Insert a new step"></i> Add Step</a>

                                            <?php } ?> 

                                        </td> 

                                    </tr>

                                </table>

                            <?php } ?>    

                        </td>

                        <td>

                            <table >

                                <tr>

                                    <td style="border-top:0px" id="StepInterfaceTd">

                                        <strong>Interfaces</strong><br />

                                        <?php $this->renderPartial("_interfaces", array('item' => $item, 'project' => $project)) ?>              

                                    </td> 

                                </tr>

                                <tr>

                                    <td id="StepRuleTd">

                                        <strong>Rules</strong><br />

                                        <?php $this->renderPartial("_rules", array('item' => $item, 'project' => $project)) ?>     

                                    </td>

                                </tr>

                                <tr>

                                    <td id="StepFormTd">

                                        <strong>Forms</strong><br />

                                        <?php $this->renderPartial("_forms", array('item' => $item, 'project' => $project)) ?>  

                                    </td>

                                </tr>

                            </table>

                        </td>

                        <?php

                    } ELSE { // THIS IS NOT THE EDIT ROW, SHOW THE RELATED IFACE AND RULES 

                        ?>

                        <?php $this->renderPartial("_steplistview", array('item' => $item, 'project' => $project, 'edit'=>$edit)) ?>     

                    <?php } ?>

                <?php endforeach ?>   

        </tbody>

    </table>

    <?php if ($edit) { ?>

        <a href="<?php echo Yii::app()->getBaseUrl();  ?>/step/create/id/<?php echo $model->id; ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Step</a> 

    <?php } ?>    

<?php endif; // end count of results   ?>

<?php if ($model->main != 1) { // THIS IS AN ALTERNATE FLOW So we show the main flow entry and exit ?>  

    <h4>Alternate Flow <?php echo $model->name; ?> Start and End Points</h4>

    <?php

    $steps = Step::model()->getMainSteps($usecase['id']); // get the requirements with answers

    if (count($steps)):

        ?>

        <table class="table">

            <tbody>

                <?php foreach ($steps as $item) : // Go through each un answered question?  ?>

                    <tr class="odd">

                        <td>   

                            <b><?php echo $item['flow']; ?>(<?php echo $item['number']; ?>):</b> <?php echo $item['text']; ?>

                        </td> 

                        <td>

                            <?php if ($item['step_id'] == $model->startstep_id) { // THIS IS Start step  ?>

                                Start

                            <?php } ELSE { ?>

                                <a href="<?php echo Yii::app()->getBaseUrl();  ?>/flow/updateendpoints/end/1/flow/<?php echo $model->id; ?>/id/<?php echo $item['step_id']; ?>"><i class="icon-chevron-right" rel="tooltip" title="Move the START of this flow here"></i></a> 



                            <?php } ?>

                            <?php if ($item['step_id'] == $model->rejoinstep_id) { // THIS IS Start step ?>

                                END  

                            <?php } ELSE { ?>

                                <a href="<?php echo Yii::app()->getBaseUrl();  ?>/flow/updateendpoints/end/2/id/<?php echo $item['step_id']; ?>/flow/<?php echo $model->id; ?>"><i class="icon-chevron-left" rel="tooltip" title="Move the END of this Flow Here"></i></a> 

                            <?php } ?>

                        </td>

                    <?php endforeach ?>   

            </tbody>

        </table>

    <?php endif; // end count of results   ?>

    <a href="<?php echo Yii::app()->getBaseUrl();  ?>/step/create/id/<?php echo $model->id; ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Step</a> 

<?php } ?>

<script type="text/javascript">

function wrap_div(div_id){

	$(div_id+" a").each(function(idx) {

  		data_id=$(this).attr('data-id');

		$(this).wrap('<span contentEditable="true" data-id="'+data_id+'"></span>');

		$url=$('a[data-id="'+data_id+'"]').attr('href');

		

		$(this).attr('class','tlink');

		$(this).attr('data-id',data_id);

		$(this).attr('data-url',$url);

		$(this).attr('onclick','return false;');

		

		

});

}



function parse_div_text(div_id)

{

	$(div_id+" span").each(function(idx) {

  		data_id=$(this).attr('data-id');

		$(this).replaceWith(data_id);

	});
	
	

	

	return $(div_id).text();

}


function parse_div_text2(div_id)

{

	$(div_id+" a.tlink").each(function(idx) {

  		data_id=$(this).attr('data-id');

		$(this).replaceWith(data_id);

	});
	
	

	

	return $(div_id).text();

}


$(document).ready(function(){

document.getElementsByClassName("custom_editable_textarea")[0].contentEditable='true'; 

document.getElementsByClassName("custom_editable_textarea")[1].contentEditable='true'; 



$('#drop_form,#srule_drop_form,#SForm_form,#drop_form2,#srule_drop_form2,#SForm_form2').click(function(e) {

    e.stopPropagation();

});







$('.custom_editable_textarea').popover({

	  html:true,

	  selector:'a.tlink',

	  placement:'bottom',

  	  trigger:'click',

	  content:'demo'

});





$('.custom_editable_textarea').on('shown.bs.popover','a.tlink',function(){

	   

var content='<a href="'+$(this).attr('data-url')+'" class="unlink_object" data-id="'+$(this).attr('data-id')+'" >Remove Link</a>';

$('.popover-content').html(content);

});





$(document).on('click','a.unlink_object',function(e){

								e.preventDefault();

								url=$(this).attr('href');

								data_id=$(this).attr('data-id');

								 $('span[data-id="'+data_id+'"]').remove();

								$.ajax({

									   type:'get',

									   url:url,

									   success:function(data){

										  

										   

									   }

									   });

							});

wrap_div("#text_text_div_1");

wrap_div("#result_text_div_2");

$("form#step-form").on('submit',function(){

										 $("textarea#Step_text").text(parse_div_text("#text_text_div_1"));

										 $("textarea#Step_result").text(parse_div_text("#result_text_div_2"));


 											$("textarea#Step_text").text(parse_div_text2("#text_text_div_1"));

										 $("textarea#Step_result").text(parse_div_text2("#result_text_div_2"));
										 
										 return true;

										 });



$("#text_text_div_1").on('mouseup keypress',function(){

	window.action_div_offset=echoRange("text_text_div_1");
});

$("#result_text_div_2").on('mouseup keypress',function(){

	window.result_div_offset=echoRange("result_text_div_2");

	

});

});

</script>