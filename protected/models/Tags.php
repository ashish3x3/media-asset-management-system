<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $tagId
 * @property string $tagName
 * @property string $orgId
 */
class Tags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $orgName;
	public $name;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tagName, orgId', 'required'),
			array('tagName', 'length', 'max'=>45),
			array('orgId', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tagId, tagName, orgId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	
	public function getUrl()
	{
		return Yii::app()->createUrl('organisation/view', array(
				'tagId'=>$this->tagId,
				'tagName'=>$this->tagName,
		));
	}
	
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tagName) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('organisation/index', 'tag'=>$img));
		return $links;
	}
	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'organisation'=>array(self::BELONGS_TO,'Organisation','orgId'),
		//many to many relationship departments and tags , first param in relationship must be that of the active class,i.e of the Tag
		'ou_structure' => array(self::MANY_MANY, 'Ou_structure', 'tags_has_ou_structure(tagId,id)'),
		'asset' => array(self::MANY_MANY, 'Asset', 'asset_tags(tagId,assetId)'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tagId' => 'Tag',
			'tagName' => 'Tag Name',
			'orgId' => 'Org',
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

		$criteria->compare('tagId',$this->tagId);
		$criteria->compare('tagName',$this->tagName,true);
		$criteria->compare('orgId',$this->orgId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getModelName(){
		return __CLASS__;
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


