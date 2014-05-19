   <?php
                                    //$links = Form::model()->getStepForms($item['id']);
                                    $links = Step::model()->getStepLinks($item['id'], 2, 14); // centralise all these.
                                    foreach ($links as $link) {
                                        ?>
                                        UF-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?>  <?php echo $link['name']; ?> <a href="/stepform/delete/id/<?php echo $link['xid']; ?>"><i class="icon-remove-sign"></i></a><br/>
                                <?php } ?>
                                    <br />

                                            <?php $forms =Step::model()->getStepLinks($item['id'], 2, 14); ?>  
                                    
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'formsModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add Forms</h4>
</div>
 
<div class="modal-body">
    <form action="/stepform/createinline/" method="POST">
        <input type="hidden" name="step_id" value="<?php echo $item['id']; ?>">
        <input type="hidden" name="project_id" value="<?php echo $project; ?>">
        <input type="hidden" name="step_db_id" value="<?php echo $item['id']; ?>">
        <select name="form">
        <?php foreach ($forms as $form) { ?>
                <option value="<?php echo $form['form_id']; ?>"><?php echo $form['name']; ?></option>
        <?php } ?>
        </select>
        <br />Add a new one<br>
        <input type="text" name="new_form">
        <br>
        <input type="submit" value="add" class="btn primary">
    </form>
</div>
 
<?php $this->endWidget(); ?>                       
                                    
                                    
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'+Add Forms',
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#formsModal',
    ),
)); ?>