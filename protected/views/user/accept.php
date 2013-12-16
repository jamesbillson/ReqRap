<h1><?php echo $model->company->name; ?></h1>
<h2>Create an Account </h2>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>