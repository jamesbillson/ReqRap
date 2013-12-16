<?php
/* @var $this DocumentController */
/* @var $model Document */


?>

<h3>Create New Document - "<?php echo $project->name ?>" Project</h3>

<?php echo $this->renderPartial('_form', compact('model','project','version')); ?>