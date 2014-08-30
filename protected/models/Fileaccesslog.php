<?php

/**
 * This is the model class for table "fileaccesslog".
 *
 * The followings are the available columns in table 'fileaccesslog':
 * @property string $timeStamp
 * @property string $action
 * @property integer $fileAccessLogId
 * @property integer $assetId
 * @property integer $uId
 */
class Fileaccesslog extends CActiveRecord
{
	public $oldAttributes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fileaccesslog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timeStamp, action, assetId, uId', 'required'),
			array('assetId, uId', 'numerical', 'integerOnly'=>true),
			array('action', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('timeStamp, action, fileAccessLogId, assetId, uId', 'safe', 'on'=>'search'),
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
			'asset'=>array(self::BELONGS_TO,'Asset','assetId'),
			'users'=>array(self::BELONGS_TO,'Users','uId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'timeStamp' => 'Time Stamp',
			'action' => 'Action',
			'fileAccessLogId' => 'File Access Log',
			'assetId' => 'Asset',
			'uId' => 'U',
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

		$criteria->compare('timeStamp',$this->timeStamp,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('fileAccessLogId',$this->fileAccessLogId);
		$criteria->compare('assetId',$this->assetId);
		$criteria->compare('uId',$this->uId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fileaccesslog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getAction(){
	  if($this->action == 'V')
	   return "View";
	  elseif($this->action=='CI')
	   return "Checkin";
	 elseif($this->action=='CO')
	   return "Checkout";
	  elseif($this->action=='I')
	   return "initial";
	 elseif($this->action=='D')
	   return "Download";
	
		
	}
	//get model name
	public function getModelName(){
		return __CLASS__;
	}
	
	//get oldAttributes
	public function afterFind(){
    	 $this->oldAttributes = $this->attributes;
   		 return parent::afterFind();
	}
	
	 //adding details to log the cheanges   
    public function afterSave()
    {
    	$Log = Logger::getLogger("accessLog");
    	if($this->assetId != $this->oldAttributes['assetId'])
	 	{$Log->info("assetId ".$this->oldAttributes['assetId']." ".$this->assetId);}
    	if($this->uId != $this->oldAttributes['uId'])
	 	{$Log->info("userId ".$this->oldAttributes['uId']." ".$this->uId);}
   		 if($this->action != $this->oldAttributes['action'])
	 	{$Log->info("action ".$this->oldAttributes['action']." ".$this->action);}
    	return parent::afterSave();
    }	
	
	
}
