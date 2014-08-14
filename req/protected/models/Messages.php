<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property string $message
 * @property string $scope
 * @property string $exclude
 * @property string $condition
 * @property integer $show_once
 *
 * The followings are the available model relations:
 * @property UserMeta[] $userMetas
 */
class Messages extends CActiveRecord
{
    
    
       public static $formats = array(
            0 => 'notice',
            1 => 'success',
            2 => 'warning',
            3 => 'error'
           );
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message, scope, show_once, type', 'required'),
			array('show_once, type, message_type', 'numerical', 'integerOnly'=>true),
			array('scope, exclude', 'length', 'max'=>100),
			array('id, message, type, message_type, scope, exclude, condition, show_once', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userMetas' => array(self::HAS_MANY, 'UserMeta', 'alert_messages_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'message' => 'Message',
                    'message_type' => 'Message Type',
			'scope' => 'Scope',
			'exclude' => 'Exclude',
                        'type' => 'Type',
			'condition' => 'Condition',
			'show_once' => 'Show Once',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('scope',$this->scope,true);
		$criteria->compare('exclude',$this->exclude,true);
		$criteria->compare('condition',$this->condition,true);
		$criteria->compare('show_once',$this->show_once);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    public static function getTypes() {
        
        return array(
          1 => 'First View',
          2 => 'Code'
        );
    }
        
 	public static function getMessage() {
	    $ids = $alert_messages = array();
	    if (isset(Yii::app()->user->id)) 
	    {

	    	$user_id = Yii::app()->user->id;
	        $controller_name = Yii::app()->controller->id;
	        $action_name = Yii::app()->controller->action->id;
	        $page_visited = $controller_name.'/'.$action_name;
	        $user = User::model()->findByPk($user_id);

	     //   if ($user->getEavAttribute($page_visited) != 1) {
		   //     $user->setEavAttribute($page_visited, 1);
		     //   $user->save();

		    	$criteria = new CDbCriteria;
		      	$criteria->condition = "user_id =:user_id ";
		      	$criteria->condition = "scope = :scope ";
		      	$criteria->params = array(':user_id' => Yii::app()->user->id);
		      	$criteria->params = array(':scope' => $page_visited);

		      	$messages = Messages::model()->findAll($criteria);
		      	$alerts_limit = min(5, count($messages)); //number of alters to display on a page
	      
		        foreach ($messages as $message) {
		        if (self::checkVisibility($message)) {
		          Yii::app()->user->setFlash(Messages::$formats[$message->message_type], '<i data-id="'. $message->id .'"></i>' . $message->message);
		        }
		        if (count($alert_messages) >= $alerts_limit)
		          break;
		      	}
	      //	}
    	}
  	}
        
  	public static function checkVisibility(&$message) {
		$strExclude = preg_replace('/\*\//', Yii::app()->controller->id . '/', $message->exclude);
		$strExclude = preg_replace('/\*/', Yii::app()->controller->action->id, $strExclude);
		if (strpos($strExclude, Yii::app()->controller->id . '/' . Yii::app()->controller->action->id) !== FALSE) {
		  return false;
		}

		$str = preg_replace('/\*\//', Yii::app()->controller->id . '/', $message->scope);
		$str = preg_replace('/\*/', Yii::app()->controller->action->id, $str);

		if (strpos($str, Yii::app()->controller->id . '/' . Yii::app()->controller->action->id) !== FALSE
		        && (($message->condition=='') || (!isset($message->condition)) || (self::runCode($message->condition)))
		) {
			/*
		  	if ($message->show_once==1) {
				UserMeta::model()->createUserMeta($message->id,0);
			}   */
		    return true;
		}
    	return false;
  	}

  	private static function runCode($code) {
	    if(!$code)
	        return false;
	    return eval($code);
	}
}
