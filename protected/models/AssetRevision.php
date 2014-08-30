<?php

/**
 * This is the model class for table "asset_revision".
 *
 * The followings are the available columns in table 'asset_revision':
 * @property integer $assetId
 * @property string $modifiedOn
 * @property integer $modifiedBy
 * @property string $note
 * @property string $revision
 *
 * The followings are the available model relations:
 * @property Users $modifiedBy0
 * @property Asset $asset
 */
class AssetRevision extends CActiveRecord
{
	public $oldAttributes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asset_revision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('assetId, modifiedOn, modifiedBy, note, revision', 'required'),
			array('assetId, modifiedBy', 'numerical', 'integerOnly'=>true),
			array('revision', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('assetId, modifiedOn, modifiedBy, note, revision', 'safe', 'on'=>'search'),
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
			'users' => array(self::BELONGS_TO, 'Users', 'modifiedBy'),
			'asset' => array(self::BELONGS_TO, 'Asset', 'assetId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'assetId' => 'Asset',
			'modifiedOn' => 'Modified On',
			'modifiedBy' => 'Modified By',
			'note' => 'Note',
			'revision' => 'Revision',
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

		$criteria->compare('assetId',$this->assetId);
		$criteria->compare('modifiedOn',$this->modifiedOn,true);
		$criteria->compare('modifiedBy',$this->modifiedBy);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('revision',$this->revision,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AssetRevision the static model class
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
	
	//additional code to maintain the logs with log4php 
	public function afterSave(){
		$Log = Logger::getLogger("accessLog");
		
		if($this->assetId != $this->oldAttributes['assetId'])
	 		{$Log->info("assetId ".$this->oldAttributes['assetId']." ".$this->assetId);}
		if($this->modifiedOn != $this->oldAttributes['modifiedOn'])
	 		{$Log->info("modifiedOn ".$this->oldAttributes['modifiedOn']." ".$this->modifiedOn);}
		if($this->modifiedBy != $this->oldAttributes['modifiedBy'])
	 		{$Log->info("modifiedBy ".$this->oldAttributes['modifiedBy']." ".$this->modifiedBy);}
		if($this->note != $this->oldAttributes['note'])
	 		{$Log->info("note ".$this->oldAttributes['note']." ".$this->note);}		
		if($this->revision != $this->oldAttributes['revision'])
	 		{$Log->info("revision ".$this->oldAttributes['revision']." ".$this->revision);}	

	 	return parent::afterSave();	
	}
}
