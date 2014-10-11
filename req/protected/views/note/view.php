
<?php 
// NOTES VIEW
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 
if($link[1]>0) { ?>
<a href="/<?php echo Version::$objects[$link[1]]; ?>/view/id/<?php echo $link[2]; ?>">
 Back to <?php echo Version::$objects[$link[1]]; ?>
 </a>
<?php

}
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Notes',
    'headerIcon' => 'icon-comments',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
 //$link=explode('_',$link);
  // object= $link[1]
  // instance= $link[2]
?>
    
    <table> 
         <?php if(isset($model)): ?>
         <?php foreach($model as $item): ?>
        <tr>
            <td>
                <strong><?php echo $item->subject ?> </strong> 
                <br />
                       <?php echo $item->text ?>
                   </td>
                     <td>
                      <?php //if($permission){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/note/update/id/')?><?php echo $item->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/note/delete/id/')?><?php echo $item->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                          <?php //} ?>
                   </td>
                <?php endforeach ?>
         
        </tr>
    </table> 
  <?php endif ?>
   <?php $this->endWidget(); ?>


  


