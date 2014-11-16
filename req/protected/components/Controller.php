<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    /**
     * Class constructor
     *
     */
    
    protected function beforeAction($action)
	{
$controller=Yii::app()->controller->id;
$action=$action->id;
     if (!($controller == 'user' && $action == 'join') && 
         !($controller == 'user' && $action == 'accept') &&
         !($controller == 'user' && $action == 'active') &&
         !($controller == 'user' && $action == 'welcome') &&
         !($controller == 'user' && $action == 'joinsuccess') &&
         !($controller == 'user' && $action == 'joinfollower') &&
         !($controller == 'follower' && $action == 'accept') &&
         !($controller == 'project' && $action == 'extview') &&
         !($controller == 'documentversion' && $action == 'download') &&
         !($controller == 'site' && $action == 'terms') &&
         !($controller == 'site' && $action == 'benefits') &&
         !($controller == 'site' && $action == 'contact') &&
         !($controller == 'site' && $action == 'features') &&
         !($controller == 'site' && $action == 'principles') &&
         !($controller == 'site' && $action == 'gettingstarted') &&
         !($controller == 'site' && $action == 'plans') &&
         !($controller == 'site' && $action == 'support') &&
         !($controller == 'site' && $action == 'fail') &&
         !($controller == 'site' && $action == 'privacy') &&
         !($controller == 'site' && $action == 'manage_drawings_and_tenders_online') &&
         !($controller == 'site' && $action == 'manage_construction_online') &&
         !($controller == 'site' && $action == 'login') &&
         !($controller == 'site' && $action == 'forgotpassword') &&
         !($controller == 'site' && $action == 'newpassword') &&
         !($controller == 'reset' && $action == 'index') &&
         !($controller == 'reset' && $action == 'success') && 
         !($controller == 'ajax' && $action == 'login')
             )
         {

            if (Yii::app()->user->isGuest){
                $this->redirect('/register');
            }
        }      
  
        return parent::beforeAction($action);
	}
}