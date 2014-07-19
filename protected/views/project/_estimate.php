

<h3>To Do List.</h3>

<h4>Rules</h4>

<?php
$stub=0;
$orphan=0;
$data = Rule::model()->getProjectRules($model->id);
if (count($data)){
       echo 'Stub rules: <br />';  
    foreach($data as $item) {
   
        if ($item['text']=='stub') {
            $stub++; ?>
        <a href="/rule/view/id/<?php echo $item['rule_id']?>"> BR-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name']; ?></a><br />
        <?php
        }
        $uses=Usecase::model()->getLinkUsecase($item['rule_id'],1,16);
        if(count($uses)==0)$orphan++;
        }


echo '<br>'.$stub.' of '.count($data).' stub Rules, completeness: '.(100-($stub/count($data))*100).'%';
echo '<br>Orphans: '.$orphan.', completeness: '.FLOOR(100-($orphan/count($data))*100).'%';
} else {
    echo 'No Rules';
}
?>

<h4>Forms</h4>


<?php
$stub=0;
$orphan=0;
$data = Form::model()->getProjectForms(Yii::app()->session['project']);
if (count($data)){
   echo 'Stub forms: <br />';    
foreach($data as $item):
   
$fields=  Formproperty::model()->getFormProperty($item['form_id']);
if(count($fields)==0) {
    $stub++;?>
        <a href="/form/view/id/<?php echo $item['form_id']?>"> UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name']; ?></a><br />
        <?php
}
        $uses=Usecase::model()->getLinkUsecase($item['form_id'],2,14);
if(count($uses)==0) $orphan++;
endforeach;


echo '<br>'.$stub.' of '.count($data).' stub Forms, completeness: '.(100-($stub/count($data))*100).'%';
echo '<br>Orphans: '.$orphan.', completeness: '.FLOOR(100-($orphan/count($data))*100).'%';
} else {
    echo 'No Forms';
}
?>


<h4>Interfaces</h4>

<?php
$stub=0;
$orphan=0;
$count=0;
$types = Interfacetype::model()->getInterfacetypes();
foreach($types as $type){
$data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
if (count($data)):
$count=$count+count($data);
    foreach($data as $item){
    if(!count(Iface::model()->getCurrentImage($item['iface_id'],Yii::App()->session['release']))) $stub++; 
$uses=Usecase::model()->getLinkUsecase($item['iface_id'],12,15);
 if(count($uses)==0) $orphan++;
}
endif;
}
if($count>0){
echo '<br>'.$stub.' of '.$count.' Interfaces with no images, completeness: '.(100-($stub/$count)*100).'%';
echo '<br>Orphans: '.$orphan.', completeness: '.FLOOR(100-($orphan/$count)*100).'%';
} ELSE {
    echo 'No Interfaces';
}
?>

<h4>Usecases</h4>


<?php
$stub=0;
$data = Usecase::model()->getProjectUCs();
if (count($data)){
       echo 'Stub usecases: <br />';    
foreach($data as $item):

    $steps= Usecase::model()->getAllSteps($item['usecase_id']);
//print_r($steps);
//echo"--------------<br />";
if(count($steps)<=1) {
    $stub++;
echo '<a href="/usecase/view/id/';
echo  $item['usecase_id'];
echo '">';
echo $item['name']."<br />";
echo '</a>';
}
endforeach;


echo '<br>'.$stub.' of '.count($data).' stub Usecases, completeness: '.FLOOR(100-($stub/count($data))*100).'%';
} else {
    echo 'No Objects';
}
?>
<br />

<h4>Actors</h4>

<?php

$orphan=0;
$data = Actor::model()->getProjectActors($model->id);

if (count($data)){
    foreach($data as $item) {
       $uses=Actor::model()->getActorParentSteps($item['id']);

       if(count($uses)==0)$orphan++;
        }
echo '<br>Orphans: '.$orphan.', completeness: '.FLOOR(100-($orphan/count($data))*100).'%';
} else {
    echo 'No Rules';
}
?>