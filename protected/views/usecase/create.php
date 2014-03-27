<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>
   <h3> 
 UC-<?php echo str_pad($package->number, 2, "0", STR_PAD_LEFT).''.str_pad($number, 3, "0", STR_PAD_LEFT);?>
</h3>
         
         <?php $this->renderPartial('_form', array('model'=>$model,  
                            'package'=>$package,
                            'number'=>$number,
                            )); ?>