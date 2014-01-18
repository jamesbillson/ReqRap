<h3>Create Usecase UC-<?php echo $package->sequence; ?>-<?php echo $number; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,  
                            'package'=>$package,
                            'number'=>$number,
                            )); ?>