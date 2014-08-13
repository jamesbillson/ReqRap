
<?php

$scores=  Usecase::model()->weight();
foreach ($scores as $id=>$score){
    
    echo 'UC '.$id.' has a weight of: '.$score.'<br/>';
    
}

?>