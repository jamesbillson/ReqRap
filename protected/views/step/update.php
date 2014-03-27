<?php echo $this->renderPartial('/project/head',array('tab'=>'usecase')); ?>
<h2>Use Case UC-
    <?php echo str_pad($model->usecase->package->number, 2, "0", STR_PAD_LEFT); ?>
    <?php echo str_pad($model->usecase->number, 3, "0", STR_PAD_LEFT); ?>
    : <a href="/usecase/view/id/<?php echo $model->usecase->usecase_id; ?>"><?php echo $model->usecase->name; ?></a></h2>
<h3>Update Step on <?php echo $model->name; ?> flow.</h3>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'step'=>$step)); ?>