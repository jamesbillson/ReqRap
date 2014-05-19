     <?php
                            // $links = Rule::model()->getStepRules($item['id']);
                            $links = Step::model()->getStepLinks($item['id'], 1, 16);
                            foreach ($links as $link) {
                            ?>
                                    <a href="/rule/view/id/<?php echo $link['rule_id']; ?>"> BR-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['title']; ?> <a href="/steprule/delete/id/<?php echo $link['xid']; ?>"><i class="icon-remove-sign"></i></a><br/>
                            <?php } ?>
                                <br />
                                <?php $rules = Step::model()->getStepLinks($item['id'], 1, 16); ?>   
                                
                                
                                
                                
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'rulesModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add Rules</h4>
</div>
 
<div class="modal-body">
    <form action="/steprule/createinline/" method="POST">
        <input type="hidden" name="step_id" value="<?php echo $item['id']; ?>">
        <input type="hidden" name="project_id" value="<?php echo $project; ?>">
        <input type="hidden" name="step_db_id" value="<?php echo $item['id']; ?>">
        <select name="rule">
        <?php foreach ($rules as $rule) { ?>
            <option value="<?php echo $rule['rule_id']; ?>"><?php echo $rule['title']; ?></option>
        <?php } ?>
        </select>
        <br />Add a new one<br>
        <input type="text" name="new_rule"><br>
        <input type="submit" value="add" class="btn primary">
    </form>
</div>
 
 
<?php $this->endWidget(); ?>
                                
                                
                 <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'+Add Rule',
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#rulesModal',
    ),
)); ?>               
                                
                                
                                
                        