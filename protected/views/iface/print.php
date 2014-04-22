<?php 

$ifacedetails = Iface::model()->getProjectIfaces(Yii::app()->session['project']);

if (count($ifacedetails)):?>

<h2><?php echo $heading; ?>. Interfaces</h2>
<?php $heading++; ?>
<?php foreach($ifacedetails as $ifacedetail):?>
<h3> IF-<?php echo str_pad($ifacedetail['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $ifacedetail['name'];?></h3>
<?php echo $ifacedetail['type'];?><br /><br />

<img src="/uploads/images/<?php echo $ifacedetail['file'];?>" width="600"><br />
<?php endforeach ?>
<?php endif;?>