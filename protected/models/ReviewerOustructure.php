<?php

/**
 * This is the model class for table "reviewer_oustructure".
 *
 * The followings are the available columns in table 'reviewer_oustructure':
 * @property integer $id
 * @property string $ouId
 * @property integer $uId
 *
 * The followings are the available model relations:
 * @property Users $u
 * @property OuStructure $ou
 */
class ReviewerOustructure extends CActiveRecord
{
	public $oldAttributes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reviewer_oustructure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ouId, uId', 'required'),
			array('uId', 'numerical', 'integerOnly'=>true),
			array('ouId', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ouId, uId', 'safe', 'on'=>'search'),
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
			'u' => array(self::BELONGS_TO, 'Users', 'uId'),
			'ou' => array(self::BELONGS_TO, 'OuStructure', 'ouId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ouId' => 'Ou',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ouId',$this->ouId,true);
		$criteria->compare('uId',$this->uId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReviewerOustructure the static model class
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
	
	 //adding details to log the cheanges   
    public function afterSave()
    {
    	$Log = Logger::getLogger("accessLog");
    	if($this->uId != $this->oldAttributes['uId'])
	 	{$Log->info("uId ".$this->oldAttributes['uId']." ".$this->uId);}
    	if($this->ouId != $this->oldAttributes['ouId'])
	 	{$Log->info("ou structureId ".$this->oldAttributes['ouId']." ".$this->ouId);}
    	return parent::afterSave();
    }	
	
	
}
