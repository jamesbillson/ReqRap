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
       // array('label'=>'Labels with no vintages', 'icon'=>'th', 'url'=>'/labels/reportnovint'),
       array('label'=>'Active Wine Samples', 'icon'=>'th', 'url'=>'/sample/reportactive'),
 
        array('label'=>'TBA', 'icon'=>'th', 'url'=>''),
     
        
        
    ),
)); ?>

