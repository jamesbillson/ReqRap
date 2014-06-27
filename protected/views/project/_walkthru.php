

<h3>Walk-through.</h3>
<a href="/walkthrupath/create/id/<?php echo Yii::App()->session['release'];?>">Create Walk-Through</a>
<br />
List all the walk-through paths.
<br />
Click a path to start it.


 
<?php 

$release=Yii::App()->session['release'];
$project=Yii::App()->session['project'];
$walkthrupaths= Walkthrupath::model()->findAll('release_id='.$release);


?>
<?php 


        
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Walkthroughs',
    'headerIcon' => 'icon-check',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Test Case',
        //'visible'=> $permission,
        'url'=>'/walkthrupath/create/',
    ),
   
))); 
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

             ?>
                <tr class="odd">  
                    <td>   
                       
                        
                     <a href="/walkthrupath/view/id/<?php echo $walkthrupath->id;?>">
                     WT-<?php echo str_pad($walkthrupath['number'], 4, "0", STR_PAD_LEFT) ?>    
                      </a>
                    </td>
                    <td>   
                         
                    <?php echo $walkthrupath['name'];?>
                    </td>
                    
                    <td>
                 status
                    </td> 
                    
      
                    
                    <td>
                    <a href="/release/delete/id/<?php echo $walkthrupath['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                                    
                     <a href="/walkthrupath/run/id/<?php echo $walkthrupath['id'];?>"><i class="icon-check" rel="tooltip" title="Run the Test Case"></i></a> 
                  
                    </td>
                </tr>
            <?php }
       
                    ?>
            </tbody>
        </table>

    <?php $this->endWidget(); ?>


