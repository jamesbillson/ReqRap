<tr>
<td>
    <?php echo CHtml::link(CHtml::encode('Change #'.$data->number), array('view', 'id'=>$data->id)); ?>
</td>
 <td>
   <?php 
   
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>Version::$action_types[$data->action], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>Version::$action_labels[$data->action],
    )); 
   
   ?> 
</td>

<td>
   <?php echo CHtml::encode(Version::$object_labels[$data->object]); ?> 
</td>

<td>
   <?php 
   
   $instance=Version::model()->getObject($data->foreign_key, $data->object);
   //print_r($instance);
  if (isset($instance['name'])){
    
 
        $object=Version::model()->instanceName($data->object, $data->foreign_id);
        
     $page = ($object['name']=='deleted')?'history'  :'view'  ;
         
     
?> 
        <a href="<?php echo UrlHelper::getPrefixLink('/')?><?php echo Version::$objects[$data->object]; ?>/<?php echo $page; ?>/id/<?php echo $data->foreign_id; ?>">
        <?php echo $object['number'].' '.$object['name'];?>
        </a>  
   <?php }  
      // echo CHtml::encode($instance['name']) ;
   if ($data->object==9)
   {
   echo 'Action: '.Version::model()->wikiOutput($instance['text'],0).'<br />';
    echo 'Result: '.Version::model()->wikiOutput($instance['result'],0).'<br />';
    ?> 
        <a href="<?php echo UrlHelper::getPrefixLink('/step/view/id/')?><?php echo $data->foreign_id; ?>">
        View Use Case
        </a>  
   <?php
   }
   ?> 
</td>


</tr>