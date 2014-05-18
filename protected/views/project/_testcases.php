<?php 
$release=Yii::App()->session['release'];
$project=Yii::App()->session['project'];
$testcases=  Testcase::model()->findAll('project_id='.$project);
foreach($testcases as $testcase){

?>
<p>
Name: <?php echo $testcase['name'] ?><br />

<?php
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
}
?>


