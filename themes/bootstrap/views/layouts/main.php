<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<?php // Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/tabs.js'); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css">

    
      <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/bootstrap.min.css'); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php
$cname='';
if (!empty(Yii::app()->user->id) || !empty(Yii::app()->user->company_id)){
   $company=User::model()->myCompany(Yii::app()->user->id);
   if($company>0){
    $cname=Company::model()->findbypk($company)->name;
   }
   $img='<img src="/images/furniture/logo.png">';
}ELSE{
    $img='';
}
    $this->widget('bootstrap.widgets.TbNavbar', 
            array(
                    'brand'=>'',
                    'brandOptions' => array('style'=>'padding:0'),
                    'type'=>'',
                    'fluid'=>false,
                    'collapse'=>true,
	'items'=>array(
            
		array(
			'class'=>'bootstrap.widgets.TbMenu','encodeLabel'=>false,
			'items'=>array(
                                    array(
                                       'label'=>'<img src="/images/furniture/logo.png">',
                                        'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>$cname,
                                        'itemOptions'=>array('style'=>'font-size:1.6em;'),
                                       'url'=>'',
                                       'visible'=>!Yii::app()->user->isGuest),
				 array('label'=>'Home', 'url'=>array('/site/index')),
                                 array('label'=>'Benefits',
                                       'url'=>array('/site/benefits'),
                                       'visible'=>Yii::app()->user->isGuest),
                                 array('label'=>'Plans', 
                                        'url'=>array('/site/plans'),
                                        'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Contacts',
                                        'visible'=>!Yii::app()->user->isGuest,
                                        'items'=>array(
                                                      
                                                        array('label'=>'Contacts', 'url'=>'/contact/mycontacts'),
                                                        array('label'=>'Companies', 'url'=>'/company/mycompanies'),
                                                        
				)),
                             // Builder Menu
                            array('label'=>'Projects',
                                        'visible'=>!Yii::app()->user->isGuest && User::model()->myCompanyType()==1,
                                        'items'=>array(
                                                         array('label'=>'Projects', 'url'=>'/project/myprojects'),
                                                        array('label'=>'Library', 'url'=>'/library/view'),
				)),
         
                             // PM Menu
                            array('label'=>'Projects',
                                        'visible'=>!Yii::app()->user->isGuest && User::model()->myCompanyType()==3,
                                        'items'=>array(
                                                       
                                                        array('label'=>'Projects', 'url'=>'/project/myprojects'),
                                                        array('label'=>'Library', 'url'=>'/library/view'),
                                                        
				)),
                            
                              array('label'=>'Costs',
                                           'visible'=>!Yii::app()->user->isGuest && User::model()->myCompanyType()==1,
                                             'items'=>array(
                                                        array('label'=>'Upload Costs', 'url'=>'/cost/upload'),
                                                        array('label'=>'Allocate Costs', 'url'=>'/cost/mycosts'),
				)),
                            
                            
			),
		),
		
                     
            array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
                          
                          array('label'=>Yii::app()->user->name,
                                        'visible'=>!Yii::app()->user->isGuest,
                                        'items'=>array(
                                                        array('label'=>'Logout ('.Yii::app()->user->name.')',
                                                                'url'=>array('/site/logout'), 
                                                                'visible'=>!Yii::app()->user->isGuest),
                                                        array('label'=>'My Account', 
                                                            'url'=>'/user/update'),
                                                        array('label'=>'My Company Settings', 
                                                            'url'=>'/company/mycompany'),
                                                       
				)),
			 array('label'=>'Login', 
                                'url'=>array('/site/login'), 
                               
                                'visible'=>Yii::app()->user->isGuest),
                                    ),
                
                        ) ,'<span class="pull-right">'.$img.'</span>',	
                            
                    ), 			
            )
 );
    
    ?>

<div class="container" id="page">

	<br /><br />
	<?php echo $content; ?>

	<div class="clear"></div>
	<div id="footernav" style="text-align:center;margin-top:50px">
          
    <a href="/site/terms">Term of Use</a> |
    <a href="/site/privacy">Privacy</a> | <a href="/site/contact">Contact</a>
        </div>
	<div id="footer" style="text-align:center">
          

            
            <br />
            
		Copyright &copy; <?php echo date('Y'); ?> by Billson Fisher Consulting P/L.<br/>
		All Rights Reserved.<br/>
            </font>
	</div><!-- footer -->

</div><!-- page -->


</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-9104836-15', 'naild.com.au');
  ga('send', 'pageview');

</script>