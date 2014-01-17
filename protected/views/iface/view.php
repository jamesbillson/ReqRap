
<h1><a href="/project/view/tab/interfaces/id/<?php echo $model->project->id;?>"><?php echo $model->project->name;?></a></h1>
<h2>View Iface     UI-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?>
                  </h2>

                   <h3>   <?php echo $model->name;?> </h3>
<?php echo $model->type->name;?> <br /><br />

 <?php 
 $stepiface=(Stepiface::model()->findAll('iface_id='.$model->id));
 if(!count($stepiface)){
 ?>
 This Interface is not used.<br />
 Associate with Use Case
 <?php } ELSE { ?>
 Interface is used in the following UC's:<br />
   <?php foreach($stepiface as $item){?>
 <a href="/usecase/view/id/<?php echo $item->step->flow->usecase->id;?>">
       <?php  echo 'UC-'.str_pad($item->step->flow->usecase->package->sequence, 2, "0", STR_PAD_LEFT).
         str_pad($item->step->flow->usecase->number, 3, "0", STR_PAD_LEFT);?>
 </a>
         <?php echo $item->step->flow->usecase->name;?> 
            (<a href="/step/update/id/-1/flow/<?php echo $item->step->flow->id;?>"><?php echo $item->step->flow->name;?> Flow</a>)
         

 <?php } ?>
 <?php } ?>
<br />
<?php 
if(!empty($model->file)){
$src = Yii::app()->easyImage->thumbSrcOf(
                                    Yii::app()->params['photo_folder'].$model->file, 
                                    array('resize' => array('width' => 154)));
?>
<img src="<?php echo $src;?>">
<?php
} 
?>
