<?php
$types = Interfacetype::model()->getInterfacetypes(); 
if (Version::model()->objectCount(12)!=0){
$show=0;
    ?>


<?php 
$subheading=1;
// load all the categories

foreach($types as $type){
$ifacedetails = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
if (count($ifacedetails)):
// If there are intefaces in the category print the category title.
 //   echo '<h3>'.$heading.'.'.$subheading.' '.$type['name'].'</h3>';
$showsubhead=0;
    ?>

<?php foreach($ifacedetails as $ifacedetail):
    $image=Iface::model()->getCurrentImage($ifacedetail['iface_id'],Yii::App()->session['release']);
    
    ?>
        <?php if (count($image))echo '<div style="page-break-before: always;"></div>'; ?>
 
 <?php if ($show==0){
    echo '<h2>'.$heading.'. Interfaces</h2>'; 
    $show=1;
    
    }
?>

    <?php if ($showsubhead==0){
    echo '<h3>'.$heading.'.'.$subheading.' '.$type['name'].'</h3>'; 
    $showsubhead=1;
    
    }
?>

<h3> IF-<?php echo str_pad($ifacedetail['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $ifacedetail['name'];?></h3>
<?php echo $ifacedetail['text'];?><br /><br />
<?php if (count($image)){ ?>
<?php
 if(is_file(Yii::app()->basePath.'/../'.'uploads/images/'.$image['file']))
                {

$src = UrlHelper::getPrefixLink('/uploads/images/'.$image['file']); ?>
<img src="<?php echo $src; ?>" width="600">
 <?php } ?>



<br />
    <?php 
}
$subheading++;
endforeach ?>
<?php 
endif;
}

}
?>

