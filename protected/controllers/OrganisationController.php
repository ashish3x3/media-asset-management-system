<?php

class OrganisationController extends Controller
{
	
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
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

	public function actionRegdone()
	{
		$this->render('regdone');
	}
	
	
	
	public function actionNext()
	{
		print_r("hello");
		if(isset($_POST['theIds'])){
          $arra=explode(',', $_POST['theIds']);
          // now do something with the ids in $arra
          
          die();
    	}
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
				'actions'=>array('index','view','register1','regdone','captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','view','adddept','index','create','register1','regdone'),
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
		$model=new Organisation;

		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organisation']))
		{$to="aks133844@gmail.com";
		$from="selvarani@iitb.ac.in";
		$subject="Mail worked";
		$message="asasasassas";
			$model->attributes=$_POST['Organisation'];
			if($model->save()){
			$this->mailsend($to,$from,$subject,$message);
				$this->redirect(array('view','id'=>$model->orgId));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
public function mailsend($to,$from,$subject,$message){
	
        $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'From Ashish:Vishnu');
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            echo "Message sent!";
        }
    }
    
	public function actionChangePassword($id){
		$model=$this->loadModel($id);
		if(isset($_POST['buttonCancel'])){
		$this->redirect(Yii::app()->homeUrl);
		}
		if(isset($_POST['Users'])) 
			{	
			if(crypt($_POST['Users']['oldpassword'],'salt')!=$model->password){
				echo "old password not matching";
				$this->redirect(Yii::app()->homeUrl);
			}
			$model->attributes=$_POST['Users'];
			//if($model->save())
			//{
				$orgId = Yii::app()->user->getId();
				$newpassword = crypt($_POST['Users']['newpassword'],'salt');
				$connection=Yii::app()->db;
				$sql ="update users set password=:newpassword where orgId=:orgId";
				$command=$connection->createCommand($sql);
				$command->bindParam(":newpassword",$newpassword,PDO::PARAM_STR);
				$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
				$command->execute();	 
				$this->redirect(array('view','id'=>$model->uid));
			//}
		}

		$this->render('changePassword',array(
		'model'=>$model,
		));
	}
/*
	public function actionCreate()
	{
		$model=new Organisation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Organisation']))
		{
			$model->attributes=$_POST['Organisation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->orgId));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
*/
	
	/*function to allow all users to register*/
	
	public function actionAdddept()
	{
		$model=new Organisation;

		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }

		$this->render('adddept',array(
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

		if(isset($_POST['Organisation']))
		{
			$model->attributes=$_POST['Organisation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->orgId));
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
		$dataProvider=new CActiveDataProvider('Organisation');

		/*$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$orgId = Yii::app()->user->getId();
		$dataProvider=new CActiveDataProvider('Organisation', array('criteria'=>array('condition'=>  'orgId = :orgId', 'params'=>array(':orgId'=>$orgId),
		),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionRegister1()
	{
		$model=new Organisation;
		/*$dataProvider=new CActiveDataProvider('Organisation');*/
		$model->scenario = 'captchaRequired';
		$connection = Yii::app()->db;
		
		if(isset($_POST['buttonCancel']))
        {
         $this->redirect(Yii::app()->homeUrl);
        }
		
		if(isset($_POST['Organisation'])) {
			$model->attributes=$_POST['Organisation'];
			$model->validity = 1;
			if($model->save()) {
				$sql3 = "select max(id) from ou_structure";
			    $command = $connection->createCommand($sql3);
			    //$a = $command->query();
			    $dataReader = $command->query();
        		$row = $dataReader->read();
        		$dataReader->close();
        		$orgId = $model->orgId;
        		$ans = $row['max(id)'];
			    $ans = $ans + 1;
			    $orgName = $model->orgName;
			    $desc = "hello";
				$sql = "insert into ou_structure(root,lft,rgt,level,name,description,orgId) values(:root, 1, 2, 1, :orgName,:desc,:orgId)";
				
				$command = $connection->createCommand($sql);
				$command->bindParam(":root",$ans,PDO::PARAM_INT);
				$command->bindParam(":desc",$desc,PDO::PARAM_STR);
				$command->bindParam(":orgName",$orgName,PDO::PARAM_STR);
				$command->bindParam(":orgId",$orgId,PDO::PARAM_STR);
        		$command->execute(); 
        	
        		$sq = "select orgId from organisation where orgName = :orgName";
        		$command = Yii::app()->db->createCommand($sq);
        		$command->bindParam(":orgName",$orgName,PDO::PARAM_INT);
			    $dataReader = $command->query();
        		$row = $dataReader->read();
        		$ans2 = $row['orgId'];
        		$dataReader->close();
        		
        		
				/*$sql4 = "insert into ou_structure(orgId, id) values(:orgId, :id)";
				$command = $connection->createCommand($sql4);
				$command->bindParam(":orgId",$ans2,PDO::PARAM_INT);
				$command->bindParam(":id",$ans,PDO::PARAM_INT);
				$command->execute();*/
				
				//$id = Yii::app()->db->getLastInsertId();
				$desc = $model->description;
				$email = $model->email;
				$ouId = Ou_structure::model()->find('orgId=:orgId',array(':orgId'=>$model->orgId))->id;
				$pwd = crypt("hello", 'salt');
				$sql2 = "insert into users(name,password,email,orgId,ouId) values(:username, :pwd, :email, :id,:ouId)";
        		$username = $model->orgName;
				$command2 = $connection->createCommand($sql2);
				$command2->bindParam(":username",$username,PDO::PARAM_STR);
				$command2->bindParam(":pwd",$pwd,PDO::PARAM_STR);
				$command2->bindParam(":email",$email,PDO::PARAM_STR);
				$command2->bindParam(":id",$ans2,PDO::PARAM_INT);
				$command2->bindParam(":ouId",$ouId,PDO::PARAM_INT);
				
				$command2->execute();
				
				$connection = Yii::app()->db;
				
				$sqlcom = "insert into module_organisation(mid, orgId) values(54, :orgId)";
			    $command2 = $connection->createCommand($sqlcom);
			    $command2->bindParam(":orgId",$ans2,PDO::PARAM_INT);
			    $command2->execute();
			    
			    $sqlcom = "insert into module_organisation(mid, orgId) values(55, :orgId)";
			    $command2 = $connection->createCommand($sqlcom);
			    $command2->bindParam(":orgId",$ans2,PDO::PARAM_INT);
			    $command2->execute();
			    
			    $sqlcom = "insert into module_organisation(mid, orgId) values(56, :orgId)";
			    $command2 = $connection->createCommand($sqlcom);
			    $command2->bindParam(":orgId",$ans2,PDO::PARAM_INT);
			    $command2->execute();
			    
			    $sqlcom = "insert into module_organisation(mid, orgId) values(57, :orgId)";
			    $command2 = $connection->createCommand($sqlcom);
			    $command2->bindParam(":orgId",$ans2,PDO::PARAM_INT);
			    $command2->execute();
			    
			    
				$this->redirect('regdone');
			}
		}
		$this->render('register1',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		/*$model=new Organisation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Organisation']))
			$model->attributes=$_GET['Organisation'];

		$this->render('admin',array(
			'model'=>$model,
		));*/
		$url = "/final/ou_structure/tree";
		$this->redirect($url);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Organisation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Organisation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Organisation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='organisation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
