<?php
/* @var $this SiteController */
$company=User::model()->myCompany();



if($company!='-1') {
    $model=Company::model()->findbyPK($company);
    $type=User::model()->myCompanyType();
}ELSE{ 
  
$this->redirect(array('company/mycreate'));
    
}

$this->pageTitle=Yii::app()->name; ?>

<div class="row well">
    <div class="span6">
    <h1><?php echo $model->name; ?></h1>
    <?php echo $model->description; ?>
</div>
  <div class="span5 pull-right">
        <?php 
        
        if($model->logo_id !=''&& file_exists(UrlHelper::getPath($model->logo_id)) ) {
        $src = Yii::app()->easyImage->thumbSrcOf(
  UrlHelper::getPath($model->logo_id), array('resize' => array('width' => 150)));
        } else { 
          $src="/req/images/furniture/logo.png";
        }
        ?>
 
      <img src="<?php echo $src;?>" align="right">
  </div>    
<br />
</div>
<?php 





// FOLLOWER INVITATIONS
$status = array('pending','following');
$projects = Follower::model()->getMyProjectFollows(0);
$packages = Follower::model()->getMyPackageFollows(0);

        if (count($projects) || count($packages)):

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Project Team Invitations',
	'headerIcon' => 'icon-user',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>

<table class="table">
	<thead>
	<tr>
            <th>Company</th>
		<th>Project/Package</th>
		<th>Invited</th>
		<th>Actions</th>
	
	</tr>
	</thead>
        <tbody>

        <?php // loop through the projects 
        
        foreach($projects as $item) {
        
           
            
            
            ?>
        <tr class="odd">  
        <td>   
        <?php echo $item['cname'];?>
        </td>
        <td>   
        <?php echo $item['pname'];?>
        </td>
        <td>
            <?php echo $item['modified_date'];?>
      </td>
        <td>
          <a href="<?php echo UrlHelper::getPrefixLink('/follower/accept?id=')?><?php echo $item['link'];?>"><i class="icon-thumbs-up" rel="tooltip" title="Accept"></i></a>
            <a href="<?php echo UrlHelper::getPrefixLink('/follower/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Ignore"></i></a> 
       
            
            </td>
        </tr>
       <?php }?>
        
          <?php // loop through the packages
          
          
          foreach($packages as $item) {
           
             $name=$item['name'];       
            
            
            ?>
        <tr class="odd">  
        <td>   
        <?php echo $item['name'];?>
        </td>
         <td>
            <?php echo $item['modified_date'];?>
      </td>
        <td>
          <a href="<?php echo UrlHelper::getPrefixLink('/follower/accept?id=')?><?php echo $item['link'];?>"><i class="icon-thumbs-up" rel="tooltip" title="Accept"></i></a>
            <a href="<?php echo UrlHelper::getPrefixLink('/follower/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Ignore"></i></a> 
       
            
            </td>
        </tr>
       <?php }?>
        
        
   	</tbody>
</table>

<?php
$this->endWidget();
endif;
// END FOLLOWER INVITATIONS



?>


<?php 
// FOLLOWs
$status = array('pending','following');
$projects = Follower::model()->getMyProjectFollows(1);
$packages = Follower::model()->getMyPackageFollows(1);

        if (count($projects) || count($packages)):

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Other\'s Projects I am Following',
	'headerIcon' => 'icon-briefcase',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>

<table class="table">
	<thead>
	<tr>
	<th>Company</th>	
            <th>Project/Package</th>
		
		<th>Actions</th>
	
	</tr>
	</thead>
        <tbody>

        <?php // loop through the projects 
        
        foreach($projects as $item) {
         $name=$item['pname'];
           
            
            
            ?>
        <tr class="odd">  
                    <td>   
        <?php echo $item['cname'];?>
        </td>
        <td>   
         <a href="<?php echo UrlHelper::getPrefixLink('/project/set/id/')?><?php echo $item['id'];?>"><?php echo $item['pname'];?></a>
        </td>

        <td>
            <a href="<?php echo UrlHelper::getPrefixLink('/follower/delete?id=')?><?php echo $item['fid'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
       
            
            </td>
        </tr>
       <?php }?>
        
          <?php // loop through the packages
          
          
          foreach($packages as $item) {
           
             $name=$item['name'];       
            
            
            ?>
        <tr class="odd">  
        <td>   
        <?php echo $item['cname'];?>
        </td>
    <td>   
        <a href="<?php echo UrlHelper::getPrefixLink('/package/view?id=')?><?php echo $item['id'];?>&tab=bidder"><?php echo $item['pname'];?> - <?php echo $item['name'];?></a>
        </td>
        <td>
          
            <a href="<?php echo UrlHelper::getPrefixLink('/follower/delete?id=')?><?php echo $item['fid'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
       
            
            </td>
        </tr>
       <?php }?>
        
        
   	</tbody>
</table>

<?php
$this->endWidget();
endif;
// END FOLLOWS

$user_id=Yii::App()->user->id;
?>

<div class="row">
<div class="span6">
<?php
$bids = Project::model()->MyProjects(1);
if(!empty($bids)) {
    
     $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Projects', 'icon'=>'star-empty', 'url'=> UrlHelper::getPrefixLink('project/myrequirements')),
      
       ),
    
));  
};

$construction = Project::model()->MyProjects(2);
if(!empty($construction))  {
    
     $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
         array('label'=>'Testing', 'icon'=>'star-empty', 'url'=>UrlHelper::getPrefixLink('project/myprojects')),
     
       ),
));  
};
    
    



if(empty($tenders) && empty($construction)  && empty($bids) && $type !=4){
    // THE COMPANY HAS NO PROJECTS, AND IS NOT A CONSULTANT.
 $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create a Project +',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=> UrlHelper::getPrefixLink('project/create')
));
    echo '<br /><br />';
};

 $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Contacts', 'icon'=>'star-empty', 'url'=> UrlHelper::getPrefixLink('contact/mycontacts')),
        array('label'=>'Companies', 'icon'=>'star-empty', 'url'=> UrlHelper::getPrefixLink('company/mycompanies')),
         ),
    
   
));  

  $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
    
        array('label'=>'My Company Settings', 'icon'=>'cog', 'url'=> UrlHelper::getPrefixLink('company/mycompany')),
       ),
    )); 
if($user_id==121 || $user_id==140)   {
    
     $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
         array('label'=>'User Report', 'icon'=>'user', 'url'=> UrlHelper::getPrefixLink('user/view')),
     
       ),
));  
}
  echo '<!-- USER_ID:'.$user_id.' -->';
 ?>    
</div>

    </div>

