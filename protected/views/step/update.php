
<h2>Use Case <?php echo $model->usecase->number; ?>: <a href="/usecase/view/id/<?php echo $model->usecase->id; ?>"><?php echo $model->usecase->name; ?></a></h2>
<h3>Update Step on <?php echo $model->name; ?> flow.</h3>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'step'=>$step)); ?>