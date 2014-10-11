
<h1>Project</h1>
<h3>Finalise Release</h3>

<?php
$data = Release::model()->findbyPK($model->id);
?>

Number <?echo $model->number;?>
<br />
Date Created <?echo $model->create_date;?>
<br />



        <a href="<?php echo UrlHelper::getPrefixLink('/release/finalise/id/')?><?php echo $model->id;?>"><i class="icon-flag" rel="tooltip" title="Finalise Release"></i></a> 
      
          
          <a href="<?php echo UrlHelper::getPrefixLink('/release/update/id/')?><?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="<?php echo UrlHelper::getPrefixLink('/rule/delete/id/')?><?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
    
              
    
<br />

Insert a new number - need to know if its incremental or major. Make two buttons on previous form.
<br />
Insert into release new number, status = 1, make the old status 0, date and user.
<br />
Go through each object 1 to 16 in versions that have active=1 and the old status.
<br />
For i= 1 to 16.
<br />
Select * from versions where object = i
<br />
Select * from object[$object] insert into object[$object]
<br />
Insert a new version with new foreign_key, create user and date
<br />
Copy the related object using the foreign key to a new instance of that object.
<br />
Create a new version that points to that new object.

