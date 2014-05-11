<h2><?php echo $heading; ?>. Interfaces</h2>

<?php 
$subheading=1;
// load all the categories
$types = Interfacetype::model()->getInterfacetypes();
foreach($types as $type){
$ifacedetails = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
if (count($ifacedetails)):
// If there are intefaces in the category print the category title.
    echo '<h3>'.$heading.'.'.$subheading.' '.$type['name'].'</h3>';
?>

<?php foreach($ifacedetails as $ifacedetail):
    $image=Iface::model()->getCurrentImage($ifacedetail['iface_id']);
    
    ?>
<h3> IF-<?php echo str_pad($ifacedetail['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $ifacedetail['name'];?></h3>
<?php echo $ifacedetail['text'];?><br /><br />
<?php if (count($image)){ ?>
<img src="/uploads/images/<?php echo $image['file'];?>" width="600"><br />
<?php 
}
$subheading++;
endforeach ?>
<?php endif;
}?>

