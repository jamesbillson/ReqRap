<?php

$data=  Testrun::model()->getTestRun($id);?>

<table> <thead>
    <th>Test Action</th>
    <th>
     Expected Result   
    </th>
    <th>
       Status 
    </th>
    <th>
      Comment  
    </th>
   </thead>
   
   <tbody>
       <tr>
           <?php
            foreach($data as $teststep){
                $testresult=Testresult::model()->findbyPK($teststep['id']);
               
                
            ?>
           <td>
           
                    <?php echo $teststep['action'] ; ?>     
           </td>
           <td>
             <?php echo $teststep['result'] ; ?>  
           </td>
            <td>
                   
                <?php
              
    $this->widget('editable.EditableField', array(
        'type'      => 'select',
        'model'     => $testresult,
        'attribute' => 'result',
        'url'       => $this->createUrl('testresult/updateResult'), 
        'source'    => Editable::source(Testresult::$testresult, 'status_id', 'status_text'),
        //or you can use plain arrays:
        //'source'    => Editable::source(array(1 => 'Status1', 2 => 'Status2')),
        'placement' => 'right',
    ));
                 
?>
             
           </td>
            <td>
            
                
             <?php
    $this->widget('editable.Editable', array(
        'type'      => 'text',
        'name'      => 'comments',
        'pk'        => $teststep['id'],
        'text'      => $teststep['comments'],
        'url'       => $this->createUrl('testresult/updateResult'), 
        'title'     => 'Test Comment',
        'placement' => 'right'
    ));
?>
           </td>
       </tr>
       <?php
        }
        ?>
               <tr><td colspan="3"></td><td>
        <?php    
                       
            $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Finalise',
            'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            'url'=>array('testrun/finish/id/'.$id)
));
         ?>                 
                       
           </td></tr>
   </tbody>
       
</table>






