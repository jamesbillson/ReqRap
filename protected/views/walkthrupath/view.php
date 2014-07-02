<?php 
Yii::App()->session['setting_tab']='walkthru';
echo $this->renderPartial('/project/head'); ?>
<h3>Walkthrough</h3>
    
<?php 
if(!empty($model->usecase_id))
    {
    $usecase=Usecase::model()->findbyPK($model->usecase_id);
    $title=Version::model()->instanceName(10, $usecase->usecase_id);
?>
   
        
<br>
<?php 
$data= Walkthrustep::model()->findAll('walkthrupath_id='.$model->id);

?>
<a href="/project/project">Walk through list</a><br />


<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Walk Through Path: <a href="/usecase/view/id/'.$usecase->usecase_id.'">'.$title['number'].' '.$title['name'].'</a>',
    'headerIcon' => 'icon-check',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
          
           )
));?>

<?php
      $config = array(
      );
 
      $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#popup',
        'config'=>$config,));
 
      
         ?>

           
            
<?php  if (count($data)):?>

        <table class="table">

               <thead>
                <tr>
                    
                    <th>Number</th>
                    <th>Action</th>
                    <th>Result</th>
                </tr>
            </thead>
            
            <tbody>
         
            <?php foreach($data as $item):?>
                <tr class="odd">  
      <td>   
                        <?php echo $item['number'];?>
                    </td>      

                    <td>   
                        <?php echo $item['action'];?>
                    </td>                  
                     <td>   
                        <?php 
                        $link=explode('_',$item['result']);
                        if($link[0]=='#image#')
                            {
                            // its an image
                          
                            
                            echo CHtml::link('view interface',array('/iface/preview/id/'.$link[3].'/release/'.$link[1]),array('id'=>'popup'));
                           // echo '<a id="popup" href="'.$src.'">view image</a>';
                            }
                            if($link[0]=='#form#')
                            {
                          echo CHtml::link('view form',array('/form/preview/id/'.$link[3]),array('id'=>'popup'));
                                   
             
                            }   
                            if($link[0]!='#form#' && $link[0]!='#image#') 
                            {
                            echo $item['result'];
                            }
                        ?>
                    </td>  

                  

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
    }?>


<?php echo $this->renderPartial('run', array('id'=>$model->id)); ?>