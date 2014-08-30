<?php

class RoleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $rid;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','permission_change','permission'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','permission_change2','permission_change','rfu','view_permission'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionRfu($id)
	{
		$this->render('rfu');
	}
	
	public function actionView_Permission($id)
	{
		//$dataProvider=new CActiveDataProvider('Permissions');
		
		$model= $this->loadModel($id);
		
		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
       

        if (isset($_POST['buttonUpdate'])) {
        	
        	$module=ModuleOrganisation::model()->findAll('orgId=:orgId',array(':orgId'=>Yii::app()->user->getId()));
        	$data = count($module);
        	RoleHasPermissions::model()->deleteAll('rid=:rid',array(':rid'=>$model->rid));
        	//print_r($data);die();
        	$number = 0;
        	while($number<$data){
        		if(!empty($_POST['CB'.$number])){
        		foreach($_POST['CB'.$number] as $rec)
        		{
        		  $RoleHasPermissions = new RoleHasPermissions;
        		  $RoleHasPermissions->rid = $model->rid;
        		  $RoleHasPermissions->pid = $rec;
        		  $RoleHasPermissions->save();
        		}}
        		$number++;
        	}
        	$this->redirect(array('/role'));
        }
        
        
		$this->render('view_permission',array(
			'model'=>$model,
		));
	}
	
	
	/*public function actionPermission_change($id)
	{
		$this->render('permission_change',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Role;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->user->returnUrl);
        }
		
		
		if (isset($_POST['Role'])) {
			$model->attributes=$_POST['Role'];
			
			$weight = $model->weight;
			
			$sq = "select weight from role where orgId = :orgId";
			$command = Yii::app()->db->createCommand($sq);
			$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
			$dataReader = $command->query();
			
			while (1) {
				$flag = 0;
				while (($model1 = $dataReader->read())!== false)
				{
					$a = $model1['weight'];
					print_r($a);
					die();
					if ($a == $weight) {
						$model1['weight'] = $weight + 1;
						$flag = 1;
					}		
				}
				$weight = $weight + 1;
				if ($flag == 0) {
					break;
				}
			}
			
			$connection = Yii::app()->db;
			$id = Yii::app()->user->getId();
			$name = $model->name;
			$weight = $model->weight;
			$orgId = Yii::app()->user->getId();
			$description=$model->description;
			$sql = "insert into role (name, weight, description, orgId) values (:name, :weight, :description, :orgId)";
			$command = $connection->createCommand($sql);
			$command->bindParam(":name",$name,PDO::PARAM_STR);
			$command->bindParam(":description",$description,PDO::PARAM_STR);
			$command->bindParam(":orgId",$orgId,PDO::PARAM_STR);
			$command->bindParam(":weight",$weight,PDO::PARAM_STR);
			$command->execute(); 
			
			$this->redirect(array('view','id'=>$model->rid));
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=	$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Role'])) {
			$model->attributes=$_POST['Role'];
			
			$weight = $model->weight;
			
			$sq = "select weight from role where orgId = :orgId";
			$command = Yii::app()->db->createCommand($sq);
			$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
			$dataReader = $command->query();
			
			while (1) {
				$flag = 0;
				while (($model1 = $dataReader->read())!== false)
				{
					$a = $model1['weight'];
					if ($a == $weight) {
						$model1['weight'] = $weight + 1;
						$flag = 1;
					}		
				}
				$weight = $weight + 1;
				if ($flag == 0) {
					break;
				}
			}
			
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->rid));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Role;
		$orgId = Yii::app()->user->getId();
		$dataProvider=new CActiveDataProvider('Role', array('criteria'=>array('condition'=>  'orgId = :orgId', 'params'=>array(':orgId'=>$orgId),
		//$dataProvider = new CActiveDataProvider('Role');
		),));
		
		
		if (isset($_POST['Role'])) {
			
			$model->attributes=$_POST['Role'];
			
			$weight = $model->weight;
			
			$sq = "select weight from role where orgId = :orgId";
			$command = Yii::app()->db->createCommand($sq);
			$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
			$dataReader = $command->query();
			$flag = 0;
			while (($model1 = $dataReader->read())!== false)
				{
					$a = $model1['weight'];
					if ($a == $weight) {
					$connection = Yii::app()->db;
					$sql = "update role set weight = weight + 1 where weight >= :weight";
					$command = $connection->createCommand($sql);
					$command->bindParam(":weight",$a,PDO::PARAM_INT);
					$command->execute();
					$flag = 0;
					break;
					}
				}
				
				
			/*while (1) {
				$flag = 0;
				while (($model1 = $dataReader->read())!== false)
				{
					$a = $model1['weight'];
					
					if ($a == $weight) {
						
						$abc = $weight + 1;
						
						$connection = Yii::app()->db;
						$sql = "update role set weight = :new where weight = :weight";
						$command = $connection->createCommand($sql);
						$command->bindParam(":weight",$a,PDO::PARAM_INT);
						$command->bindParam(":new",$abc,PDO::PARAM_INT);
						
						$command->execute();
						$flag = 1;
					}		
				}
				$weight = $weight + 1;
				if ($flag == 0) {
					break;
				}
			}
			
			*/
			
			/*
			$connection = Yii::app()->db;
			$id = Yii::app()->user->getId();
			$name = $model->name;
			$weight = $model->weight;
			$orgId = Yii::app()->user->getId();
			$description = $model->description;
			$sql = "insert into role (name, weight, description, orgId) values (:name, :weight, :description, :orgId)";
			$command = $connection->createCommand($sql);
			$command->bindParam(":name",$name,PDO::PARAM_STR);
			$command->bindParam(":description",$description,PDO::PARAM_STR);
			$command->bindParam(":orgId",$orgId,PDO::PARAM_STR);
			$command->bindParam(":weight",$weight,PDO::PARAM_STR);
			
			$command->execute(); 
			*/
				$model->orgId =  Yii::app()->user->getId();
				if ($model->save())
				$this->redirect(array('index'));
			
		}
		
		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	public function actionPermission()
	{
		$model = new Role;
		//$orgId = Yii::app()->user->getId();
		//$dataProvider=new CActiveDataProvider('Role', array('criteria'=>array('condition'=>  'orgId = :orgId', 'params'=>array(':orgId'=>$orgId),
		//$dataProvider = new CActiveDataProvider('Role');
		//),));
		$this->render('permission',array(
			'model'=>$model,
		));
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Role('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Role'])) {
			$model->attributes=$_GET['Role'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function isChecked($id1, $id2){
		
		$connection = Yii::app()->db;
		
		$sql = "select pid from role_has_permissions where rid = :rid";
		$command = $connection->createCommand($sql);
		$command->bindParam(":rid",$id1,PDO::PARAM_INT);
		$dataReader = $command->query();
		while (($model1 = $dataReader->read())!== false)
		{
			if ($model1['pid'] == $id2) {
				return true;
			}
		}
		
		return false;

	}

	public function actionPermission_change($id)
	{
		//$dataProvider=new CActiveDataProvider('Permissions');
		
		$model= $this->loadModel($id);
		
		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
       

        if (isset($_POST['buttonUpdate'])) {
        	
        	$module=ModuleOrganisation::model()->findAll('orgId=:orgId',array(':orgId'=>Yii::app()->user->getId()));
        	$data = count($module);
        	RoleHasPermissions::model()->deleteAll('rid=:rid',array(':rid'=>$model->rid));
        	//print_r($data);die();
        	$number = 0;
        	while($number<$data){
        		if(!empty($_POST['CB'.$number])){
        		foreach($_POST['CB'.$number] as $rec)
        		{
        		  $RoleHasPermissions = new RoleHasPermissions;
        		  $RoleHasPermissions->rid = $model->rid;
        		  $RoleHasPermissions->pid = $rec;
        		  $RoleHasPermissions->save();
        		}}
        		$number++;
        	}
        	$this->redirect(array('/role'));
        }
        
        
		$this->render('permission_change',array(
			'model'=>$model,
		));
	}
	
	
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Role the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Role::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Role $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='role-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}