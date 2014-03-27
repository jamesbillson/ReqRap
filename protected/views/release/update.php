

<h1>Update Rule BR-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?></h1>
<h2><?php echo $model->title; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model,'project'=>$project)); ?>