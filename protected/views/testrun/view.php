<?php
Yii::App()->session['setting_tab']='testcases';
echo $this->renderPartial('/project/head');

  $config = array(
      );
 
      $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#popup',
        'config'=>$config,));
 
$data=  Testrun::model()->getTestRun($id);

?>
<a href="/project/view">Back to Test Cases</a>
<table> <thead>
    <th>Test Action</th>
    <th>
     Expected Result   
    </th>
    <th>
       Link 
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
                        if($teststep['link']!=''){
                        $link=explode('_',$teststep['link']);
                        if($link[1]==12)
                            {
                            // its an image
                          
                            
                            echo CHtml::link('view interface',array('/iface/preview/id/'.$link[2].'/release/'.$link[1]),array('id'=>'popup'));
                           // echo '<a id="popup" href="'.$src.'">view image</a>';
                            }
                            if($link[1]==3)
                                //its a form
                            {
                          echo CHtml::link('view formproperty',array('/formproperty/preview/id/'.$link[2]),array('id'=>'popup'));
                             //echo $teststep['link'];      
             
                            }   
                            if($link[1]==1) 
                            {
                           echo CHtml::link('view rule',array('/rule/preview/id/'.$link[2]),array('id'=>'popup'));
                         
                            }
                        }
                        ?>
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






