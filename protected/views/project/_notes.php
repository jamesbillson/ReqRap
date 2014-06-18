
<?php 

$permission=(Yii::App()->session['permission']==1)?true : false; 

$data = Note::model()->findAll('release_id='.Yii::app()->session['release']);
$counter=1;

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Notes',
    'headerIcon' => 'icon-comments',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Notes</th>

                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
                
              if($item->object>0)  {
                  $object=Version::model()->instanceName($item->object, $item->instance);
                   
              }
                ?>
                <tr class="odd">  
                   
             
                    <td>    
                        <b>
                    <?php 
                    echo $counter.'. '.$item['subject'];
                    if($item->object>0)
                        {
                        ?> 
                            <a href="/<?php echo Version::$objects[$item->object]; ?>/view/id/<?php echo $item->instance; ?>">
                                            <?php echo $object['number'].' '.$object['name'];?>
                            </a>    
                       <?php } ELSE {
                         echo ' - General';   
                        }
?>
                        </b>
                        <?php echo $item['text'];?>
                   
                    </td>            
                    <td>
                         <?php if($permission){ ?>
                        <a href="/note/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/note/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                       
                           

                         <?php } ?>
                    </td>
                </tr>
            <?php $counter++; endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>
 
