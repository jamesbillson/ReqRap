<tr>
<td>
    <?php echo CHtml::link(CHtml::encode('Change #'.$data->number), array('view', 'id'=>$data->id)); ?>
</td>
<td>
    <?php echo CHtml::encode($data->release); ?>
</td>   
<td>
   <?php echo CHtml::encode(Version::$objects[$data->object]); ?> 
</td>
<td>
   <?php echo CHtml::encode(Version::$actions[$data->action]); ?> 
</td>
<td>
   <?php 
   if ($data->object == 1) {
       echo CHtml::encode($data->rule->title) ;
   }
   ?> 
</td>


</tr>