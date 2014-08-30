<?php

/**
 * This is the model class for table "module".
 *
 * The followings are the available columns in table 'module':
 * @property integer $mid
 * @property string $name
 * @property string $description
 * @property integer $orgId
 */
class Module extends CActiveRecord
{

	public $oldAttributes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			//array('orgId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('description', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mid, name, description', 'safe', 'on'=>'search'),
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
		 'Permissions'=>array(self::HAS_MANY,'Permissions','mid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mid' => 'Module id',
			'name' => 'Name',
			'description' => 'Description',
			//'orgId' => 'Organisation Id',
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

		$criteria->compare('mid',$this->mid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		//$criteria->compare('orgId',$this->orgId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Module the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getModelName(){
		return __CLASS__;
	}
	public function afterFind(){
    	 $this->oldAttributes = $this->attributes;
   		 return parent::afterFind();
	}
	public function afterSave(){
	  $Log = Logger::getLogger("accessLog");
	if($this->name != $this->oldAttributes['name'])
	 	{$Log->info("name ".$this->oldAttributes['name']." ".$this->name);}
	if($this->description != $this->oldAttributes['description'])
	 	{$Log->info("description ".$this->oldAttributes['description']." ".$this->description);}
	//if($this->orgId != $this->oldAttributes['orgId'])
	 //	{$Log->info("orgId ".$this->oldAttributes['orgId']." ".$this->orgId);}
	 		
	
	}
	
}
