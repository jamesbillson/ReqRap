        <link rel="stylesheet" type="text/css" href="<?php Yii::app()->baseUrl?>/css/carousel.css">
        <script type="text/javascript" src="<?php Yii::app()->baseUrl?>/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="<?php Yii::app()->baseUrl?>/js/jcarousel.responsive.js"></script>
<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); ?>

<h2>Interface UI-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?> 
     <a href="/iface/update/ucid/-1/id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 

</h2>
<a href="/project/view/tab/interfaces">Back to Interfaces</a>
<h3>   <?php echo $model->name;?> </h3>
<strong>Interface type: </strong>
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

    $orphans=Photo::model()->orphanPics();
    if(count($orphans)){
    ?>   
Pick an image for this interface or upload a new one.<br />
            <div class="jcarousel-wrapper">
                <div class="jcarousel">

                    <ul>
                                        <?php foreach ($orphans as $pic){  ?>
                   <?php $src = Yii::app()->easyImage->thumbSrcOf(
 Yii::app()->params['photo_folder'].$pic['file'], 
 array('resize' => array('width' => 150,'height'=>150))); ?>
                        <li><a href="/iface/addimage/iface/<?php echo $model->iface_id; ?>/id/<?php echo $pic['photo_id']; ?>"  rel="tooltip" title="<?php echo $pic['description'] ?>" ><img src="<?php echo $src; ?>" border="0" width="150" height="150"></a></li>        
<?php 
 }

?>
                     </ul>
                </div>

                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>

                <p class="jcarousel-pagination"></p>
            </div>  
<?php }?>
<br />                     
    
<div class="row">
        <div class="span11">
            <?php //$photo = new Photo;
$this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'uploadFile',
        'config'=>array(
               'action'=>Yii::app()->createUrl("photo/singleupload",array('id'=>$model->project_id,'ifaceId'=>$model->iface_id)),
               'allowedExtensions'=>array("jpg", "jpeg", "gif", "png", "PNG", "JPG", "GIF", "JPEG"),//array("jpg","jpeg","gif","exe","mov" and etc...
               'sizeLimit'=>2*1024*1024,// maximum file size in bytes
               'onComplete'=>"js:function(){window.location.href='/iface/view/id/$model->iface_id' }",
            )));
?>

        </div>
        <?php } ELSE {

      $image=Photo::model()->findByPk(Version::model()->getVersion($model->photo_id,11));
      $src = Yii::app()->easyImage->thumbSrcOf(
                                    Yii::app()->params['photo_folder'].$image->file, 
                                   array('resize' => array('width' => 150,'height'=>150))); ?>
    <div style="float:left;width:100%;">
      <div style="width:160px;float:left;">
        <img src="<?php echo $src ?>"/>
      </div>
      <div style="float:left;margin-top: 50px;">
        <a href="<?php echo Yii::app()->baseUrl?>/iface/update/ucid/0/id/<?php echo $model->id;?>"><i class="icon-remove-sign" rel="tooltip" title="Remove"></i>Remove</a> <br />
    <a href="<?php echo Yii::app()->baseUrl?>/photo/update/id/<?php echo $image->id;?>"><i class="icon-edit" rel="tooltip" title="Remove"></i>Edit</a> 
    
    
      </div>
      
    </div>
<br />
<?php echo $image->description; ?>
                        
                    
        <?php } ?> 

<br />
<br /> </div>
<div class="row">
 <?php 
 $data=Usecase::model()->getLinkUsecase($model->iface_id,12,15);
 if(count($data)==0){
 ?>
    
    <h3><i class="icon-exclamation-sign text-warning" style="position: relative; 
             top: 8px;padding-right:10px;" rel="tooltip" "></i> This Interface is not used.<br />
 </h3>
        
        <?php 
echo $this->renderPartial('_associate',array('id'=>$model->iface_id)); ?>

</div>
     
     <?php } ELSE { ?>
    <h4>Traceability</h4>
<?php 

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
                        <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>">UC-<?php echo str_pad($item['package_number'], 2, "0", STR_PAD_LEFT); ?>
                            <?php echo str_pad($item['usecase_number'], 3, "0", STR_PAD_LEFT); ?></a>
                        <?php echo $item['usecase_name'];?>
                    </td>
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
  }
 }?>
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
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.thumPro').hover(function(event){
            $(this).find('.delThumPro').show();
        },function(event){
            $(this).find('.delThumPro').hide();
        });

        $('.thumPro').not(':eq(0)').css('margin-left','0px');
        $('.thumPro').css('margin-right','10px');
        
        $('body').bind('progress', function(data) {
            alert('falied upload');
        });
    })


</script>