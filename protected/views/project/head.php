<?php 
if (!isset($tab)) $tab='usecases';
$mycompany=User::model()->myCompany();
$projectlist=Company::model()->getProjects($mycompany);
$followlist = Follower::model()->getMyProjectFollows(1);

$my_project=true;
if(isset(Yii::App()->session['project'])) {
    $project=Project::model()->findbyPK(Yii::App()->session['project']); 
    $currentrelease=Release::model()->currentRelease();
    $release=Yii::App()->session['release'];
    $thisrelease=Release::model()->findbyPK($release);
    $phase=$thisrelease->status;
    Project::model()->setPermissions($mycompany, $project,$release, $currentrelease);
     if ($currentrelease==$thisrelease->id) {
      Yii::App()->session['edit']=1;   
     } ELSE {
      Yii::App()->session['edit']=0;   
     }
} ELSE {
    $my_project=false;
    Yii::App()->session['edit']=0;
    Yii::App()->session['permission']=0;
}
$edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;

      $config = array(
      );
 
      $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#popup',
        'config'=>$config,));
 
      
echo '<!--project is '.Yii::App()->session['project'].' release is '.Yii::App()->session['release'].' permissions '.Follower::$type[Yii::App()->session['permission']].' ('.Yii::App()->session['permission'].')-->';
     

if (Yii::App()->user->id==140){
echo 'project is '.Yii::App()->session['project'].' current release is '.$currentrelease.' release is '.Yii::App()->session['release'].' permissions '.Follower::$type[Yii::App()->session['permission']].' ('.Yii::App()->session['permission'].')';
echo '<br /> tab: '.$tab. ' edit permissions are '.$edit;}
if (Yii::App()->session['permission'] ==0)  $this->redirect(array('site/fail/condition/no_access_head'));
?>
<div class="row">
    <div class="span6">
     <h1> <?php if ($my_project) echo $project->name  ; ?></h1> 
    </div> 
    
    <div class="span6">  
             <div class="row">
            <form action="/project/set/">
            <input type="hidden" name="tab" value="details">
            <select name="id" onchange="this.form.submit()">

            <option>Change Project</option>
            <?php 
            foreach($projectlist as $proj)
            {?>
            <option value="<?php echo $proj['id']; ?>"> <?php echo $proj['name'];?></option>
            <?php
            }
            foreach($followlist as $follow){?>
                    <option value="<?php echo $follow['id']; ?>"> <?php echo $follow['pname'];?></option>
            <?php } ?>
            </select>
            </form>
            </div>
          <div class="row">
        
        <?php  if(isset($currentrelease) && $release != $currentrelease)   {
             $releaseNumber = Release::model()->findbyPK($release);
       echo '( R-'.FLOOR($releaseNumber->number).' )';
       
         }
        ?>
            <?php if(isset($currentrelease) && $release == $currentrelease) {?>
    <a href="/project/project/">
           <?php
    $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Project',
    )); ?>
    </a>
            <?php }  ?>
             <?php if(isset($currentrelease) && $release != $currentrelease){ ?>
    <a href="/release/setcurrent/">
        
     <?php
    $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Settings',
    )); ?>
        
    </a> 
    <?php } ?>
    <a href="/project/view/">
         <?php
                 
                 $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info',
    // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Model',
                  
)); ?>
        
        
    </a>  
                
       <?php        
    if(($phase==2)){
      
      ?>
    <a href="/project/testing/">
         <?php
    $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Testing',
    )); ?>
    </a>
     
    <a href="/project/walkthru/">
        <?php
    $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Walk Through',
    )); ?>
    </a>
        <?php } ELSE { ?>
  
            <?php
    $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Walk Through',
    )); ?>         
     <?php
    $this->widget('bootstrap.widgets.TbLabel', array(
    'type'=>'', // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Testing',
    )); ?>      
        <?php } ?>
           
            
                <?php
  
    if($my_project){  ?>
          <a target="_new" href="/project/print" ><i class="icon-print " rel="tooltip" title="View Print Version"></i></a>
       
    <?php  } ?>



          
    
       <?php
  
       
      $config = array(
      );
 
      $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#popup',
        'config'=>$config,));
 
      
         
       
       
    if(isset($link)){ 
        //echo $link;
        ?>
          <a id="popup" href="/note/create/id/<?php echo $link; ?>" >
              <i class="icon-comment" rel="tooltip" title="Make a Note"></i></a> 
    <?php if(count(Note::model()->getNotes($link))) {?>      
            <a href="/note/view/id/<?php echo $link; ?>" ><i class="icon-comments" rel="tooltip" title="View Notes"></i></a> 
      

    <?php  }} ?> 
    

            </div>       
</div>

</div>