<style type="text/css">
    .modal {
        width: 252px;
        margin-left: -126px;
    }
</style>
<?php
$project = Yii::App()->session['project'];
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$steps = Step::model()->getFlowSteps($model->flow_id);
if (count($steps)):
    ?>  
    <table class="table"> 
        <tbody>
            <?php foreach ($steps as $key => $item) : // Go through each un answered question? ?>
                <tr class="odd">
                    <?php if ($item['id'] == $id && $edit) { // THIS IS THE STEP WE ARE EDITING ?>
                        <td style="border-right: 1px solid #DDDDDD"> 
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'step-form',
                                'enableAjaxValidation' => false,
                            ));
                            ?>
                            <?php echo $form->errorSummary($step); ?>
                            <?php echo $form->hiddenfield($step, 'flow_id', array('value' => $model->id)); ?>
                            <b>Step <?php echo $item['number']; ?></b><br>
                            <?php echo $form->textArea($step, 'text', array('rows' => 3, 'cols' => 180, "style" => "width:500px")); ?>
                            <?php echo $form->error($step, 'text'); ?>
                            <br />
                            Use wiki markup [[UF/UI/BR/OB+Name]] to create new objects<br />
                             [[UF/IF/BR/OB:Number]] to link existing objects<br />
                            <b>Result</b>
                            <br>
                            <?php echo $form->textArea($step, 'result', array('rows' => 3, 'cols' => 180, "style" => "width:500px")); ?>
                            <?php echo $form->error($step, 'result'); ?>
                            <?php $actors = Actor::model()->getProjectActors($project); ?><br>
                            Use wiki markup [[UF/UI/BR/OB+Name]] to create new objects<br />
                            [[UF/IF/BR/OB:Number]] to link existing objects<br />
                            <select name="Step[actor_id]">
                                <?php
                                foreach ($actors as $actor) {
                                    echo '<option value="' . $actor['actor_id'] . '"';
                                    if ($actor['actor_id'] == $usecase['actor_id'])
                                        echo 'selected';
                                    echo'>' . $actor['name'] . '</option>';
                                }
                                ?> 
                            </select><br>
                            <?php
                            echo CHtml::submitButton($step->isNewRecord ? 'Create' : 'Save');
                            $this->endWidget();
                            ?>
                            <?php
                            $key++;
                            if (isset($steps[$key])) {
                                ?>
                                <table style="width: 100%;">
                                    <tr>
                                        <td>  
                                            <?php if ($edit) { ?>
                                                <a href="/step/insert/id/<?php echo $steps[$key]['id'] ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Insert a new step"></i> Add Step</a>
                                            <?php } ?> 
                                        </td> 
                                    </tr>
                                </table>
                            <?php } ?>    
                        </td>
                        <td>
                            <table >
                                <tr>
                                    <td style="border-top:0px">
                                        <strong>Interfaces</strong><br />
                                        <?php $this->renderPartial("_interfaces", array('item' => $item, 'project' => $project)) ?>              
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Rules</strong><br />
                                        <?php $this->renderPartial("_rules", array('item' => $item, 'project' => $project)) ?>     
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Forms</strong><br />
                                        <?php $this->renderPartial("_forms", array('item' => $item, 'project' => $project)) ?>  
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php
                    } ELSE { // THIS IS NOT THE EDIT ROW, SHOW THE RELATED IFACE AND RULES 
                        ?>
                        <?php $this->renderPartial("_steplistview", array('item' => $item, 'project' => $project, 'edit'=>$edit)) ?>     
                    <?php } ?>
                <?php endforeach ?>   
        </tbody>
    </table>
    <?php if ($edit) { ?>
        <a href="/step/create/id/<?php echo $model->id; ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Step</a> 
    <?php } ?>    
<?php endif; // end count of results   ?>
<?php if ($model->main != 1) { // THIS IS AN ALTERNATE FLOW So we show the main flow entry and exit ?>  
    <h4>Alternate Flow <?php echo $model->name; ?> Start and End Points</h4>
    <?php
    $steps = Step::model()->getMainSteps($usecase['id']); // get the requirements with answers
    if (count($steps)):
        ?>
        <table class="table">
            <tbody>
                <?php foreach ($steps as $item) : // Go through each un answered question?  ?>
                    <tr class="odd">
                        <td>   
                            <b><?php echo $item['flow']; ?>(<?php echo $item['number']; ?>):</b> <?php echo $item['text']; ?>
                        </td> 
                        <td>
                            <?php if ($item['step_id'] == $model->startstep_id) { // THIS IS Start step  ?>
                                Start
                            <?php } ELSE { ?>
                                <a href="/flow/updateendpoints/end/1/flow/<?php echo $model->id; ?>/id/<?php echo $item['step_id']; ?>"><i class="icon-chevron-right" rel="tooltip" title="Move the START of this flow here"></i></a> 

                            <?php } ?>
                            <?php if ($item['step_id'] == $model->rejoinstep_id) { // THIS IS Start step ?>
                                END  
                            <?php } ELSE { ?>
                                <a href="/flow/updateendpoints/end/2/id/<?php echo $item['step_id']; ?>/flow/<?php echo $model->id; ?>"><i class="icon-chevron-left" rel="tooltip" title="Move the END of this Flow Here"></i></a> 
                            <?php } ?>
                        </td>
                    <?php endforeach ?>   
            </tbody>
        </table>
    <?php endif; // end count of results   ?>
    <a href="/step/create/id/<?php echo $model->id; ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Step</a> 
<?php } ?>
            