
<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); ?>

<h2>Add interface images</h2>
  
<a href="/photo/list/">View all images</a>

<?php if(isset($model->id)): ?>
   
     <div class="row-fluid">
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
    
<?php endif; ?>

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
