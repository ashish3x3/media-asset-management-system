<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $uid
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $login
 * @property string $logout
 * @property string $status
 * @property string $picture
 * @property string $mobile
 * @property integer $quota
 * @property string $DateCreated
 * @property string $LastUpdate
 *
 * The followings are the available model relations:
 * @property Role[] $roles
 */
class Users extends CActiveRecord
{
	
	public $roles;
	public $picture;
	public function behaviors(){
          return array( 'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
          }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	
	public $cpassword;
	public $oldAttributes;
	public $dept_id;
	public function rules()
	{
		
		
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, password, email,cpassword', 'required'),
			array('quota', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('mobile', 'length', 'max'=>10,'min'=>10),
			array('picture', 'file', 
        'types'=>'jpg, gif, png, bmp, jpeg',
            'maxSize'=>1024 * 1024 * 10, // 10MB
                'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
            'allowEmpty' => true
         ),
			array('email, status', 'length', 'max'=>60),
			array('logout, picture, LastUpdate,cpassword', 'safe'),
			array('password','compare','compareAttribute'=>'cpassword','on'=>'update, create'),
			array('email','unique', 'className' => 'Users'/*,'message' => 

Users::t("This user's email address already exists.") */,'attributeName' => 'email'),
			
			array('email','length','min'=>3,'max'=>32),
			//array('email','caseSensitive'=>true),
			
			
			
			 array('name', 'unique' ,'className' => 'Users'/*,'message' 

			=> Users::t("This user's name already exists.")*/),
			 
			 array('name', 'length', 'max'=>20, 'min' => 3 /*,'message' 

=> Users::t("Incorrect username (length between 3 and 20 characters).") */),
			 
			 //array('name', 'caseSensitive'=>true),
			 
			 array('name', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u'/*,'message' => Users::t("Incorrect symbols (A-z0-9).")*/),
			 
			
			
			//array('password','compare','compareAttribute'=>'cpassword'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, name, password, email, login, logout, status, picture, mobile, quota, DateCreated, LastUpdate', 'safe', 'on'=>'search'),
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
			'roles' => array(self::MANY_MANY, 'Role', 'users_has_role(users_uid, role_rid)'),
		    'asset' => array(self::HAS_MANY,'Asset','uid'),
		    'asset_revision'=>array(self::HAS_MANY,'AssetRevision','uid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'name' => 'Name',
			'password' => 'Password',
			'email' => 'Email',
			'login' => 'Login',
			'logout' => 'Logout',
			'status' => 'Status',
			'picture' => 'Picture',
			'mobile' => 'Mobile',
			'quota' => 'Quota',
			'DateCreated' => 'Date Created',
			'LastUpdate' => 'Last Update',
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

		$criteria->compare('uid',$this->uid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('logout',$this->logout,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('quota',$this->quota);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('LastUpdate',$this->LastUpdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function search2()    //for asset _form.php
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('orgId',Yii::app()->user->getId());
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
            'pageSize' => 5
        ),
		));
	}
	
	
	
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
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
	  if($this->email != $this->oldAttributes['email'])
	    {$Log->info("email ".$this->email." ".$this->oldAttributes['email']);}
	  if($this->password != $this->oldAttributes['password']){
	 	$Log->info("password".$this->password." ".$this->oldAttributes['password']);}
	  if($this->mobile != $this->oldAttributes['mobile']){
	 	$Log->info("mobile ".$this->mobile." ".$this->oldAttributes['mobile']);}
	  if($this->status != $this->oldAttributes['status']){
	 	$Log->info("status ".$this->status." ".$this->oldAttributes['status']);}
	  
	}
	public function getstatus(){
	 if($this->status==0)
	  return "BLOCKED";
	 elseif($this->status==1)
	  return "ACTIVE";
	} 
	
	public function beforeSave(){
	
	
		$this->DateCreated=new CDbExpression('NOW()');
		return parent::beforeSave();
	
	}
	
	
	
	
}
