<?php 
echo $this->renderPartial('/project/head'); 

?>

<h3>Update Teststep</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>