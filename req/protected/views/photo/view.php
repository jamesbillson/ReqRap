
<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases'));
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
 if(isset($model->id)): ?>

    
<?php      
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Interfaces',
    'headerIcon' => 'icon-picture',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
?>
    
    <table> 
         <?php if(isset($model->photo)): ?>
         <?php foreach($model->photo as $item): ?>
        <tr>
            <td>
                        <?php $src = Yii::app()->easyImage->thumbSrcOf(
                                    Yii::app()->params['photo_folder'].$item->file, 
                                    array('resize' => array('width' => 154))); ?>

                        <a href="<?php echo UrlHelper::getPrefixLink('/photo/view/id/')?><?php echo $item->id; ?>"> <img src="<?php echo $src ?>"/></a>
                      
                   </td>
                   <td>
                       <?php echo $item->description ?>
                   </td>
                     <td>
                      <?php if($edit){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/photo/update/id/')?><?php echo $item->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/photo/delete/id/')?><?php echo $item->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                          <?php } ?>
                   </td>
                <?php endforeach ?>
         
        </tr>
    </table> 
  <?php endif ?>
 
<?php endif ?>

    <?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.thumPro').hover(function(event){
            $(this).find('.delThumPro').show();
        },function(event){
            $(this).find('.delThumPro').hide();
        });

        $('.thumPro').not(':eq(0)').css('margin-left','0px');
        $('.thumPro').css('margin-right','10px');
    })


</script>
