

<?php 

$data = User::model()->companyUsers();
$admin = Company::model()->Admins(); 
$me = User::model()->findbyPK(Yii::app()->user->id);

?>

<div class="well">
    <h1><?php echo $model->name; ?></h1>
     <?php    if($me->admin==1) {?>
    <a href="<?php echo UrlHelper::getPrefixLink('/company/update?id=')?><?php echo $model->id; ?>">
        <i class="icon-cog"></i></a>
 <?php 
     }
echo $model->description;
?>
 
   
</div>



<?php 
$tab=Yii::App()->session['setting_tab'];
if (!isset($tab)) $tab='employees';


 
// if this company project owner is current viewer
  
    $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
    $permission=Yii::App()->session['permission'];
    $phase=Yii::App()->session['phase'];
    $totalstages=0;
    $status = array('invited','confirmed');

?>



<!-- make tab -->
<?php $tabs = array()?>

<!-- Setup condition -->
<?php 
$active = array();
$active['details']=FALSE;
$active['output']=FALSE;
$active['employees']=FALSE;
$active['scores']=FALSE;


 $active[$tab]=TRUE;

       $tabs[] = array('id' => 'employees', 
        'label' => 'People', 
        //'visible' => in_array($permission,array(1,2,3,4,5)),
        'content' => $this->renderPartial('_employees',
                compact('model'),true,false),'active'=>$active['employees']);
    $tabs[] = array('id' => 'details',
            'label' => 'Company Details',
           // 'visible' => in_array($permission,array(1,2,3,4,5)),
            'content' => $this->renderPartial('_details',
                    compact('model'),true,false),'active'=>$active['details']);
    
    $tabs[] = array('id' => 'scores', 
        'label' => 'Sizing',
       // 'visible' => in_array($permission,array(1,2,3,4,5)),
        'content' => $this->renderPartial('_scores',
                compact('model'),true,false),'active'=>$active['scores']);

   /* $tabs[] = array('id' => 'sizing', 
        'label' => 'Output',
       // 'visible' => in_array($permission,array(1,2,3,4,5)),
        'content' => $this->renderPartial('_output',
                compact('model'),true,false),'active'=>$active['output']); */
 
?>
<?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>

