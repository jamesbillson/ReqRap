 
  <?php 
  $category = Category::model()->findbyPK($id);
  ?>

    
        <h2><?php echo $heading.'. '.$category->name;?></h2>
        <?php echo $category->description;?>
             
        <?php 
$simples=  Simple::model()->getCategorySimple($category->category_id);
if (count($simples)):?>


            <?php foreach($simples as $simple):?>

        <h4><?php echo $heading.'.'.$simple['number'];?> <?php echo $simple['name'];?></h4>
        <?php echo $simple['description'];?>

            <?php endforeach ;
            endif;?>
        


