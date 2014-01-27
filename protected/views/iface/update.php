<h1>Update Iface</h1> 
<h2>  UI-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?>
                 <?php echo $model->name; ?></h2>
<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>