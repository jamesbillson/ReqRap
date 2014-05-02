<?php 
$this->layout = "//layouts/print";
$project=Yii::App()->session['project'];
$packages = Package::model()->getPackages($project);
$heading=0;
$cats = Category::model()->getProjectCategory();

$model=Project::model()->findbyPK($project);


?>
<h1>Requirements Model</h1>

<h2> <?php echo $model->name;?></h2>

<h3> <?php echo $model->company->name;?></h3>
<?php $this->renderPartial('/release/print',array('heading'=>$heading));

 ?>

<?php 
$heading++; 
$section=0;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>

<?php $this->renderPartial('/object/print',array('heading'=>$heading)); 
 ?>
<?php 
$heading++; 
$section=1;

    
         foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          
            }
          }
 ?>
  







<?php $this->renderPartial('/actor/print',array('heading'=>$heading)); 
 ?>
<?php 
$heading++; 
$section=2;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>




<?php $this->renderPartial('/package/print',array('heading'=>$heading,'project'=>$project)); 
 ?>
<?php 
$heading++; 
$section=3;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>

<?php $this->renderPartial('/rule/print',array('heading'=>$heading,'project'=>$project)); 
 ?>
<?php 
$heading++; 
$section=4;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>




<?php $this->renderPartial('/iface/print',array('heading'=>$heading)); 
 ?>
<?php 
$heading++; 
$section=5;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>


<?php $this->renderPartial('/form/print',array('heading'=>$heading)); 


$heading++; 
$section=6;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>




