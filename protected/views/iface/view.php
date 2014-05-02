
<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); ?>

<h2>Interface UI-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?> 
     <a href="/iface/update/ucid/-1/id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 

</h2>

<h3>   <?php echo $model->name;?> </h3>
Interface type: 
<?php foreach($types as $type):
 if($type['interfacetype_id']==$model->type_id)  echo $type['name']; 
endforeach;
?>
<br /><br />
<?php
//IF there is no photo
//Form to add photos
if ($model->photo_id==0)
    {
    //Show a form to pick one of the untaken images.
    //Need a query to find images not used.
    $orphans=Photo::model()->orphanPics();
    ?>
       Associate image with this interface<br /> 
<form action="/iface/addphoto" method="post">
        <input type="hidden" name="iface_id" value="<?php echo $model->id;?>">
        <select name="photo_id">
        <?php foreach ($orphans as $pic){  ?>
            <option value="<?php echo $pic['id']; ?>"><?php echo $pic['file']; ?></option>  
        <?php } ?>
        </select> 
        <input type="submit">
        </form>

        <?php } ELSE {
        
        $image=Photo::model()->findbyPK($model->photo_id);
        $src = Yii::app()->easyImage->thumbSrcOf(
                                    Yii::app()->params['photo_folder'].$image->file, 
                                    array('resize' => array('width' => 154))); ?>

                        <a href="/photo/view/id/<?php echo $image->id; ?>"> <img src="<?php echo $src ?>"/></a>

        <?php } ?> 
<br />
<br />
<br />
 <?php 
 $usecases=Usecase::model()->getLinkUsecase($model->id,12,15);
 if(!count($usecases)){
 ?>
 This Interface is not used.<br />
 Associate with Use Case
 <?php } ELSE { ?>
 Interface is used in the following UC's:<br />
   <?php foreach($usecases as $item){?>
 <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>">
       <?php  echo 'UC-'.str_pad($item['package_number'], 2, "0", STR_PAD_LEFT).
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

<?php echo $model->text;?>
