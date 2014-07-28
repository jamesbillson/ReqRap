<?php
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 
?>
<table>  

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
    
</table>