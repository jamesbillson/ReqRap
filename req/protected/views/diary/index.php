<?php
/* @var $this DiaryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Diaries',
);

$this->menu=array(
	array('label'=>'Create Diary', 'url'=>array('create')),
	array('label'=>'Manage Diary', 'url'=>array('admin')),
);
?>

<h1>Diaries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
