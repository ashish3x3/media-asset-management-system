<?php

class SiteController extends Controller
{
	private $Log;
	/**
	 * Declares class-based actions.
	 */
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
public function actionViewer()
	{
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('viewer');
	}

public function actionAsset()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('asset');
	}	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
				
		if(isset($_POST['ContactForm']))
		{
			
			$model->attributes=$_POST['ContactForm'];

		if(isset($_POST['buttonCancel']))
        		{
         		$this->redirect(Yii::app()->homeUrl);
        		}
			if($model->validate())
			{
				
				
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		
		
		$this->render('contact',array('model'=>$model));
	
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login()) {
				$model1 = Users::model()->find('name=:username',array(':username'=>$model->username));
				//$session=new CDbHttpSession;
				//$session->open();
				//$orgId = "hello";
				//$session['orgId'] = $orgId;
				$Log = Logger::getLogger("systemLog");
				$Log->info($model1->uid ."\t".$model->username."  LOGGED IN ");
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('login',array('model'=>$model));
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$Log = Logger::getLogger("systemLog");
		if(Yii::app()->user->isGuest){
		//$user = Users::model()->find('name=:name',array(':name'=>Yii::app()->user->name));
		$Log->info(Yii::app()->user->getState("uid")."\t".Yii::app()->user->name."\tLOGGED OUT");}
		Yii::app()->user->logout();
		//	$session->close();
		//$session->destroy();
		$this->redirect(Yii::app()->homeUrl);
	}
}