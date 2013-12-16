<li class="span6 listDiff"> 
    <form class="updateImgAjax row-fluid">
        <a href="#" class="thumbnail span4" style="float:left" rel="tooltip" data-title="<?php echo isset($data['caption'])?$data['caption']:'default' ?>">             
            <?php 
                $link = Yii::getPathOfAlias("webroot").Yii::app()->params['differenceImg_folder'].'thumbs/'.$data['file'];

                if(!file_exists($link)){
                    $link = Yii::getPathOfAlias("webroot").Yii::app()->params['differenceImg_folder'].'/default.png';
                }
            ?>

            <?php $src = Yii::app()->easyImage->thumbSrcOf(
                                        $link, 
                                        array('crop' => array('width' => 100, 'height' => 100))); ?>
            <img src="<?php echo $src ?>" 
                  alt="<?php echo isset($data['caption'])?$data['caption']:'default' ?>" />
        </a>
        
        <div class="span8">
            <?php echo CHtml::hiddenField('DifferenceImages[id]', $data['id']); ?>
            <div class="row-fluid clear-fix">
                <?php echo CHtml::label('Alt:','DifferenceImages[alt]',array('class'=>'span3','style'=>'text-align:right;margin:5px 3px;')) ?>
                <?php echo CHtml::textField('DifferenceImages[alt]', $data['alt'],array('class'=>'span7')); ?>
            </div>
            <div class="row-fluid clear-fix">
                <?php echo CHtml::label('Caption:','DifferenceImages[caption]',array('class'=>'span3','style'=>'text-align:right;margin:5px 3px;')) ?>
                <?php echo CHtml::textField('DifferenceImages[caption]', $data['caption'],array('class'=>'span7')); ?>
            </div>
            <div class="row-fluid clear-fix">
                <?php echo CHtml::label('Status:','DifferenceImages[status]',array('class'=>'span3','style'=>'text-align:right;margin:5px 3px;')) ?>
                <?php echo CHtml::dropDownList('DifferenceImages[status]', $data['status'], DifferenceImages::listStatus(),array('class'=>'span5')); ?>
            </div>
            <div class="loadingAjax" style="display:none"></div>
            <div class="successAjax" style="display:none"></div>
        </div>
        <?php echo CHtml::button('save',array('type'=>'button','onclick'=>'saveImage(this)','class'=>'btn btn-info pull-right saveBtn')) ?>
        <?php echo CHtml::button('delete',array('type'=>'button','onclick'=>'deleteAjax(this)','class'=>'btn btn-danger pull-right deleteBtn','confirm'=>'are you sure delete this image')) ?>
    </form>
</li>
<script type="text/javascript">
    function saveImage(obj){
        $(obj).parent().find('.loadingAjax').show();

        $.ajax({
            type: "POST",//get or post
            data: $(obj).parent().serialize(),
            url: '<?php echo Controller::createUrl("differenceImages/ajaxSave",array(),"no-temp")?>',
            success: function(data) {
                $(obj).parent().find('.loadingAjax').hide();
                $(obj).parent().find('.successAjax').show();
                setTimeout(function() {
                    $(obj).parent().find('.successAjax').hide();
                }, 3000);
            },
            error: function(data) { 
                alert('error');
            }       
        });
    }
    
    function deleteAjax(obj){
        var $that = $(obj);
        $.ajax({

            type: "POST",//get or post
            data: $(obj).parent().serialize(),
            url: '<?php echo Controller::createUrl("differenceImages/ajaxDelete",array(),"no-temp")?>',
            success: function(data) {
                $that.parent().parent().fadeOut();
            },
            error: function(data) { 
                alert('error');
            }       
        });
    }
</script>