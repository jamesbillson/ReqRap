<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name),
)); ?>

<?php $this->endWidget();



//Add a new Wine Note



 $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'My Company', 'icon'=>'pencil', 'url'=>array('company/mycompany')),
        
          
    ),
));
 
 
 
  if (Yii::app()->user->checkAccess('editor')) // itemName = name of the operation
{
 
 $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
      array('label'=>'Trades', 'icon'=>'pencil', 'url'=>array('trade/admin')),
      
         
    ),
));
}
 
 if (Yii::app()->user->checkAccess('users')) // itemName = name of the operation
{

     $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
     array('label'=>'Users', 'icon'=>'pencil', 'url'=>array('User/admin')),  
     array('label'=>'Authorisation', 'icon'=>'check', 'url'=>array('/?r=auth')),
       
    
    ),
)); 
     
     
     
     
}
 
 ?>

