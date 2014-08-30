<?php

/**
 * This is the model class for table "asset_user_filep".
 *
 * The followings are the available columns in table 'asset_user_filep':
 * @property integer $id
 * @property integer $assetId
 * @property integer $uId
 * @property integer $fpId
 *
 * The followings are the available model relations:
 * @property Filepermission $fp
 * @property Asset $asset
 * @property Users $u
 */
class AssetUserFilep extends CActiveRecord
{
	
	public $oldAttributes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asset_user_filep';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, assetId, uId, fpId', 'required'),
			array('id, assetId, uId, fpId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, assetId, uId, fpId', 'safe', 'on'=>'search'),
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
			'fp' => array(self::BELONGS_TO, 'Filepermission', 'fpId'),
			'asset' => array(self::BELONGS_TO, 'Asset', 'assetId'),
			'u' => array(self::BELONGS_TO, 'Users', 'uId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'assetId' => 'Asset',
			'uId' => 'U',
			'fpId' => 'Fp',
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
		$criteria->compare('assetId',$this->assetId);
		$criteria->compare('uId',$this->uId);
		$criteria->compare('fpId',$this->fpId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AssetUserFilep the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
	
	 //adding details to log the asset save   
    public function afterSave()
    {
    	$Log = Logger::getLogger("accessLog");
    	
    	if($this->assetId != $this->oldAttributes['assetId'])
	 	{$Log->info("assetId ".$this->oldAttributes['assetId']." ".$this->assetId);}
    	if($this->uId != $this->oldAttributes['uId'])
	 	{$Log->info("uId ".$this->oldAttributes['uId']." ".$this->uId);}
    	if($this->fpId != $this->oldAttributes['fpId'])
	 	{$Log->info("fpId ".$this->oldAttributes['fpId']." ".$this->fpId);}
	 	return parent::afterSave();
    }
}
