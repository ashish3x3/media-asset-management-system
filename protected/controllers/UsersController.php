<?php

class UsersController extends Controller
{
	private $userLog;
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
				'actions'=>array('index','view','checkIn','UpdateFileCheckIn','review','UpdateReviewDocs'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','changePassword','displaySavedImage'),
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

	/*
	 * ChangePassword controller
	 */
	
	public function actionChangePassword($id){
		$model=$this->loadModel($id);
		$model->scenario='changePassword';
		if(isset($_POST['buttonCancel'])){
		$this->redirect(Yii::app()->homeUrl);
		}
		if(isset($_POST['Users'])) 
			{	
			if(crypt($_POST['Users']['oldpassword'],'salt')!=$model->password){
			
				print_r("BAD PASSWORD!!! " );
				die();
			}
		
			if($model->save())
			{
				
				$orgId = Yii::app()->user->getId();
				$newpassword = crypt($_POST['Users']['newpassword'],'salt');
				$connection=Yii::app()->db;
							
				$sql ="update users set password=:newpassword where orgId=:orgId";
				$command=$connection->createCommand($sql);
				$command->bindParam(":newpassword",$newpassword,PDO::PARAM_STR);
				$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
				$command->execute();	 
				$this->redirect(Yii::app()->homeUrl);
			}
		}

		$this->render('changePassword',array(
		'model'=>$model,
		));
	}
	
	
	/*
	 * funtion to display user image
	 */
	
	public function actionDisplaySavedImage(){
		
		$model = $this->loadModel($_GET['id']);
		
		//setting the headers
		
		header('Pragma:public');
		header('Expires:0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Transfer-Encoding : binary');
		
		header('content-Type : image/png',false);
		header('content-Type : image/jpeg',false);
		header('content-Type : image/jpg',false);
		header('content-Type : image/gif',false);
		
		
		echo $model->picture;
	} 
	
	/*
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$model=new Users('create');

		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
		
		
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			
			//echo json_encode($model->roles);
			$model->attributes=$_POST['Users'];
			$model->orgId = Yii::app()->user->getId();
			if($_POST['Users'])
			{
			$model->cpassword=crypt($model->cpassword,'salt');	
			$model->password=crypt($model->password,'salt');}
			
			
			$model->ouId = $_POST['Users']['ouId'];
			
			//getting the uploaded image instance
			
			if(!empty($_FILES['Users']['tmp_name']['picture']))
			{
				$file = CUploadedFile::getInstance($model,'picture');
				$fp = fopen($file->tempName,'r');
				$content = fread($fp,filesize($file->tempName));
				fclose($fp);
				$model->picture = $content;
			}
			
			if($model->save()){

				$Log = Logger::getLogger("accessLog");
	  			$uid=Yii::app()->user->getState("uid");
	 		    $Log->info($uid."\t".Yii::app()->user->name."\t".$model->getModelName()."\tcreate\t".$model->uid);	
	  
	 		    //$dept_id = $_POST['dept_id'];
				//$user_department = new UsersDepartment;
				//$user_department->uid = $model->uid;
				//$user_department->id  = $dept_id;
				//$user_department->save();
	 		    
				
				if(!empty($_POST['Users']['roles'])){
				$roid = $_POST['Users']['roles'];
				foreach($roid as $categoryId){
					$UsersHasRoles = new UsersHasRole;
        	        $UsersHasRoles->users_uid = $model->uid;
            	    $UsersHasRoles->role_rid = $categoryId;
                	$UsersHasRoles->save();
        		}}
				$this->redirect(array('view','id'=>$model->uid));
			}
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
		 $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			
			//$Log = Logger::getLogger("accessLog");
			
			//$Log->info(json_encode($model));			
			$model->attributes=$_POST['Users'];
			$model->orgId = Yii::app()->user->getId();
			//$model2 = $model;
		if($_POST['Users']){	
		$model->cpassword=crypt($model->cpassword,'salt');	
			$model->password=crypt($model->password,'salt');
		}
			 	
		
			if($model->save()){
				
				$Log = Logger::getLogger("accessLog");
	  			$uid=Yii::app()->user->getState("uid");
	  			$Log->info($uid."\t".Yii::app()->user->name."\t".$model->getModelName()."\tupdate\t".$model->uid);	
	  
				foreach($roid as $categoryId){
					$UsersHasRoles = new UsersHasRole;
        	        $UsersHasRoles->users_uid = $model->uid;
            	    $UsersHasRoles->role_rid = $categoryId;
                	$UsersHasRoles->save();
        
				}
	  			
				
				$this->redirect(array('view','id'=>$model->uid));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function findUpdatedAttributes($model1,$model2){
		
		$Log = Logger::getLogger("accessLog");
		$Log->info("entered the function");
		print_r($model1);die();
		
	}
	/*
	 * function to obtain the view Checkin for that particular user
	 */
	public function actionCheckIn($id){
			$model=$this->loadModel($id);
			
			$model1=new Asset('search'); 
			
			$model1->unsetAttributes();  // clear any default values
			if (isset($_GET['Asset'])) {
				$model1->attributes=$_GET['Asset'];
			}

		$this->render('checkIn',array(
			'model'=>$model,'model1'=>$model1,
		));
			
			
	}

	/*
	 * function to obtain the view of documents pending to be reviewed
	 */
	public function actionReview($id){
			$model=$this->loadModel($id);
			
			$model1=new Asset('search'); 
			
			$model1->unsetAttributes();  // clear any default values
			if (isset($_GET['Asset'])) {
				$model1->attributes=$_GET['Asset'];
			}

		$this->render('review',array(
			'model'=>$model,'model1'=>$model1,
		));
			
			
	}
	
	
	
	
	/*
	 * to update the checkIn when row selected to input details and upload again
	 */

	public function actionUpdateFileCheckIn($id = null) {
        $model = Asset::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

		$this->renderPartial('../asset/properties', array('model' => $model));       
        //$this->redirect(array("../asset/checkInform2",array('model' => $model)));
        //Yii::app()->end();
	}

	public function actionUpdateReviewDocs($id = null) {
        $model = Asset::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->renderPartial('../asset/reviewAssetDetails', array('model' => $model));
        //Yii::app()->end();
	}
	
	
}
