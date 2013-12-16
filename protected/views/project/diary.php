<h1><?php echo $model->company->name; ?></h1>
<h2><?php echo $model->name; ?></h2>
<br />
<br />
<a href="/diary/create/id/<?php echo $model->id; ?>">Add entry</a>
<?php
 
 $diary = Diary::model()->getProjectFeed($model->id);

 

if (count($diary)):
 foreach($diary as $entry) {?>
      

<div class="well">  
      <?php     echo $entry['title']; ?> - <?php  echo $entry['create_date'];?> <br />
          <?php    echo $entry['content'];?> <br />
          
         <?php  echo $entry['firstname'];?> 
         <?php  echo $entry['lastname']; ?> <br />
         Actions - link to package, create variation, link to claim, create issue.<br />
         <a href="/link/create/source/<?php echo Link::DIARY;?>/id/<?php echo $entry['id'];?>"><i class="icon-link"></i></a>
</div>
       <?php }
       endif; ?>

