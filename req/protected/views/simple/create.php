<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details'));

$permission=(Yii::App()->session['permission']==1)?true : false; 
?>
<h3>Create A Simple Requirement</h3>

<?php 
if (isset($edit)){
$this->renderPartial('_form', array('model'=>$model,'category_id'=>$category_id,)); 
}
?>