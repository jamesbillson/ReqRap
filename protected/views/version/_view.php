<tr>
<td>
    <?php echo CHtml::link(CHtml::encode('Change #'.$data->number), array('view', 'id'=>$data->id)); ?>
</td>
 <td>
   <?php echo CHtml::encode(Version::$actions[$data->action]); ?> 
</td>

<td>
   <?php echo CHtml::encode(Version::$objects[$data->object]); ?> 
</td>

<td>
   <?php 
   
   $instance=Version::model()->getObject($data->foreign_key, $data->object);
   //print_r($instance);
  if (isset($instance['name'])){
    
 
        $object=Version::model()->instanceName($data->object, $data->foreign_id);
        ?> 
        <a href="/<?php echo Version::$objects[$data->object]; ?>/view/id/<?php echo $data->foreign_id; ?>">
        <?php echo $object['number'].' '.$object['name'];?>
        </a>  
   <?php }  
      // echo CHtml::encode($instance['name']) ;
   if ($data->object==9)
   {
   echo 'Action: '.$instance['text'].'<br />';
    echo 'Result: '.$instance['result'].'<br />';
    ?> 
        <a href="/step/view/id/<?php echo $data->foreign_id; ?>">
        View Use Case
        </a>  
   <?php
   }
   ?> 
</td>


</tr>