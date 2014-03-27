
<?php 
$data = Actor::model()->getProjectActors(Yii::app()->session['project']);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Issues',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Actor',
        'url'=>'/actor/create/id/'.$model->id,
    ),
    
))); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Alias</th>
                    <th>Inherits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="/actor/view/id/<?php echo $item['actor_id'];?>">
                            <?php echo $item['name'];?>
                        </a>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>   
                       <td>   
                        <?php echo $item['alias'];?>
                    </td>                  
                    <td>   
                        <?php echo $item['inherits'];?>
                    </td>   
  

                  
                    <td>
                        <a href="/actor/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/actor/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                     <a href="/actor/history/id/<?php echo $item['actor_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version History"></i></a> 
                    
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

<?php $deleted = Version::model()->getProjectDeletedVersions($model->id,4);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionx" href="#collapsex">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapsex" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="/actor/history/id/<?php echo $item['actor_id'];?>"> 
                UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
                </td>
   
                <td> 
                <?php echo $item['name']; ?>
                </td>
    
           </tr>
        <?php }?>
    	</tbody>
        </table>   
            </div>
        </div>
    </div>
<?php  endif; ?>