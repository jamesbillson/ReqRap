<?
$project=Project::model()->findbyPK(Yii::App()->session['project']); 
$mycompany=User::model()->myCompany();
$projectlist=Company::model()->getProjects($mycompany);

$currentrelease=Release::model()->currentRelease();
$release=Yii::App()->session['release'];
Project::model()->setPermissions($mycompany, $project,$release, $currentrelease);
//echo 'release'.$release.'<br /> current release'.$currentrelease.'<br />';
        
?>

<table><tr><td>
    <h1> 
    <a href="/project/view/tab/<?php echo $tab; ?>">
       <?php echo $project->name; ?> 
    </a> 
    </h1>    </td>
        <td>
            <?php if(Yii::App()->session['permission']==1) {?>
    <a href="/project/details/id/<?php echo $project->id; ?>">
        <i class="icon-cog"></i>
    </a>
            <?php }  ?>
</td>
<td> 
    <form action="/project/set/">
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
    if($release != $currentrelease){
      
      ?>
        <a href="/release/set/id/<?php echo $currentrelease;?>"><i class="icon-exclamation-sign text-error" rel="tooltip" title="Go to current release"></i></a> 
      
         <?php
  }
    
       ?>
          <a target="_new" href="/project/print" ><i class="icon-print " rel="tooltip" title="View Print Version"></i></a> 
    
</td>
    </tr>
</table> 