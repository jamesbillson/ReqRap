 <?php
                            //$links = Iface::model()->getStepIfaces($item['id']);
                            $links = Step::model()->getStepLinks($item['id'], 12, 15);
                            foreach ($links as $link) {
                                ?>
                                <a href="/iface/view/id/<?php echo $link['iface_id']; ?>"> UI-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?>  </a>
                                <?php echo $link['name']; ?> <a href="/stepiface/delete/id/<?php echo $link['xid']; ?>"><i class="icon-remove-sign"></i></a><br />
                            <?php } ?>
                            <br />

<?php $interfaces = Iface::model()->getProjectIfaces($project); ?>   
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'interfaceModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add Interfaces</h4>
</div>
 
<div class="modal-body">
    <form action="/stepiface/createinline/" method="POST">
        <input type="hidden" name="step_id" value="<?php echo $item['step_id']; ?>">
        <input type="hidden" name="project_id" value="<?php echo $project; ?>">
        <input type="hidden" name="step_db_id" value="<?php echo $item['id']; ?>">

        <select name="interface">
        <?php foreach ($interfaces as $iface) { ?>
            <option value="<?php echo $iface['iface_id']; ?>"><?php echo $iface['name']; ?></option>
        <?php } ?>

        </select>
        <br />Add a new one
        <br>
        <input type="text" name="new_interface">
        <br>
        <input type="submit" value="add" class="btn primary">
    </form>
</div>
 
 
<?php $this->endWidget(); ?>
                            
                            
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'+Add Interface',
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#interfaceModal',
    ),
)); ?>
              