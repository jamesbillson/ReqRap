<?php 
$this->layout = "//layouts/print";
$project=Yii::App()->session['project'];
$packages = Package::model()->getPackages($project);
$heading=1;
$cats = Category::model()->getProjectCategory();
$thisrelease=Release::model()->findbyPK(Yii::App()->session['release']);
$model=Project::model()->findbyPK($project);

if($model->company->logo_id!=''){
    $src = Yii::app()->easyImage->thumbSrcOf(
    Yii::app()->params['photo_folder'].$model->company->logo_id, 
    array('resize' => array('width' => 150))); 
}

?>
<h1>Requirements Model</h1>

<h2> <?php echo $model->name;?></h2>

<h3> <?php echo $model->company->name;?></h3>
<h4><?php echo Release::$title_status[$thisrelease->status].' '.$thisrelease['number'];?> </h4>
<?php echo $thisrelease['create_date'];?>
<div style="height:200px;"></div>

<img src="<?php echo $src;?>">
<br />
<br />
<br />
<?php $this->renderPartial('/release/print',array('heading'=>$heading,'thisrelease'=>$thisrelease));

 ?>

<?php 

$section=0;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>

<?php 
$objects = Object::model()->getProjectObjects(Yii::app()->session['project']); 
if (count($objects)):
$this->renderPartial('/object/print',array('heading'=>$heading,'objects'=>$objects)); 
$heading++; 
endif;


$section=1;

    
         foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          
            }
          }

          
$actors = Actor::model()->getProjectActors(Yii::app()->session['project']);
 
              $this->generateTree($str, $actors, -1);
              
if (count($actors)):
$this->renderPartial('/actor/print',array('heading'=>$heading,
                                        'actors'=>$actors,
                                        'actorstring'=>$str)); 
$heading++; 
endif;
 

$section=2;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }

 
$numberucs=Version::model()->objectCount(10);
if ($numberucs>0): // check if there are any usecases
$packages = Package::model()->getPackages($project);
if (count($packages)):      
$this->renderPartial('/package/print',array('heading'=>$heading,'packages'=>$packages)); 
$heading++; 
endif;
endif;
          

$section=3;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>

<?php 


$rules = Rule::model()->getProjectRules($project);
if (count($rules)):

$this->renderPartial('/rule/print',array('heading'=>$heading,'project'=>$project, 'rules'=>$rules)); 
$heading++;
endif;


?>
<?php 

$section=4;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }

  $numberifaces=Version::model()->objectCount(12);        
          if(count($numberifaces)):
          $this->renderPartial('/iface/print',array('heading'=>$heading)); 

$heading++; 
endif;

$section=5;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }

          
          
$forms = Form::model()->getProjectForms(Yii::app()->session['project']);

if (count($forms)):

$this->renderPartial('/form/print',array('heading'=>$heading,'forms'=>$forms)); 
$heading++; 
endif;


$section=6;
        foreach($cats as $cat){
         if ($cat['order']>$section && $cat['order']<=1+$section){ 
          $this->renderPartial('/category/print',array('heading'=>$heading,'id'=>$cat['id']));   
          $heading++;
          }
          }
?>




