<?php
$path =  Yii::getPathOfAlias('webroot');
   
$usecases = Usecase::model()->getPackageUsecases($package['package_id']); 

$actors = Actor::model()->getPackageActors($package['id']);
?>

<?php
if (count($usecases)): 
$number=count($usecases);
$numberactors=count($actors);


$ucheight=($number*100)+100; 
$actorheight=($numberactors*200)+100;
$imheight=($ucheight>$actorheight)?$ucheight : $actorheight ;

$im = imagecreatetruecolor(600, $imheight);
imageantialias ( $im , 'true' );
$white = imagecolorallocate( $im, 255, 255, 255 );


$black = imagecolorallocate( $im, 0, 0, 0 );


imagefill($im,0,0,$white);
imageline ($im,0,0,600,0,$black);
imageline ($im,0,0,0,$imheight,$black);
imageline ($im,0,$imheight-1,600,$imheight-1,$black);
imageline ($im,599,$imheight-1,599,0,$black);
$font = 'images/arial.ttf';
$actorimage = imagecreatefrompng("$path/images/actor.png");
$xsystemimage= imagecreatefrompng("$path/images/xsystem.png");
$elipse = imagecreatefrompng("$path/images/elipse.png");

imagettftext($im, 14, 0, 10, 30, $black, $font, $package['name']);
$yactor=array();


// ACTORS
for($i=0; $i<=$numberactors-1; $i++){
$actor=$actors[$i];
$yactor[$actor['actor_id']]=(($imheight/($numberactors+1))*$i)+100;
$sprite=($actor['type']==0)?$actorimage:$xsystemimage;
imagecopyresized($im, $sprite, 50, $yactor[$actor['actor_id']], 0, 0, 50, 100,230,460);

imagettftext($im, 14, 0, 50,$yactor[$actor['actor_id']]+115, $black, $font, $actor['name']);

}


for($i=0; $i<=$number-1; $i++){
$uc=$usecases[$i];

 $x=300-(pow((($i+1)-($number/2)),2)*10);
 $y=(($i+1)*100)-100+(($imheight-($number*100))/2);
 $linestart=(($number/2)*100)-50;
 $ytext = (($i+1)*100)+30;
 $xtext = $x+25;
 $elipsecentre=$y-50;
$ucnumber='UC-'.str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT);
$text=$uc['name'];

imagecopyresized($im, $elipse, $x, $y, 0, 0, 200, 100,500,250);

imagettftext($im, 10, 0, $x+30, $y+40, $black, $font, $ucnumber);
imagettftext($im, 10, 0, $x+30, $y+55, $black, $font, $text);


//find UC actors
$ucactors = Usecase::model()->getUsecaseActors($uc['id']);
for($a=0; $a<=count($ucactors)-1; $a++){
$ucactor=$ucactors[$a];
imageline ($im,100,$yactor[$ucactor['actor_id']]+35,$x,$y+50,$black);
}

}  


// Output the image
imagepng($im,"$path/images/".$package['id']."test.png");
// Free up memory
imagedestroy($im);

endif;
?>


<br />

<img src="<?php echo  'http://'.Yii::app()->params['server'].'/req/images/'.$package['id'] ?>test.png">

 <?php  // endforeach;
  //  endif; ?>  