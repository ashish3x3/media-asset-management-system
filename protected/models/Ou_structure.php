<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $name
 * @property string $description
 */
class Ou_structure extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	

        /**
	 * @return string the class name
	 */
          public static function className()
	{
		return __CLASS__;
	}
	
/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ou_structure';
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
			array('description', 'required'),
			array('dept_code', 'required'),
			//array('level', 'numerical', 'integerOnly'=>true),
		//	array('root, lft, rgt', 'length', 'max'=>10),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, description', 'safe'),
		//	array('id, root, lft, rgt, level, name, description', 'safe', 'on'=>'search'),
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
		     //relation that defines each ou_structure has many categories and 2 param must start with caps
		     //many to many realtionship
			'category' => array(self::MANY_MANY, 'Category', 'category_has_ou_structure(cat_id,id)'),
			'tags' => array(self::MANY_MANY, 'Tags', 'tags_has_ou_structure(id,tagId)'),
			'assetRel'=>array(self::HAS_MANY,'Asset','id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'name' => 'Name',
			'description' => 'Description',
			'dept_code' => 'Dept_code',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('root',$this->root,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('dept_code',$this->dept_code,true);
		$criteria->compare('orgId',$this->orgId,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 behaviours function
	*/
	public function behaviors()
	{
	return array(
	   'NestedSetBehavior'=>array(
	       'class'=>'application.behaviors.NestedSetBehavior',
	       'leftAttribute'=>'lft',
	       'rightAttribute'=>'rgt',
	       'levelAttribute'=>'level',
	       'hasManyRoots'=>true
	       ),
	);
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
}
