<?php

class PermissionsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','view'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Permissions;

		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Permissions'])) {
			$model->attributes=$_POST['Permissions'];
			if ($model->save()) {	
				$this->redirect(array('view','id'=>$model->pid));
			}
			//$connection = Yii::app()->db;
			//$module_mid=$model->mid;
			//$role_rid=$model->role_rid;
			//$name = $model->name;
			//$description = $model->description;
			//print_r($role_rid);
			//die();
			/*$orgId = Yii::app()->user->getId();
			
			$sql = "select name from module where orgId= :orgId and mid = :module_mid";
			$command = $connection->createCommand($sql);
			$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
			$command->bindParam(":module_mid",$module_mid,PDO::PARAM_STR);
			$dataReader = $command->query();
        	$row = $dataReader->read();
        	$dataReader->close();
        	$module_name = $row['name'];
        	
        	$sql = "select name from role where orgId= :orgId and rid = :role_rid";
        	$command = $connection->createCommand($sql);
        	$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
        	$command->bindParam(":role_rid",$role_rid,PDO::PARAM_STR);
			$dataReader = $command->query();
        	$row = $dataReader->read();
        	$dataReader->close();
        	$role_name = $row['name'];
			
			$sql = "insert into permissions(name, description, module_mid, role_rid)
			values('create', :description, :module_mid, :role_rid)";
			
			$command = $connection->createCommand($sql);
			
			$command->bindParam(":description",$description,PDO::PARAM_STR);
			$command->bindParam(":module_mid",$module_mid,PDO::PARAM_INT);
			$command->bindParam(":role_rid",$role_rid,PDO::PARAM_INT);
            $command->execute(); 
            $idd = Yii::app()->db->getLastInsertId();
            $sql = "insert into role_has_permissions(role_rid, permissions_pid, mid)
			values(:role_rid, :idd, :module_mid)";
			
			$command = $connection->createCommand($sql);
			$command->bindParam(":role_rid",$role_rid,PDO::PARAM_INT);
			$command->bindParam(":idd",$idd,PDO::PARAM_INT);
			$command->bindParam(":module_mid",$module_mid,PDO::PARAM_INT);
            $command->execute(); 
				
    		$this->redirect('/final/Permissions/Index');        */
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
		$model=$this->loadModel($id);
		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Permissions'])) {
			$model->attributes=$_POST['Permissions'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->pid));
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
		$dataProvider=new CActiveDataProvider('Permissions');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		/*$orgId = Yii::app()->user->getId();
		$dataProvider=new CActiveDataProvider('Permissions', array('criteria'=>array('condition'=>  'orgId = :orgId', 'params'=>array(':orgId'=>$orgId),
		),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Permissions('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Permissions'])) {
			$model->attributes=$_GET['Permissions'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Permissions the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Permissions::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Permissions $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='permissions-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}