<?php 
$image=Iface::model()->getCurrentImage($model->iface_id,$release);

     if(!empty($image)){
     $src = Yii::app()->easyImage->thumbSrcOf(
     Yii::app()->params['photo_folder'].$image['file'], 
     array('resize' => array('width' => 500)));

?>
<img width="500px" alt="" src="<?php echo $src;?>">
<?php
} 
?>
<br />
<?php echo $model->text;?>
