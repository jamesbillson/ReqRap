
<?php 
$release=Yii::App()->session['release'];
$link=$release.'_0_0';
if (!isset($tab)) $tab='testcases';
if ($tab=='details') $tab='testcases';
echo $this->renderPartial('/project/head',array('tab'=>$tab,'link'=>$link)); 
if ($tab=='photos') $tab='interfaces';
?>
 
<?php // if this company project owner is current viewer
  
    //$type = Company::model()->findbyPK($mycompany)->type; 
    $permission=Yii::App()->session['permission'];
    $phase=Release::model()->findbyPK($release)->status;
 

$project=Yii::App()->session['project'];
$walkthrupaths= Walkthrupath::model()->findAll('release_id='.$release);


?>


<table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Status</th>

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
                                    
                     <a href="/walkthrupath/run/id/<?php echo $walkthrupath['id'];?>"><i class="icon-check" rel="tooltip" title="Run the Test Case"></i></a> 
                  
                    </td>
                </tr>
            <?php }
       
                    ?>
            </tbody>
        </table>

  
