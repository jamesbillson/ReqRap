


 

<h3>Details
   <a href="<?php echo UrlHelper::getPrefixLink('/company/update/')?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
</h3>

<strong><?php echo $model->name; ?></strong>
<br /><br />
<?php echo $model->description; ?>    
<br /><br />
    <?php 
 if($model->logo_id!=''){
    $src = Yii::app()->easyImage->thumbSrcOf(
    UrlHelper::getPath($model->logo_id), 
    array('resize' => array('width' => 150,'height'=>150))); 
    
    
 echo '<img src="'.$src.'">';   
 } ELSE {
     
     echo '<strong>No Logo Uploaded</strong>';
           //$photo = new Photo;
$this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'uploadFile',
        'config'=>array(
               'action'=>Yii::app()->createUrl("/company/logoupload",array('id'=>$model->id)),
               'allowedExtensions'=>array("jpg", "jpeg", "gif", "png", "PNG", "JPG", "GIF", "JPEG"),//array("jpg","jpeg","gif","exe","mov" and etc...
               'sizeLimit'=>2*1024*1024,// maximum file size in bytes
            'onComplete'=>"js:function(){window.location.href='/company/update/id/$model->id' }",
            )));
 }
?>
