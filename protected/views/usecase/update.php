
<h3>Update Usecase "<?php echo $model->name; ?>"</h3>

<?php $this->renderPartial('_form', array('model'=>$model,
                                'id'=>$id,'package_id'=>$package_id,
                                'number'=>$number,
                                'packnum'=>$packnum)); ?>