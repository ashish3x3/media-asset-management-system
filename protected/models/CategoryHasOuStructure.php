<?php

/**
 * This is the model class for table "category_has_ou_structure".
 *
 * The followings are the available columns in table 'category_has_ou_structure':
 * @property integer $cat_id
 * @property string $id
 *
 * The followings are the available model relations:
 * @property Category $cat
 * @property OuStructure $id0
 */
class CategoryHasOuStructure extends CActiveRecord
{
	
	public $oldAttributes;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_has_ou_structure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, id', 'required'),
			array('cat_id', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cat_id, id', 'safe', 'on'=>'search'),
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
			'cat' => array(self::BELONGS_TO, 'Category', 'cat_id'),
			'id0' => array(self::BELONGS_TO, 'OuStructure', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cat_id' => 'Cat',
			'id' => 'ID',
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

		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('id',$this->id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryHasOuStructure the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
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
    	if($this->cat_id != $this->oldAttributes['cat_id'])
	 	{$Log->info("categoryId ".$this->oldAttributes['cat_id']." ".$this->cat_id);}
    	if($this->id != $this->oldAttributes['id'])
	 	{$Log->info("ou structureId ".$this->oldAttributes['id']." ".$this->id);}
    	return parent::afterSave();
    }	
}
