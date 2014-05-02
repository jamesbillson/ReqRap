<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>

<h3>Create An Object Property for <a href="/object/view/id/<?php echo $parentobject->object_id; ?>"><?php echo $parentobject->name; ?></a></h3>


<?php $this->renderPartial('_form', array('model'=>$model,'parentobject'=>$parentobject,)); ?>