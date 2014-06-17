<?php 
$mycompany=User::model()->myCompany();
$projectlist=Company::model()->getProjects($mycompany);
$no_project=true;
if(isset(Yii::App()->session['project'])) {
    $project=Project::model()->findbyPK(Yii::App()->session['project']); 
    $currentrelease=Release::model()->currentRelease();
    $release=Yii::App()->session['release'];
    $thisrelease=Release::model()->findbyPK($release);
    $phase = Yii::App()->session['phase']=$thisrelease->status;
    Project::model()->setPermissions($mycompany, $project,$release, $currentrelease);
    
} ELSE {
    $no_project=false;
    
    Yii::App()->session['permission']=0;
}




//echo 'release status'.$phase;
?>

<table><tr><td>
    <h1> 
    <a href="/project/view/tab/<?php echo $tab; ?>"> 
    
       <?php if ($no_project) echo $project->name  ; ?></a>  </h1> 
       
      </td>
        <td>  <?php  if(isset($currentrelease) && $release != $currentrelease)   {
             $releaseNumber = Release::model()->findbyPK($release);
       echo '( R-'.FLOOR($releaseNumber->number).' )';
         }
        ?>
            <?php if(Yii::App()->session['permission']==1) {?>
    <a href="/project/project/">
        <i class="icon-cog" rel="tooltip" title="Project Settings"></i>
    </a>
            <?php }  ?>
             <?php
    if(isset($currentrelease) && $release != $currentrelease){
      
      ?>
        <a href="/release/setcurrent/"><i class="icon-cog text-warning" rel="tooltip" title="Project Settings"></i></a> 
       
 
    <?php } ?>
           <a href="/project/view/tab/usecases/">
        <i class="icon-film" rel="tooltip" title="Requirements Model"></i>
    </a>
</td>
<td> 
    <form action="/project/set/">
        <input type="hidden" name="tab" value="details">
        <select name="id" onchange="this.form.submit()">
            
            <option>Change Project</option>
    <?php 
   foreach($projectlist as $proj)
   {?>
            <option value="<?php echo $proj['id']; ?>"> <?php echo $proj['name'];?></option>
  
   <?php
   }
    
  
  
   
   ?>
            
            
            
   </select>
    </form>
</td>
<td>

         <?php
  
    if($no_project){  ?>
          <a target="_new" href="/project/print" ><i class="icon-print " rel="tooltip" title="View Print Version"></i></a> 
       <?php  } ?>
</td>
    </tr>
</table> 

  