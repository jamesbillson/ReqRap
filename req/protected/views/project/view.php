
<?php 
$release=Yii::App()->session['release'];
$tab=Yii::App()->session['setting_tab'];
$link=$release.'_0_0';
$permission=Yii::App()->session['permission'];
if ($permission<1 || $permission>5) $permission=1;
$phase=Release::model()->findbyPK($release)->status;
if ($tab=='' && $permission==1) $tab='usecases';
if ($tab=='' && $permission==3) $tab='structure';
if ($tab=='details' || $tab=='walkthru') $tab='usecases';
echo $this->renderPartial('/project/head',array('tab'=>$tab,'link'=>$link)); 
if ($tab=='photos') $tab='interfaces';
//echo 'TAB IS: '.$tab;
?>

<?php 

if ($permission==1 ) $this->renderPartial('_contributor',compact('model','actorstring','tab','permission','phase'));
if ($permission==3 ) $this->renderPartial('_approver',compact('model','actorstring','permission','tab','phase'));
if ($permission==2 ) $this->renderPartial('_tester',compact('model','actorstring','permission','tab','phase'));
if ($permission==5 ) $this->renderPartial('_developer',compact('model','actorstring','permission','tab','phase'));

?>

