

<h1>Change Log</h1>
        <h2><a href="/project/project/<?php echo $model->id; ?>"><?php echo $model->name; ?></a></h2>
<table>
    

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
    
</table>