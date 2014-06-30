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
			array('message, scope, show_once', 'required'),
			array('show_once', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>255),
			array('scope, exclude', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, message, scope, exclude, condition, show_once', 'safe', 'on'=>'search'),
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
			'scope' => 'Scope',
			'exclude' => 'Exclude',
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

		$criteria=new CDbCriteria;

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

    if (isset(Yii::app()->user->id)) {
      $criteria = new CDbCriteria;
      $criteria->join = "LEFT JOIN user_meta a ON t.id = a.alert_messages_id and a.user_id =:user_id";
      $criteria->condition = "a.id is null";
      $criteria->params = array(':user_id' => Yii::app()->user->id);
      $messages = Messages::model()->findAll($criteria);
      $alerts_limit = min(5, count($messages)); //number of alters to display on a page

      foreach ($messages as $message) {
        // set up the message in session
        if (self::checkVisibility($message)) {
          //$alert_messages[] = $message->message;
          //$ids[] = $message->id;
          //class="icon-'. $message->message_type .'-sign" 
          Yii::app()->user->setFlash($message->message_type, '<i data-id="'. $message->id .'"></i>' . $message->message);
        }

        if (count($alert_messages) >= $alerts_limit)
          break;
      }
      /*if ($alert_messages) {
        Yii::app()->user->setFlash('info', '<i class="icon-info-sign"></i>' . implode('<br/><i class="icon-info-sign"></i>', $alert_messages));
        Yii::app()->clientScript->registerScript('alert_message_ids', 'var alert_message_ids = "' . implode(',', $ids) . '";');
      }*/
    }
  }
        
        //checks the visiblity of message for a particular page/scope
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

      if ($message->show_once==1) //prevent write to database if the flag is already set
        UserMeta::model()->createUserMeta($message->id,0);

      return true;
    }else
      return false;
  }

  private static function runCode($code) {
            
            if(!$code)
                return false;
            
            //var_dump(eval($code)); exit;
            return eval($code);
        }
}
