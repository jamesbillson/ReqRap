<?php 



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Documents',
    'headerIcon' => 'icon-book',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Document',
        'url'=>UrlHelper::getPrefixLink('/document/create?id=').Yii::app()->session['project'],
    ),
    
)
)); 
?>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Version</th>
                <th>Actions</th>
            </tr>
            </thead>
            
            <tbody>
                
                
  <?php   
  $types = Documenttype::model()->findAll('company_id='.User::model()->myCompany());
 if (count($types)):
     foreach($types as $type):
      $data = Document::model()->getDocs(Yii::app()->session['project'],$type['id']);
    if (count($data)):
        ?>
    <tr class="odd">  
                    <td colspan="4">   
                        <?php echo $type['name'];?>
                    </td>
                 
                </tr>
       
 <?php
            foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>
                    <td>   
                        <?php echo $item['version'];?>
                    </td>
                    <td>
                        <a href="<?php echo UrlHelper::getPrefixLink('/document/view/id/')?><?php echo $item['docid'];?>"><i class="icon-eye-open" rel="tooltip" title="View Document History"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/documentversion/download/id/')?><?php echo $item['version_id'];?>"><i class="icon-download-alt" rel="tooltip" title="Download this Document"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/documentversion/create/id/')?><?php echo $item['docid'];?>"><i class="icon-upload" rel="tooltip" title="Upload New Version"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/document/remove/id/')?><?php echo $item['docid'];?>/project/<?php echo $model->id;?>"><i class="icon-remove-sign" rel="tooltip" title="Remove Document"></i></a> 
                    </td>
                </tr>
            <?php
            endforeach;
                 endif;
           endforeach;
                endif; ?>
            </tbody>
        </table>
  
<?php $this->endWidget(); ?>