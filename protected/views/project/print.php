<?php 
$this->layout = "//layouts/print";
$project=Yii::App()->session['project'];
$packages = Package::model()->getPackages($project);
$heading=1;


$model=Project::model()->findbyPK($project);


?>
<h1>Requirements Model</h1>

<h2> <?php echo $model->name;?></h2>

<h3> <?php echo $model->company->name;?></h3>
<?php $this->renderPartial('/release/print',array('heading'=>$heading)); 
 ?>

 <?php
// make an array of all the topic headings, insert in the categories
// loop through the array poking the object names in as we go.
?>

<?php $this->renderPartial('/object/print',array('heading'=>$heading)); 
 ?>
<?php $heading++; ?>
  

<?php $this->renderPartial('/category/print',array('heading'=>$heading)); 
 ?>
<?php $heading++; ?>

<?php $this->renderPartial('/actor/print',array('heading'=>$heading)); 
 ?>
<?php $heading++; ?>




<?php $this->renderPartial('/package/print',array('heading'=>$heading,'project'=>$project)); 
 ?>
<?php $heading++; ?>

<?php $this->renderPartial('/rule/print',array('heading'=>$heading,'project'=>$project)); 
 ?>
<?php $heading++; ?>




<?php $this->renderPartial('/iface/print',array('heading'=>$heading)); 
 ?>
<?php $heading++; ?>


<?php $this->renderPartial('/form/print',array('heading'=>$heading)); 
 ?>




