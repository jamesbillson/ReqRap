<h1><?php echo $model->company->name; ?></h1>
<h2><?php echo $model->name; ?></h2>
(/Project / External View)<br />
<br />
<?php
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Documents',
	'headerIcon' => 'icon-book',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      ));     
 
 $types = Documenttype::model()->findAll('company_id='.$model->company->id);
 if (count($types)):
     foreach($types as $type){
      $data = Document::model()->getDocs($model->id,$type['id']);
 

if (count($data)):?>

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
             <tr class="even">  
                    <td colspan="4">   
                        <?php echo $type['name'];?>
                    </td>
                 
                </tr>

        <?php foreach($data as $item) {?>
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
                   <a href="/documentversion/download/id/<?php echo $item['version_id'];?>"><i class="icon-download-alt" rel="tooltip" title="Download this Document"></i></a> 
                      
               
                 
            
            </td>
        </tr>
       <?php }
       endif;
     }?>
   	</tbody>
</table>

<?php
endif;
$this->endWidget();
   ?>
