
<h1><a href="/project/view/tab/interfaces/id/<?php echo $model->project->id;?>"><?php echo $model->project->name;?></a></h1>
<h2>View Iface     UI-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?>
                  </h2>

                   <h3>   <?php echo $model->name;?> </h3>
Interface type: <?php echo $model->type->name;?> <br /><br />

 <?php 
 $usecases=Usecase::model()->getIfaceUsecase($model->id);
 if(!count($usecases)){
 ?>
 This Interface is not used.<br />
 Associate with Use Case
 <?php } ELSE { ?>
 Interface is used in the following UC's:<br />
   <?php foreach($usecases as $item){?>
 <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>">
       <?php  echo 'UC-'.str_pad($item['package_sequence'], 2, "0", STR_PAD_LEFT).
         str_pad($item['usecase_number'], 3, "0", STR_PAD_LEFT);?>
 </a>
         <?php echo $item['usecase_name'];?> 
            (<a href="/step/update/id/-1/flow/<?php echo $item['flow_id'];?>"><?php echo $item['flow_name'];?> Flow</a>)
         

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
