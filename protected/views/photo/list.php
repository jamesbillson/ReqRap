
<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 
$images=Photo::model()->getProjectImages();
$permission=Yii::App()->session['permission'];
    ?>

<a href="/project/view/tab/interfaces">Back to Interfaces</a>
<?php      
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Images',
    'headerIcon' => 'icon-picture',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
?>
    
    <table> 
         <?php if(count($images)): ?>
         <?php foreach($images as $image): ?>
        <tr>
            <td>
                        <?php $src = Yii::app()->easyImage->thumbSrcOf(
                                    Yii::app()->params['photo_folder'].$image['file'], 
                                    array('resize' => array('width' => 154))); ?>

                        <a href="/photo/view/id/<?php echo $image['id']; ?>"> <img src="<?php echo $src ?>"/></a>
                      
                   </td>
                   <td>
                       <?php echo $image['description'] ?>
                   </td>
                     <td>
                      <?php if($permission){ ?>
                        <a href="/photo/update/id/<?php echo $image['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/photo/delete/id/<?php echo $image['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                          <?php } ?>
                   </td>
                <?php endforeach ?>
         
        </tr>
    </table> 
 
 

    <?php $this->endWidget(); ?>
 <?php endif ?>