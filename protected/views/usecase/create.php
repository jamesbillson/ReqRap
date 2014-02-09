<h3>Create Usecase UC-<?php echo $package->number; ?>-<?php echo $number; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,  
                            'package'=>$package,
                            'number'=>$number,
                            )); ?>