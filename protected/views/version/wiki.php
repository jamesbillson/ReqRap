<?php


$input='Actor [[BR:6]]   abeae  abe   .';

$output=Version::model()->wikiInput($input,9,879);
?>

<?php
echo $output ;
?>
<br />string <br />
Actor [[BR-006-A new Rule]]   abeae  abe   .
