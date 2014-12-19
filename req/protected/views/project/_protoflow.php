   
            <?php       
           // print_r($ucDef);
            $project=Yii::App()->session['project'];
           
            ?>
 <style>
  .flowSteps { list-style-type: none; margin: 0; padding: 0; float:left; min-height:70px; }
 .flowSteps li {  padding: 1px; float: left; text-align: center; cursor:move; }
 .new-line {clear:both!important;margin-left:0px!important;}
  .flowSteps li.not_sortable{ cursor:pointer;}
 </style>             
   
<?php

/*echo "<pre>";
print_r($ucDef);
echo "</pre>";*/
//#######################################################################

class FakeName
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
 
    public function getAttributeLabel()
    {
        return 'Name';
    }
    
    public function getScenario() {
    	return 'update';
    }
}

class FakeDescription
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
 
    public function getAttributeLabel()
    {
        return 'Description';
    }
    
    public function getScenario() {
    	return 'update';
    }
}


class FakeActor
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
    public function getAttribute($attr)
    {
        return $attr;
    }
    public function getAttributeLabel()
    {
        return 'Actor';
    }
    
    public function getScenario() {
    	return 'update';
    }
}



class FakePackage
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
    public function getAttribute($attr)
    {
        return $attr;
    }
    public function getAttributeLabel()
    {
        return 'Package';
    }
    
    public function getScenario() {
    	return 'update';
    }
}


?>
<div class="row-fluid">
        <div class="span4">
           
  <?php           

$title = new FakeName;
$title->myid = 1;
$title->myattr = $ucDef['name'];
 echo '<h4>';
$this->widget(
    'bootstrap.widgets.TbEditableField',
    array(
        'type' => 'text',
        'placement' => 'right',
        'model' => $title,
        'attribute' => 'myattr',
        'url' => 'protoNameSet', //url for submit data
    )
);

echo '</h4></div><div class="span8">';
$descrip = new FakeDescription;
$descrip->myid = 2;
$descrip->myattr = $ucDef['description'];
 
$this->widget(
    'bootstrap.widgets.TbEditableField',
    array(
        'type' => 'text',
        'model' => $descrip,
        'attribute' => 'myattr',
        'placement' => 'right',
        'url' => 'protoDescriptionSet', //url for submit data
    )
);

?>
             </div>       
            
     </div>
     
 <div class="row-fluid">
         <div class="span4">
            Actor <?php
    $actorselect = new FakeActor;
    $actorselect ->myid = 3;
    $actorselect ->myattr = $ucDef['actor_id'];
             
             $this->widget('editable.EditableField', array(
            'type'      => 'select2',
            'model'     => $actorselect,
            'attribute' => 'myattr',
            'url'       => $this->createUrl('protoActor'), 
            'source'    => Editable::source(Actor::model()->getProjectActors(), 'actor_id', 'name'),
            'placement' => 'right',
    ));
             
             ?>
         </div>
         <div class="span8"> 
                     Package <?php
    $packageselect = new FakePackage;
    $packageselect ->myid = 4;
    $packageselect ->myattr = $ucDef['package_id'];
             
             $this->widget('editable.EditableField', array(
            'type'      => 'select2',
            'model'     => $packageselect,
            'attribute' => 'myattr',
            'url'       => $this->createUrl('protoPackage'), 
            'source'    => Editable::source(Package::model()->getPackages(), 'package_id', 'name'),
            'placement' => 'right',
    ));
             
             ?>
         </div>
     </div>    
<div  class="row-fluid thumbnail">   
     
     
    <?php 
	
    // $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
    // $ucDef['flow'][$flowNum]['step'][$stepNum]['resultname']
    // $ucDef['flow'][$flowNum]['step'][$stepNum]['resulttext']
    // LOOP THRU FLOWS
	$flow=	reset ($ucDef['flow']);
    ?>
   
<div class="row-fluid"> 
   
      <?php echo $flow['name'];  ?>
       <a href="#" id="AddStepObject" class="icon-plus-sign icon-3x pull-right" rel="tooltip" data-original-title="Add Step/Interface"><i></i></a>
   
</div>
<div class="row-fluid">
    <ul class="flowSteps row-fluid">           
                <?php  
				$total_step=count($flow['step']);
				$stepCounter=0;
                foreach($flow['step'] as $s_index=>$step){ 
				$class='';
				$new_line=0;
				if($stepCounter%4==0)
				{
					$class='new-line';
					$new_line=1;
					
				}
               $types=array(2=>'warning',12=>'info');
                ?>
        <li class="span3 <?php echo $class; ?>" data-index="<?php echo $s_index; ?>">
       
        <div class="row-fluid">
        
        <div class="span3">
      <a href="#" class="" rel="tooltip"
         data-title="<?php echo Version::model()->wikiOutput($step['action'],1);?>">
                <span class="badge badge-success" style="font-size:14px;">A</span>
            </a>
            </div>
            <div class="span3" style="text-align:center;"><span><i class="icon-long-arrow-right icon-2x text-info"></i></span></div>
            <div class="span6">
             <a href="#" class="pull-right removeStep" rel="tooltip" data-original-title="Remove Step" data-index="<?php echo $s_index; ?>" ><i class="icon-remove-sign"></i></a>
            <a href="#" class="thumbnail" style="text-align:center;" rel="tooltip" data-title="<?php  
               echo Version::model()->wikiOutput($step['resulttext'],1);?>">
                  <span style=" text-align:center">
                  <?php if($step['resulttype']==2){ ?>
                  <i class="icon-file-text icon-4x" style="color:#f89406;"></i>
                  <?php }else { ?>
                  <i class="icon-file icon-4x"></i>
                  <?php } ?>
                  <br />
                  <?php  
				  echo $step['resultname'];
                 /*$this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>$types[$step['resulttype']],
                'label'=>$step['resultname'],
                )); */
                 ?> </span> 
               </a>
      
       <?php
        // $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
     if (isset($step['rule'])) {
          
      foreach($step['rule'] as $rule){ ?>
      <br>
          <a href="#" class="thumbnail" rel="tooltip" data-title="<?php  
               echo $rule['name'];?>">
            <?php   
                  $this->widget('bootstrap.widgets.TbBadge', array(
                  'label'=>'rule '.$rule['number'],
                  )); 

             ?>
          </a>
            <?php
            }
     }
            ?>  
        </div></div></li>
        <?php 
		$stepCounter++;
	 }  ?>
     
  </ul> </div>  
        <?php  
		 ?>
</div>         
     
 
   <?php 
   $save=($ucDef['actor_id']!=-1 && $ucDef['package_id']!=-1)?true:false;
   $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Save',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
       //'visible'=>$save,
    'url'=>array('project/protoflowsave')
));
     /* $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Save',
    'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
          'visible'=>!$save,
    'url'=>array('project/prototype')
));*/
   $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Clear',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
       
    'url'=>array('project/protoflowclear')
));

    ?>
    
<div id="StepObjectAddModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Add Form" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Add Step/Interface</h3>
  </div>
  <div class="modal-body">
  <form id="StepObjectForm" method="post" action="<?php echo Yii::app()->getBaseUrl();  ?>/form/create/uc/-1/id/<?php //echo $project; ?>">
  		<label class="required" for="Object_type">Object Type <span class="required">*</span></label>
        <select id="StepObjectType" name="object_type">
        <option value="12">Interface</option>
        <option value="2">Form</option>
        </select>	
   		<label class="required" for="Form_name">Name <span class="required">*</span></label>
        <input type="text" value="" id="StepObjectName" name="name" maxlength="255" size="60">															 
  </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" id="saveObjectStep" >Save</button>
  </div>
</div>    
<script type="text/javascript">

$(document).ready(function(){
function add_newClass()
{
	$(".flowSteps > li").removeClass('new-line');
	
	$(".flowSteps li").each( function(index){
									 
									  if(index%4==0)
									  {
										  $(this).addClass('new-line');
									  }
									  $(this).attr('data-index',index);
									   $(this).find("a.removeStep").attr('data-index',index);
								
									});
}

function re_arrange_steps(new_index,old_index)
{
	$.ajax({
		   type:'GET',
		   url:"<?php echo Yii::app()->getBaseUrl();  ?>/project/RearrangeProtoSteps/new_index/"+new_index+"/old_index/"+old_index,
		   success: function(data){
		   }
		   });
}

function add_step(id,type,index)
{
	$.ajax({
		   type:'GET',
		   url:"<?php echo Yii::app()->getBaseUrl();  ?>/project/ProtoFlowIfaceAdd/id/"+id+"/type/"+type+"/step_index/"+index,
		   success: function(data){
		   }
		   });
}

function getStepHtml($objhtml,li_index)
{
	$l_html=$objhtml.html();
	$type=$objhtml.attr('data-type');
	if($type==12)
	{
		$ifacetype=$objhtml.attr('data-ifacetype');
		$objhtml.clone().appendTo("#Ifacetype_"+$ifacetype);
		$("#Ifacetype_"+$ifacetype).sortable( "refresh" );
	}else if($type==2)
	{
		$objhtml.clone().appendTo("#ObjectFormList");
		$("#ObjectFormList").sortable( "refresh" );
		
	}
	$html=' <div class="row-fluid"><div class="span3"><a href="#" class="" rel="tooltip" data-title="Undefined Action"><span class="badge badge-success" style="font-size:14px;">A</span></a></div><div class="span3" style="text-align:center;"><span><i class="icon-long-arrow-right icon-2x text-info"></i></span></div><div class="span6"><a href="#" class="pull-right removeStep" rel="tooltip" data-original-title="Remove Step" data-index="'+li_index+'" ><i class="icon-remove-sign"></i></a>'+$l_html+'</div></div>';
	return $html;
}

$(".flowSteps").on('click','li  a.removeStep',function(e){
													   e.preventDefault();
													   index=$(this).attr('data-index');
													   $.ajax({
		   												type:'GET',
		   											    url:"<?php echo Yii::app()->getBaseUrl();  ?>/project/RemoveProtoSteps/index/"+index,
		   												success: function(data){
																$('.flowSteps li[data-index="'+index+'"]').remove();
																add_newClass();
																
																
															}
		   											 });
													   
											});

$(".flowSteps").sortable({
	  //connectWith: ".connectedSort",
	  cursor: 'move',
	  cancel:".not_sortable",
	  dropOnEmpty : true,
	  start : function(event,ui){
		ui.item.removeClass('new-line');  
	  },
	  update :function(event,ui){
		  index=ui.item.index();
		  old_index=ui.item.attr('data-index');
		  if(old_index)
		  {
			  new_index=index;
			  re_arrange_steps(new_index,old_index);
		  }else
		  {
			  id=ui.item.attr('data-Oid');
			  type=ui.item.attr('data-type');
			  add_step(id,type,index);
			 
			  $html=ui.item.html();
			  $html=getStepHtml(ui.item,index);
			  ui.item.addClass('span3');
			  ui.item.attr('data-index',index);
			  ui.item.html($html);
		  }
		  add_newClass();
		  
	  }
	  
	  
	  
	  });

	$("a#AddStepObject").on('click',function(e){
											 e.preventDefault();
											 $("#StepObjectAddModal").modal('show');
											 
											 });
	$("#saveObjectStep").on('click',function(e){
								e.preventDefault();
								//url=$("#ObjectForm").attr('action');
								if($.trim($("#StepObjectName").val()))
								{
								$type=$("#StepObjectType").val();
								name=$("#StepObjectName").val();
								if($type==12)
								{
									url= '<?php echo Yii::app()->getBaseUrl();  ?>/iface/create/';
									data={"Iface[interfacetype_id]":1,"Iface[photo_id]":0,"Iface[name]":name};
									
								}else if($type==2)
								{
									url= '<?php echo Yii::app()->getBaseUrl();  ?>/form/create/uc/-1/id/<?php echo $project; ?>';
									data={"Form[project_id]":'<?php echo $project; ?>',"Form[name]":name};
								}
								$.ajax({
									   type:'POST',
									   url:url,
									   data:data,
									   success:function(data){
										   data=$.parseJSON(data);
										   $("#StepObjectAddModal").modal('hide');
										   location.href='<?php echo Yii::app()->getBaseUrl();  ?>/project/protoflowifaceadd/id/'+data.id+'/type/'+$type;
									   }
									   });
								}else
								{
									alert('Please enter Form name');
								}
						});
		 });

</script>

