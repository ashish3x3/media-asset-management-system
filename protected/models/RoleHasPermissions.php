<?php

/**
 * This is the model class for table "role_has_permissions".
 *
 * The followings are the available columns in table 'role_has_permissions':
 * @property string $rid
 * @property integer $pid
 */
class RoleHasPermissions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'role_has_permissions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rid, pid', 'required'),
			array('pid', 'numerical', 'integerOnly'=>true),
			array('rid', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rid, pid', 'safe', 'on'=>'search'),
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
		
			'relRole' => array(self::BELONGS_TO, 'Role', 'rid'),
            'relPermission' => array(self::BELONGS_TO, 'Permissions', 
            'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rid' => 'Rid',
			'pid' => 'Pid',
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

		$criteria->compare('rid',$this->rid,true);
		$criteria->compare('pid',$this->pid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoleHasPermissions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
public function searchIncludingPermissions($parentID)
    {
        /* This function creates a dataprovider with RolePermission
        models, based on the parameters received in the filtering-model.
        It also includes related Permission models, obtained via the
        relPermission relation. */
        $criteria=new CDbCriteria;
        $criteria->with=array('relPermission');
        $criteria->together = true;
 
 
        /* filter on role-grid PK ($parentID) received from the 
        controller*/
        $criteria->compare('t.rid',$parentID,false); 
 
        /* Filter on default Model's column if user entered parameter*/
        $criteria->compare('t.pid',$this->pid,true);
 
        /* Filter on related Model's column if user entered parameter*/
        /*$criteria->compare('relPermission.desc',
            $this->desc,true);
 		*/
        
        /* Sort on related Model's columns */
        $sort = new CSort;
        $sort->attributes = array(
            'desc_param' => array(
            'asc' => 'desc',
            'desc' => 'desc DESC',
            ), '*', /* Treat all other columns normally */
        );
        /* End: Sort on related Model's columns */
 
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>$sort, /* Needed for sort */
        ));
    }

}
