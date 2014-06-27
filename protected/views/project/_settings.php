

<b>Description</b> <a href="/project/update?id=<?php echo $model->id; ?>"><i class="icon-edit"></i></a>
<br /><?php echo $model->description; ?><br />

 <br /> 
  External Link: <input type="text" value ="http://www.reqrap.com/project/extview/id/<?php echo $model->extlink; ?>" onclick="this.select()">
 <a href="/project/resetlink/id/<?php echo $model->id; ?>">Reset the link</a>
 
