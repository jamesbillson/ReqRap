<?php 
echo $this->renderPartial('/project/head',array('tab'=>'interfaces')); 
$permission=Yii::App()->session['permission'];
    ?>
<h3>Create Interface</h3>

<?php 
if($permission) $this->renderPartial('_form', array('model'=>$model)); 
?>