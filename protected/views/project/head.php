
    <?php $project=Project::model()->findbyPK(Yii::App()->session['project']); 
    
    $projectlist=Company::model()->getProjects($project->company->id);
    
    
    ?>
<table><tr><td>
    <h1> 
    <a href="/project/view/tab/<?php echo $tab; ?>">
       <?php echo $project->name; ?> 
    </a> 
    </h1>    </td><td>
    <a href="/project/details/id/<?php echo $project->id; ?>">
        <i class="icon-cog"></i>
    </a>
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
    
    </tr>
</table> 