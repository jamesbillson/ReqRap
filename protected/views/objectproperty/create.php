<?php echo $this->renderPartial('/project/head'); 

$typename= ($type==1)? 'Property':'Relationship';
?>

<h3>Create An Object <?php echo $typename; ?> for <a href="/object/view/id/<?php echo $parentobject->object_id; ?>"><?php echo $parentobject->name; ?></a></h3>


<?php $this->renderPartial('_form', array('model'=>$model,'parentobject'=>$parentobject,'type'=>$type)); ?>