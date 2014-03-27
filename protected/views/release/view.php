
<h1>Project</h1>
<h3>Finalise Release</h3>

<?php
$data = Release::model()->findbyPK($model->id);
?>

        <a href="/release/finalise/id/<?php echo $model->id;?>"><i class="icon-flag" rel="tooltip" title="Finalise Release"></i></a> 
      
          
          <a href="/release/update/id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="/rule/delete/id/<?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
    
              
    





Finalise this release -<br />
Change the release number on all the active objects.<br />
This means if you roll back, the last version will be wrong.<br />
So...<br /><br />
Copy all the active objects and set the create date to now, and the release to this release.<br />
The old release is then a snapshot.<br /><br />
Things to copy:<br />
<blockquote>
Package<br />
UC<br />
Flows<br />
Steps<br />
Rules<br />
Interfaces<br />
Stepiface<br />
Steprule<br />
Stepform<br />
Forms<br />
Objects<br />
Actors<br />
Iface Types<br />

</blockquote>



