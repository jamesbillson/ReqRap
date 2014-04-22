 
    <?php 
  $categories = Category::model()->getProjectCategory(Yii::app()->session['project']);
      
    if (count($categories)):?>
<h2><?php echo $heading; ?>. Category</h2>
<?php $heading++; ?>
        <?php foreach($categories as $category):?>
        
        <h3>OB-<?php echo str_pad($category['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $category['name'];?></h3>
        <?php echo $category['description'];?>
             
        <?php endforeach ?>
        

        <?php foreach($categories as $category):
$simples=  Simple::model()->getCategorySimple($category['category_id']);

  if (count($simples)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Ref</th>
                    <th>Name</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($simples as $simple):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $simple['number'];?>
                    </td>
                    <td>   
                        <?php echo $simple['name'];?>
                    </td>
                    <td>   
                        <?php echo $simple['description'];?>
                    </td>                  
                   

                  
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
 endforeach ?>
        
    <?php endif; ?>

