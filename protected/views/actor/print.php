<?php 
    require 'images/tree/treeToImage.php'; 
    $img = new TreeToImage();
?>
<h2>
    <?php echo $heading; ?>. Actors
</h2>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Aliases</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($actors as $actor):?>
        <tr class="odd">  
            <td>   
               <?php echo $actor['name'];?>
            </td>
            
            <td>   
                <?php echo $actor['description'];?>
            </td>   
            
            <td>   
                <?php echo $actor['alias'];?>
            </td>                  
            

        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<img src="<?php echo  Yii::app()->basePath.'/../'.$img->getImage($actorstring); ?>">
