<?php
/* @var $this ChangelogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Changelogs',
);

$this->menu=array(
	array('label'=>'Create Changelog', 'url'=>array('create')),
	array('label'=>'Manage Changelog', 'url'=>array('admin')),
);
?>

<h1>Changelogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
