<?php 
echo $this->renderPartial('/project/head'); 

?>
<h3>Create Manual Testcase</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>