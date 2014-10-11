
<?php 
$release=Yii::App()->session['release'];
$link=$release.'_0_0';
echo $this->renderPartial('/project/head',array('tab'=>'','link'=>$link)); 

?>
 
<?php // if this company project owner is current viewer
  
    //$type = Company::model()->findbyPK($mycompany)->type;
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
    $permission=Yii::App()->session['permission'];
    $phase=Release::model()->findbyPK($release)->status;
 
?>



 
<?php 


$project=Yii::App()->session['project'];
$walkthrupaths= Walkthrupath::model()->findAll('release_id='.$release);

$url=UrlHelper::getPrefixLink('/walkthrupath/create/id/').$release;
?>
<?php 


        
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Walkthroughs',
    'headerIcon' => 'icon-check',

    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
 'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Auto Walk Throughs',
        'visible'=>$permission==1,
        //'visible'=> $permission,
        'url'=>$url,
       'htmlOptions' => array(
		'name'=>'ActionButton',
		'confirm' => 'This will delete any existing walk throughs. Are you sure you\'d like to do this?',
	),
    ),
  
       ) )); 
?>

<table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Status</th>
   
                   <th>Actions</th>
                </tr>
            </thead>

            <tbody>

<p>
   



          

            <?php foreach($walkthrupaths as $walkthrupath){
              //$walkthruresults=  Walkthruresult::model()->findAll('walkthrupath_id='.$walkthrupath->id);  
            $result= Walkthrupath::model()->getResult($walkthrupath->id); 
             ?>
                <tr class="odd">  
                    <td>   
                       
                       
                     <a href="<?php echo UrlHelper::getPrefixLink('/walkthrupath/view/id/')?><?php echo $walkthrupath['id'];?>">
                     WT-<?php echo str_pad($walkthrupath['number'], 4, "0", STR_PAD_LEFT) ?>    
                      </a>
                    </td>
                    <td>   
                         
                    <?php echo $walkthrupath['name'];?>
                    </td>
                    
                    <td>
                    <?php if (!isset($result[0]['result'])) echo 'Not reviewed';?>
                   <?php if (isset($result[0]['result'])) echo Walkthruresult::$result[$result[0]['result']];?>
                    </td> 
                    
      
                    
                    <td>
                        <?php if($permission==1){ ?>
                    <a href="<?php echo UrlHelper::getPrefixLink('/walkthrupath/delete/id/')?><?php echo $walkthrupath['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                      <?php } ?> 
                    </td>
                </tr>
            <?php }
       
                    ?>
            </tbody>
        </table>

    <?php $this->endWidget(); ?>


