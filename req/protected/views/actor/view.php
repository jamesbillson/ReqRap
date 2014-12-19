<?php 

$link=Yii::App()->session['release'].'_4_'.$model->actor_id;
echo $this->renderPartial('/project/head',array('tab'=>'actors','link'=>$link));
$permission=Yii::App()->session['permission']; 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
?>
<h2>
    Actor <?php echo $model->name; ?><a href="<?php echo UrlHelper::getPrefixLink('/actor/update/id/') ?><?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
    <select class="pull-right" name="mass_action" id="mass-action">
        <option value="0">Please Select</option>
        <option value="1"><?php echo ('Swap Actor') ?></option>
    </select>       
</h2>
<a href="<?php echo UrlHelper::getPrefixLink('/project/view/tab/actors/') ?>">Back to Actors</a><br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
        <br />
	<?php echo CHtml::encode($model->name); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
	<br />
            <?php echo CHtml::encode($model->description); ?>
        <br />
<b><?php echo CHtml::encode($model->getAttributeLabel('pretest')); ?>:</b>
	<br />
            <?php echo CHtml::encode($model->pretest); ?>

        <h4>Traceability</h4>
<?php 

$data = Actor::model()->getActorParentSteps($model->id);
if (count($data)){
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Uses',
    'headerIcon' => 'icon-film',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Usecase</th>
                   
                    
                    
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="<?php echo UrlHelper::getPrefixLink('/usecase/view/id/') ?><?php echo $item['usecaseid'];?>">UC-<?php echo str_pad($item['packagenumber'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['usecasenumber'], 3, "0", STR_PAD_LEFT); ?></a>
 <?php echo $item['usecasename'];?>
                    </td>
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
} ELSE {// end if any uses  ?>
<br />This actor has not been used for any use cases.
<?php  }?>

<?php 
 
$data = Actor::model()->getActorParentDefaultUC($model->actor_id);
if (count($data)){
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Default Actor',
    'headerIcon' => 'icon-film',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Usecase</th>
                   
                    
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="<?php echo UrlHelper::getPrefixLink('/usecase/view/id/')?><?php echo $item['usecase_id'];?>">UC-<?php echo str_pad($item['packagenumber'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a>
 <?php echo $item['name'];?>
                    </td>
                   
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
} ELSE {// end if any uses  ?>
<br />This actor has not been assigned as default actor to any usecases.
<?php  }?>


  <?php if($edit){ ?>

  
<h3>Version History</h3>    
        
   
        <?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
   <?php if (count($versions)){?>
        <?php foreach($versions as $item) {?>   
<div class="accordion-group">
        <div class="accordion-heading">
            <table>
                <tr>
                    <td>
                <?php if ($item['active'] != 1 && $item['action']!=3){    ?> 
                <a href="<?php echo UrlHelper::getPrefixLink('/version/rollback/id/')?><?php echo $item['versionid'];?>"><i class="icon-repeat" rel="tooltip" data-placement="right" title="Roll Back to this Version"></i></a> 
                <?php  } ELSE { ?> 
                <i class="icon-circle-arrow-right" rel="tooltip" data-placement="right" title="Current Version"></i> 
                <?php   } ?>  
               </td>
               <td>
                <a class="accordion-toggle" data-toggle="collapse"
               data-parent="#accordion<?php echo $item['ver_numb']; ?>" href="#collapse<?php echo $item['ver_numb']; ?>">
                Change #<?php echo $item['ver_numb']; ?> </a>
                </td>
                <td>
            
                <?php echo $item['create_date']; ?> 
                <?php echo $item['firstname'].' '.$item['lastname']; ?> 
                </td>
                <td> 
                Action:  <?php echo Version::$actions[$item['action']]; ?>   
                </td>
                </tr>
            </table>   
        </div>
        <div id="collapse<?php echo $item['ver_numb']; ?>" class="accordion-body collapse">
            <div class="accordion-inner">
                <strong><?php echo $item['name']; ?></strong><br />
                   <?php echo $item['description']; ?>
            </div>
        </div>
    </div>
  <?php } } ?>
<?php $this->endWidget(); 

  }?>
<input type="hidden" id="old-actor" value="<?php echo $model->actor_id ?>" />
<!-- Modal -->
<div class="modal fade" id="list-actor" tabindex="-1" role="dialog" aria-labelledby="list-actor-lable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Replace Actor</h4>
      </div>
      <div class="modal-body">
        <?php 
            $project_id= Yii::app()->session['project'];
            $actorModel = Actor::model()->findAll(
                array(
                    'condition' => 'actor_id != :actor_id && project_id = :project_id',
                    'params' => array(':actor_id' => $model->actor_id, ':project_id' => $project_id),
										'group' => 'actor_id'
                )
            );
            if ($actorModel == NULL) {
                echo 'Actor doesn\'t exists'; 
            } else {
            ?>
                <select id="actor-target">
                    <?php foreach($actorModel as $actor) {  ?>
                        <option value="<?php echo $actor->actor_id; ?>"><?php echo $actor['name'] ?></option>
                    <?php } ?>
                </select>  
            <?php
                
            }
            
        ?>
      </div>
      <div class="modal-footer">
        <button id="change-actor" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $('document').ready(function() {
        $('#mass-action').on('change',function(e) {
            if ($(this).val() == 1) {
                $('#list-actor').modal();
            }
            return false;
        });
        $('#change-actor').on('click',function(e) {
            e.preventDefault();
            var url = "<?php echo UrlHelper::getPrefixLink('actor/changeactor'); ?>";
            
            var old_actor = $('#old-actor').val();
            var new_actor = $( "#actor-target option:selected" ).val();
            var redirect_url = "<?php echo UrlHelper::getPrefixLink('actor/view/'); ?>";
            $.ajax(url+'/old/'+old_actor+'/new/'+new_actor)
                          .done(function() {
                            alert( "success" );
                            window.location.href =  redirect_url+'id/'+new_actor;
                          })
                          .fail(function() {
                            alert( "error" );
                            location.reload();
                          });
            return false;
        });
    });
</script>