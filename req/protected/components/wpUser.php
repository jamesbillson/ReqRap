<?php
class wpUser extends CWebUser implements IWebUser, IApplicationComponent {
        public function init ()
        {
            parent::init();
        }
        function checkAccess ($operation, $params = array()) {
            return current_user_can($operation);
        }

        public function getId() {
            return get_current_user_id();
        }
        public function getIsGuest () {
            $is_user_logged_in = is_user_logged_in();
            return ! $is_user_logged_in;
        }

        public function getName () {
            $user = User::model()->findByPK($this->getId());
            $name = '';
            if ($user) {
                $name = $user->firstname.' '.$user->lastname;
            }
            return $name;
        }

        public function getDeveloper () {
            $user = User::model()->findByPK($this->getId());
            $developer = '';
            if ($user) {
                $developer = $user->developer;
            }
            return $developer;
        }

        public function loginRequired() {
            wp_login_form(array('redirect' => Yii::app()->getRequest()->getUrl()));
        }
    }
?>