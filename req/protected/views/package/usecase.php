<?php
$this->layout = "//layouts/image";
$usecases = Usecase::model()->getPackageUsecases(836); 
if (count($usecases)): 


// Create a blank image and add some text
$im = imagecreatetruecolor(600, 1000);
$white = imagecolorallocate( $im, 255, 255, 255 );
// The second colour - to be used for the text
$black = imagecolorallocate( $im, 0, 0, 0 );
//$text_color = imagecolorallocate($im, 233, 14, 91);
imagefill($im,0,0,$white);

$font = 'arial.ttf';
$icon1 = imagecreatefrompng("actor.png");
$elipse = imagecreatefrompng("elipse.png");
// ... add more source images as needed
imagecopyresized($im, $icon1, 50, 500, 0, 0, 50, 100,230,460);
imagettftext($im, 20, 0, 10, 30, $black, $font, 'Package');
imagettftext($im, 20, 0, 50,620, $black, $font, 'Actor');
$number=count($usecases);
$pagey=($number*100)+100;
$actortop=($number/2)*100;
$actorhand=$actortop-50;
 
for($i=0; $i<=$number-1; $i++){
$usecase=$usecases[$i];
 $x=400-(pow((($i+1)-($number/2)),2)*10);
 $y=(($i+1)*100)-100;
 $linestart=(($number/2)*100)-50;
 $ytext = (($i+1)*100)+30;
 $xtext = $x+25;
 $elipsecentre=$y-50;
$text=$usecase['name'];

imagecopyresized($im, $elipse, $x, $y, 0, 0, 200, 100,500,250);
imageline ($im,100,545,$x,$y+50,$black);
imagettftext($im, 12, 0, $x+30, $y+40, $black, $font, $text);

}  


// Output the image
imagepng($im,'test.png');
// Free up memory
imagedestroy($im);

endif;
?>