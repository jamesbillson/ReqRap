<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details')); 
?>    
<h3>Deleted Use Cases</h3>    




<?php 
$project=Yii::App()->session['project'];

        $deleted = Version::model()->getProjectDeletedVersions($project, 10);
        if (count($deleted)):?>



      
                <table class="table">
                <tbody>
                <?php foreach($deleted as $item) {?>
                   <tr class="odd">  
                        <td> <a href="<?php echo UrlHelper::getPrefixLink('/usecase/history/id/')?><?php echo $item['usecase_id'];?>"> 
                        <?php echo $item['name']; ?></a> 
                        </td>

                        <td> 
                        <?php echo $item['description']; ?>
                        </td>

                   </tr>
                <?php }?>
                </tbody>
                </table>   
               
        <?php  endif; 

?> 
