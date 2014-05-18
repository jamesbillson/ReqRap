<?php 
$release=Yii::App()->session['release'];
$project=Yii::App()->session['project'];
$testcases=  Testcase::model()->findAll('release_id='.$release);
foreach($testcases as $testcase){

?>




<p>
Test Case TC-<?php echo str_pad($testcase['number'], 4, "0", STR_PAD_LEFT) ?>Name: <?php echo $testcase['name'] ?><br />
 <a href="/release/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
    
<?php

/*
$teststeps=  Teststep::model()->findAll('testcase_id='.$testcase['id']);
foreach($teststeps as $teststep){

?>
<blockquote>
Step Action: <?php echo $teststep['action'] ?><br />
Step Result: <?php echo $teststep['result'] ?><br />
</blockquote>
</p>
<?php
}

 * 
 * 
 */

}
?>


