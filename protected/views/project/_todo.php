<h3>Statistics</h3>
<h4>Size Scores</h4>
<?php
$total=0;
$scores=  Usecase::model()->weight();
echo '<table>';
foreach ($scores as $id=>$score){

    $object=Version::model()->instanceName(10, $id);
    ?>
<tr>
    <td>
   <?php   echo $object['number'].'-'.$object['name']; ?>
    </td>
    <td>
   <?php  echo $score;?>
</td>
</tr>
    <?php
    $total=$total+$score;
}
?>
<tr>
<td>
    <strong>Total</strong>
  </td>
<td>   
<?php echo $total;?>
    
    
</td>
</tr>
</table>
<?php

$label=array(
    3=>array('label'=>'final', 'style'=>'success'),
    2=>array('label'=>'core', 'style'=>'warning'),
    1=>array('label'=>'initial', 'style'=>'important'));


// #####################  USE CASES

$uc=Usecase::model()->toDo();
$rule=Rule::model()->toDo();
$if=Iface::model()->toDo();
$form=Form::model()->toDo();
$ob=Object::model()->toDo();
$act=Actor::model()->toDo();



//#######################  ACTORS

$coef=array('UC'=>10,
            'BR'=>5,
            'UI'=>5,
            'UF'=>1,
            'OB'=>1,
            'ACT'=>10,
    );
$projectscore=FLOOR((
        ($uc['state']*$coef['UC'])+
        ($rule['state']*$coef['BR'])+
        ($if['state']*$coef['UI'])+
        ($form['state']*$coef['UF'])+
        ($ob['state']*$coef['OB'])+
        ($act['state']*$coef['ACT'])
        )/32);

echo '<br /><h4>Project Completeness ';
  $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$projectscore]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$projectscore]['label'],
    )); 
  ?></h4>
<br />
<h4>By Object</h4>

<?php
 //PRINT OUT SECTION
// #####################  USE CASES

if ($uc['count']>0){
    echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$uc['state']]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$uc['state']]['label'],
    )); 

  echo ' Use Cases</h4>';
    
echo '<br>'.$uc['stub'].' of '.$uc['count'].' Use Cases are stubs, completeness: '.number_format((float)FLOOR(100-($uc['stub']/$uc['count'])*100), 0, '.', '').'%';
if ($uc['stub']>0) echo $uc['stublist'];

} else {
    echo '<h4>Use Cases</h4>No use cases';
}
?>
<br />


<?php
//#########################   RULES
$stub=0;
$orphan=0;
$stublist='<br />Stub rules: <br />';
$orphanlist='<br />Orphan rules: <br />';
$data = Rule::model()->getProjectRules($model->id);
if ($rule['count']>0){

  echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$rule['state']]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$rule['state']]['label'],
    )); 

  echo ' Rules</h4>';
        $stubscore=100-(($rule['stub']/$rule['count'])*100);
        $orphanscore=100-(($rule['orphan']/$rule['count'])*100);
echo $stub.' of '.count($data).'  Rules are stubs, completeness: '.number_format((float)($stubscore), 0, '.', '').'%';
if($rule['stub']>0) echo $rule['stublist'];
echo '<br> '.$rule['orphan'].' orphan rules, completeness: '.number_format((float)FLOOR($orphanscore), 0, '.', '').'%';
if($rule['orphan']>0) echo $rule['orphanlist'];

        } else {
    echo '<h4>Rules</h4>No Rules';
}
?>




<?php

// ########################## INTERFACES


if($if['count']>0){
    
    
    echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$if['state']]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$if['state']]['label'],
    )); 

  echo ' Interfaces</h4>';
    
echo '<br>'.$if['stub'].' of '.$if['count'].' Interfaces with no images, completeness: '.number_format((float)(100-($if['stub']/$if['count'])*100), 0, '.', '').'%';
echo $if['stublist'];
echo '<br>'.$if['orphan'].' orphan Interfaces, completeness: '.number_format((float)FLOOR(100-($if['orphan']/$if['count'])*100), 0, '.', '').'%';
echo $if['orphanlist'];

} ELSE {
    echo '<h4>Interfaces</h4>No Interfaces';
}
?>


<?php
// #################### ----------------------  FORMS
if ($form['count']>0)
    {

 echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$form['state']]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$form['state']]['label'],
    )); 

  echo ' Forms</h4>';
echo '<br>'.$form['stub'].' of '.count($data).' Forms are stubs, completeness: '.number_format((float)(100-($form['stub']/$form['count'])*100), 0, '.', '').'%';
if($form['stub']>0) echo $form['stublist'];
echo '<br>'.$form['orphan'].' orphan Forms, completeness: '.number_format((float)FLOOR(100-($form['orphan']/$form['count'])*100), 0, '.', '').'%';
if($form['orphan']>0) echo $form['orphanlist'];
} else {
    
    echo '<h4>Forms</h4>No Forms';
}



?>



<?php

//##############################                OBJECTS @@

if ($ob['count']>0){
   echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$ob['state']]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$ob['state']]['label'],
    )); 

  echo ' Objects</h4>';
echo '<br>'.$ob['stub'].' of '.$ob['count'].' Objects are stubs, completeness: '.number_format((float)(100-($ob['stub']/$ob['count'])*100), 0, '.', '').'%';
if($ob['stub']>0) echo $ob['stublist'];
        

} else {
    
    echo '<h4>Objects</h4>No Forms';
}

?>





<?php

//#######################  ACTORS

 if ($act['count']>0){
           
   echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$act['state']]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$act['state']]['label'],
    ));       
        
        
echo ' Actors</h4> '.$act['orphan'].' Orphan actors, completeness: '.number_format((float)FLOOR(100-($act['orphan']/$act['count'])*100), 0, '.', '').'%';
if($act['orphan']>0) echo $act['orphanlist'];

       } else {
    echo '<h4>Actors</h4>No Actors';
}
?>