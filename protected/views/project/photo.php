<?php if(isset($model->id)): ?>
    <p><strong>More Photos:</strong></p>

    <div class="row-fluid">
        <div class="well span12">
            <?php if(isset($model->photo)): ?>
                <?php foreach($model->photo as $item): ?>
                    <div class="span3 thumPro" data-photo-id="<?php echo $item->id ?>">
                        <?php $src = Yii::app()->easyImage->thumbSrcOf(
                                    Yii::app()->params['photo_folder'].$item->file, 
                                    array('resize' => array('width' => 154))); ?>

                        <a href="/photo/view/id/<?php echo $item->id; ?>"> <img src="<?php echo $src ?>"/></a>
                      
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    <div class="row-fluid">
        <label><strong>Upload More Photos:</strong></label>
        <div class="span11">
            <?php $photo = new Photo;

            $this->widget('bootstrap.widgets.TbFileUpload', array(
                'url' => Controller::createUrl("photo/upload",array('id'=>$model->id)),
                'formView'=>'bootstrap.views.fileupload._myform',
                'model' => $photo,
                'attribute' => 'file', // see the attribute?
                'multiple' => true,
                'options' => array(
                    'maxFileSize' => 2000000,
                    'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
            ))); ?>

        </div>
    </div>
<?php endif ?>

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
