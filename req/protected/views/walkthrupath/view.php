<?php 
Yii::App()->session['setting_tab']='walkthru';
echo $this->renderPartial('/project/head'); ?>
<h3>Walkthrough: WT-<?php echo str_pad($model->number, 4, "0", STR_PAD_LEFT) ?></h3>
    
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
<a href="/project/walkthru">Walk through list</a><br />


<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Walk Through Path: <a href="'.UrlHelper::getPrefixLink("/req/usecase/view/id/").''.$usecase->usecase_id.'">'.$title['number'].' '.$title['name'].'</a>',
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


<?php if(in_array(Yii::App()->session['permission'],array(1,3)))echo $this->renderPartial('run', array('id'=>$model->id)); ?>




<?php 

// Display all the existin comments.

$data= Walkthruresult::model()->findAll('walkthrupath_id='.$model->id);
 if (count($data)):

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Results',
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
  
));?>

        
            


        <table class="table">

               <thead>
                <tr>
                     <th>Result</th>                   
                    <th>Comments</th>
                    <th>Approver</th>

                </tr>
            </thead>
            
            <tbody>
         
            <?php foreach($data as $item):?>
                <tr class="odd">  
                   

                    <td>   
                        <?php echo Walkthruresult::$result[$item->result];?>
                    </td>                  
                                 <td>   
                        <?php echo $item->comments;?>
                    </td>  
                    <td>
                    <?php echo $item->user->firstname;?> 
                    <?php echo $item->user->lastname;?>
                    <?php echo $item->date;?>
                    </td>  
                  
              



</div>      
                           
            
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

     <?php
$this->endWidget(); 
endif;?>

