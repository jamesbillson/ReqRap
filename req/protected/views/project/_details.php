<h3>Release History</h3>
<?php
//$data = Release::model()->findAll('project_id='.Yii::app()->session['project']);
$data = Release::model()->findAll(array('order'=>'number ASC',
    
    'condition'=>'project_id=:x',
    'params'=>array(':x'=>Yii::app()->session['project'])));
$release = Yii::App()->session['release'];
$currentrelease=Release::model()->currentRelease();
$owner=(Yii::App()->session['owner']==1)?TRUE:FALSE;
$library=Library::model()->findAll(array(
    'condition'=>'owner_id=:x',
    'params'=>array(':x'=>User::model()->myCompany())));
$shared=array();
if(count($library)){
    foreach ($library as $module){
     $shared[$module->release_id]=$module->public;
    }
    
    
}
$x=0;
//print_r($shared);
?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Status</th>
                <th>Date</th>
                <th>Actions</th>

	</tr>
	</thead>
            <?php if (count($data)):?>
        <tbody>

        <?php foreach($data as $item) {
          $x++;  
        if(($item['id']!=$currentrelease)||($item['id']==$currentrelease && in_array(Yii::App()->session['permission'],array(1)))) {   
            
        
        ?>
        <tr class="odd">  
        <td>  
            
            <?php 
         if (in_array(Yii::App()->session['permission'],array(1,2,3))) {?>  
            <strong>
        <a href="/release/set/id/<?php echo $item['id'];?>">
        
             <?php if ($item['id']==$release){;?>     
        <?php echo $item['number']; ?> 
        
        <?php } ELSE {?>
        R-<?php echo FLOOR($item['number']); ?>
        <?php } ?>    
            
        </a> </strong>
        <?php } ?>
            
   
        </td>
   
        <td>   
       <?php echo Release::$status[$item['status']];?> 
           <?php if ($item['id']!=$currentrelease) echo ' @ change '.$item['offset'] ;?>
        </td>
    
    <td>   
        <?php echo $item['create_date'];?>
        </td>
              


      <td>
         <?php    if ($x!=1){?>
          <a href="/usecase/diff/old/<?php echo $old;?>/new/<?php echo $item['id'];?>"><b rel="tooltip" title="Compare this version to the previous release">&Delta;</b></a> 
           <?php
         }
        if (isset($shared[$item['id']])){
        if($shared[$item['id']]==1){ ?>
             <a href="/library/view/"><i class="icon-book text-warning" rel="tooltip" title="In Public library"></i></a> 
     <?php
        }
        if ($shared[$item['id']]==0) { ?>
             <a href="/library/view/"><i class="icon-book" rel="tooltip" title="In Private library"></i></a> 
     <?php
        }
    } ELSE {
        
       
      if ($owner && $item['id']!=$currentrelease) {?>
          
      <a href="/library/create/id/<?php echo $item['id'];?>"><i class="icon-book text-success" rel="tooltip" title="Add to library"></i></a> 
    <?php }}
       if ($owner && $item['id']!=$currentrelease) {?>
      <a href="/release/copy/id/<?php echo $item['id'];?>"><i class="icon-copy" rel="tooltip" title="Copy Release to new project"></i></a>
     
         <?php
            } 
            if ($item['id']==$currentrelease && $owner){?>
          <a href="/release/finalise/id/<?php echo $item['id'];?>"><i class="icon-certificate" rel="tooltip" title="Finalise Release"></i></a> 
        
        <?php /*
       echo CHtml::link(
    '<i class="icon-remove-sign text-error" rel="tooltip" title="Delete Release"></i>',
     array('/release/delete','id'=>$item['id']),
     array('confirm' => 'This will permanently delete this release, there is NO undo.  Are you sure?')
);
   */
        ?>

    
             <?php } 
          
     
        if ($item['id']==$release){;?>
           <a href="/version/index/id/<?php echo $item['id'];?>"><i class="icon-calendar " rel="tooltip" title="View change log"></i></a> 
        
              <?php } 
              $old=$item['id'];
              ?>
              
        </td>
        </tr>
          	</tbody>
<?php
 }      
 } ?>
<?php endif; ?>        
 
</table>

