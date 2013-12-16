<?php if(isset($model->id)): ?>
    <p><strong>More Photos:</strong></p>
    <?php $thumb = new Photo; ?>

    <div class="row-fluid">
        <div class="well span10 offset1">
            <?php
            $this->widget(
                'bootstrap.widgets.TbThumbnails',
                array(
                    'id'=>'photo',
                    'dataProvider' => $thumb->thumbSearch($model->id,-1),
                    'template' => "{items}\n{pager}",
                    'itemView' => '_image_update_ajax',
                )
            );?>
        </div>
    </div>
    <div class="row-fluid">
        <label><strong>Upload More Photos:</strong></label>
        <div class="span11">
            <?php $this->widget('bootstrap.widgets.TbFileUpload', array(
                'url' => Controller::createUrl("diary/upload",array('id'=>$model->id),'no-temp'),
                'model' => $model,
                'attribute' => 'picture', // see the attribute?
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
        $('#photo li').not(':eq(0)').css('margin-left','0px');
    })
</script>
