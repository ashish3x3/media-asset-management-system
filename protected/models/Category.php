<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $cat_id
 * @property string $name
 * @property string $orgId
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $oldAttributes;
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $orgName;//for Organisation Name in views
	public $DName;   //for Department Name in views
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>60),
			array('orgId', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name,orgName, DName', 'safe', 'on'=>'search'),
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
		   //organisation and category relationship
		  'organisation'=>array(self::BELONGS_TO,'Organisation','orgId'),
		  // ou_stucture and category relationship
		  'ou_structure' => array(self::MANY_MANY, 'Ou_structure', 'category_has_ou_structure(cat_id,id)'),		
		  'asset' => array(self::HAS_MANY,'Asset','cat_id'),	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cat_id' => 'Category',
			'name' => 'Name',
			'orgId' => 'Organisation Id',
			'description'=>'Description',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('orgId',$this->orgId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
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
	}
	
	public function getDepartments()
		{
    		$ret = "";
    		$first = true;
    		
    		foreach ($this->ou_structure as $record) {

        	if ($first === true) {
            	$first = false;
        	} else {
            $ret .= ', ';
        	}

        $ret .= $record->name;
    	}
		
	    return $ret;
		}
	
}
