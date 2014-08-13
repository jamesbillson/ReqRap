<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>

 


<h3>Add Project to Library</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>