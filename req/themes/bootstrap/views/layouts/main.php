<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<?php // Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/tabs.js'); ?>
    <!--
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css"> -->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/bootstrap.min.css'); ?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/font-awesome.min.css'); ?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/styles.css'); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
    
<?php

$font=1;
$cname='';
if (!empty(Yii::app()->user->id) || !empty(Yii::app()->user->company_id)){
   $company=User::model()->myCompany(Yii::app()->user->id);
   if($company>0){
    $cname=Company::model()->findbypk($company)->name;
    $namelength=  strlen($cname);
    $font=1.6*(15/$namelength);
    if ($font > 2.2)$font=2.2;
   }
   $img='<img src="'.UrlHelper::getPrefixLink('images/furniture/logo.png').'">';
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
                                       'label'=>'<img src="'.UrlHelper::getPrefixLink('images/furniture/logo.png').'">',
                                        'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>$cname,
                                        'itemOptions'=>array('style'=>'font-size:'.$font.'em;'),
                                       'url'=>'',
                                       'visible'=>!Yii::app()->user->isGuest),
				 array('label'=>'Home', 'url'=> UrlHelper::getPrefixLink(('/site/index'))),
                                 array('label'=>'Benefits',
                                       'url'=>(UrlHelper::getPrefixLink('site/benefits')),
                                       'visible'=>Yii::app()->user->isGuest),
                                 array('label'=>'Plans', 
                                        'url'=>(UrlHelper::getPrefixLink('site/plans')),
                                        'visible'=>Yii::app()->user->isGuest),
                                array('label'=>'Contacts',
                                        'visible'=>!Yii::app()->user->isGuest && $company>0,
                                        'items'=>array(
                                                      
                                                        array('label'=>'Contacts', 'url'=>UrlHelper::getPrefixLink('contact/mycontacts')),
                                                        array('label'=>'Companies', 'url'=>UrlHelper::getPrefixLink('company/mycompanies')),
                                                        
				)),
                             // Analyst Menu
                            array('label'=>'Projects',
                                        'visible'=>!Yii::app()->user->isGuest && $company>0,
                                        'items'=>array(
                                                         array('label'=>'Projects', 'url'=>UrlHelper::getPrefixLink('project/myrequirements')),
                                                        array('label'=>'Library', 'url'=>UrlHelper::getPrefixLink('library/view')),
				)),
         
                             // PM Menu
     
                            /*
                              array('label'=>'Costs',
                                           'visible'=>!Yii::app()->user->isGuest && User::model()->myCompanyType()==1,
                                             'items'=>array(
                                                        array('label'=>'Upload Costs', 'url'=>'/cost/upload'),
                                                        array('label'=>'Allocate Costs', 'url'=>'/cost/mycosts'),
				)),
                            */
                            
			),
		),
		
                     
            array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
                          
                          array('label'=>Yii::app()->user->name,
                                        'visible'=>!Yii::app()->user->isGuest && $company>0,
                                        'items'=>array(
                                                        array('label'=>'Logout ('.Yii::app()->user->name.')',
                                                                'url'=>UrlHelper::getPrefixLink('/site/logout'), 
                                                                'visible'=>!Yii::app()->user->isGuest),
                                                        array('label'=>'My Account', 
                                                            'url'=>UrlHelper::getPrefixLink('user/update')),
                                                        array('label'=>'My Company Settings', 
                                                            'url'=>UrlHelper::getPrefixLink('company/mycompany')),
                                                       
				)),
			 array('label'=>'Login', 
                                'url'=>(UrlHelper::getPrefixLink('site/login')), 
                               
                                'visible'=>Yii::app()->user->isGuest),
                                    ),
                
                        ) ,'<span class="pull-right">'.$img.'</span>',	
                            
                    ), 			
            )
 );
    
    ?>

<div class="container" id="page">
        
        <?php 
            Messages::getMessage();
            $this->widget('bootstrap.widgets.TbAlert', array(
                    'block'=>false, // display a larger alert block?
                    'fade'=>true, // use transitions?
                    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed  
                    'events' => array('click' => 'js:function(e) {
                            $.get("'. $this->createUrl(UrlHelper::getPrefixLink("messages/process?ids=")) .'"+$(e.target).next("i").attr("data-id"));
                        }'
                    )
                )
            );
        ?>
        
        <br/>
	<?php echo $content; ?>

	<div class="clear"></div>
	<div id="footernav" style="text-align:center;margin-top:50px">
          
    <a href="<?php echo UrlHelper::getPrefixLink('site/terms'); ?>">Term of Use</a> |
    <a href="<?php echo UrlHelper::getPrefixLink('site/privacy') ?>">Privacy</a> | <a href="<?php echo UrlHelper::getPrefixLink('site/contact') ?>">Contact</a>
        </div>
	<div id="footer" style="text-align:center">
          

            
            <br />
            
		Copyright &copy; <?php echo date('Y'); ?> by Billson Fisher Consulting P/L.<br/>
		All Rights Reserved.<br/>
            </font>
	</div><!-- footer -->

</div><!-- page -->
<div id="ajax-login" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="login-form" action="/req/site/login" method="post">        
          <div class="row" style="margin-top: 10px;">
            <div class="span1">email: </div>
            <div class="span2">    
                <input name="LoginForm[username]" id="LoginForm_username" type="text">                
                <span class="help-inline error" id="LoginForm_username_em_" style="display: none;"></span>            
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
              <div class="span1">password: </div>
              <div class="span2">
                  <input hint="" name="LoginForm[password]" id="LoginForm_password" type="password">                <span class="help-inline error" id="LoginForm_password_em_" style="display: none;"></span>            </div>
          </div>
          <div class="row" style="margin-top: 10px;"> 
              <div class="span3" style="width:230px;">
                  <input id="ytLoginForm_rememberMe" type="hidden" value="0" name="LoginForm[rememberMe]"><input name="LoginForm[rememberMe]" id="LoginForm_rememberMe" value="1" type="checkbox"> Remember me on this computer<br>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="ajax-login--btn" type="submit" name="yt0">Login</button>            
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-9104836-16', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ajax-login.js"></script>
</body>
</html>