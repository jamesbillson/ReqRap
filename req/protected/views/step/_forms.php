   <?php
                                    //$links = Form::model()->getStepForms($item['id']);
                                    $links = Step::model()->getStepLinks($item['id'], 2, 14); // centralise all these.
                                    foreach ($links as $link) {
                                        ?>
<a href="/form/view/id/<?php echo $link['form_id']; ?>">UF-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['name']; ?> <a href="/stepform/delete/id/<?php echo $link['xid']; ?>"><i class="icon-link text-error" rel="tooltip" title="Unlink this form"></i></a><br/>
                                <?php } ?>
                                    <br />

<?php $forms =Form::model()->getProjectForms($project); ?>  
                               
<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'formsModal',
        'fade' => false,
        'options' => array(
            'backdrop' => false
        )
    ));
?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add Forms</h4>
</div>
 
<div class="modal-body">
    <form action="<?php echo UrlHelper::getPrefixLink('/stepform/createinline/')?>" method="POST">
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
<style type="text/css">
    #formsModal{
        margin-left: 0px !important;
    }
</style>
<a href="#" onclick="$('#formsModal').modal('toggle'); var pos = $(this).offset(); $('#formsModal').css({'left': (pos.left - 260), 'top': pos.top - $(window, document).scrollTop() - 100}); return false;"><i class="icon-plus-sign-alt" rel="tooltip" title="Add Forms"></i> Add Forms</a>