<?php

class TagsController extends Controller
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
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','view'),
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
		$model=new Tags;
		
		if(isset($_POST['buttonCancel'])){
         $this->redirect(Yii::app()->homeUrl);
        }
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Tags'])) {
			
			$model->attributes=$_POST['Tags'];
			$orgId = Yii::app()->user->getId();
			//$model->orgId = $orgId;
			$tags = explode(",", $_POST['Tags']['tagName']);
			$tag_dept = new TagsHasOuStructure;
			
			//print_r($_POST['Tags']['tagName']);die();
			
			//if($model->save()){
				
			Yii::app()->db->createCommand();	
			foreach ($tags as $tag1) {
				
				$tg = Yii::app()->db->createCommand()
   	->insert('tags', array(
    'tagName'=>$tag1,
    'orgId'=>$orgId
						));
			if($model->save()){
			/*	
				$dept_id=$_POST['dept_id'];
				$num=count($dept_id);
				
				
				for($i=0;$i<$num;++$i){
				
				$tag_dept->id=$dept_id[$i];
				$tag_dept->tagId = LAST_INSERT_ID();
				$tag_dept->save();
				}
				*/
				$tag_dept = new TagsHasOuStructure;
			foreach ($_POST['dept_id'] as $key=>$dept_id)
				{  
			 		
					$tag_dept->id = $dept_id;
			 		$tag_dept->tagId = $modle->tagId;
			 		if($tag_dept->save()){
			 		print_r("saved");
			 		}
			 		else{
			 		
			 		print_r("not saved");
			 		}
			 		
			 		
			 		
			 		
				}
			}
}
			//}
			
			//print_r( json_encode($_POST['dept_id']));die();
			
				/*if(!empty($_POST['Tags']['tagName'])){
					$tags = explode(",",$_POST['Tags']['tagName']);
					foreach($tag as $tagRow)
					
				}*/
				
				
			$Log = Logger::getLogger("accessLog");
	  			$uid=Yii::app()->user->getState("uid");
	  			$Log->info($uid."\t".Yii::app()->user->name."\t".$model->getModelName()."\tcreate\t".$model->tagId);		
			
	  			
	  			/*foreach ($_POST['dept_id'] as $key=>$dept_id)
				{
			 		$tag_dept = new TagsHasOuStructure;
					$tag_dept->id = $dept_id;
			 		$tag_dept->tagId = $model->tagId;
			 		$tag_dept->save();
				} 
				*/
			$this->redirect(array('view','id'=>$model->tagId));
        	
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

		if (isset($_POST['Tags'])) {
			$model->attributes=$_POST['Tags'];
			if ($model->save()) {
				
				$Log = Logger::getLogger("accessLog");
	  			$uid=Yii::app()->user->getState("uid");
	  			$Log->info($uid."\t".Yii::app()->user->name."\t".$model->getModelName()."\tupdate\t".$model->uid);	
				$this->redirect(array('view','id'=>$model->tagId));
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
		//$dataProvider=new CActiveDataProvider('Tags');
		$orgId = Yii::app()->user->getId();
		$dataProvider=new CActiveDataProvider('Tags', array('criteria'=>array('condition'=>  'orgId = :orgId', 'params'=>array(':orgId'=>$orgId),
		),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tags('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Tags'])) {
			$model->attributes=$_GET['Tags'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tags the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		//$model=Tags::model()->findByPk($id);
		//$model = Yii::app()->db->createCommand()->select('*')->from('tags')->where('tagId=:tagId',array(':tagId'=>$id));
		//$model = Tags::model()->findByPk($id);
		$model=Tags::model()->find('tagId=:tagId', array(':tagId'=>$id));
		
		
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tags $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='tags-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}