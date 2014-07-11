
<?php 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$data = Actor::model()->getProjectActors(Yii::app()->session['project']);


    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Alias</th>
                    <th>Inherits</th>
    
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                            <?php echo $item['name'];?>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>   
                       <td>   
                        <?php echo $item['alias'];?>
                    </td>                  
                    <td>   
                        <?php echo($item['inherits']!=-1)? $item['iname'] : '';?>
                    </td>   
  

                  
                    <td>
                      <?php if($edit){ ?>
                     <a href="/actor/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                     <a href="/actor/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                     <a href="/actor/history/id/<?php echo $item['actor_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version History"></i></a> 
                      <?php  } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif; ?>

