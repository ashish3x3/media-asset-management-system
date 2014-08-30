<?php
error_reporting(E_ALL ^ ~E_NOTICE  ^ ~E_WARNING);

class AssetController extends Controller
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
				'actions'=>array('index','view','properties','ajaxCheckBox','infoOptions','history','admin','versionViewUpdate','userTable','download','infoOptionsViewUpdate','downloadVersion'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxCheckBox',  'viewer','editor','checkOut','checkOutAsset','checkIn','checkInform','reviewAssetDetails','authorizeOrReject','checkInform2'),
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
	{	if(!Yii::app()->user->checkAccess('create'))
 // Yii::app()->end();
		$model=new Asset;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$modelUsers = new Users('search');
		
		$modelUsers->unsetAttributes();
		if (isset($_GET['Users'])) {
			$modelUsers->attributes=$_GET['Users'];
		}
		
		
		if (isset($_POST['Asset'])) {
			$model->attributes=$_POST['Asset'];

			$model->file=CUploadedFile::getInstance($model,'file');
						
			$uid = Yii::app()->user->getState("uid"); 
			$user = Users::model()->find('uid=:uid',array(':uid'=>$uid));
			$model->categoryId = $_POST['Asset']['categoryId'];
			$model->departmentId = $user->ouId;
			$reviewerOustructure = ReviewerOustructure::model()->find('ouId=:ouId',array(':ouId'=>$model->departmentId));
			$model->reviewer = $reviewerOustructure->uId;
			$model->orgId = Yii::app()->user->getId();
			
			
			
			if(!empty($_POST['tags']))
			{
				$tags = $_POST['tags'];
			}
			
			
			
			if ($model->save()) {

				$orgId=Yii::app()->user->getId();
				$fileName=$model->assetId.'.dat';
				$categoryId=$_POST['Asset']['categoryId'];
				$old = umask(0);
				$fileName1=$model->assetId.'_0'.'.dat';

				if (!is_dir(Yii::app()->basePath . '/../upload/' . $orgId . '/'.$categoryId.'/' )) {
                //mkdir(Yii::app()->basePath . '/../upload/' . $orgId . '/'.$categoryId.'/',0777 ,true);
                mkdir(Yii::app()->basePath . '/../upload/' . $orgId . '/'.$categoryId.'/',0777 ,true);
				
				}
				umask($old);

				if (!is_dir(Yii::app()->basePath . '/../upload/' . $orgId . '/'.$categoryId.'/'.$model->assetId.'/')) {
                //mkdir(Yii::app()->basePath . '/../upload/' . $orgId . '/'.$categoryId.'/',0777 ,true);
                mkdir(Yii::app()->basePath . '/../upload/' . $orgId . '/'.$categoryId.'/'.$model->assetId.'/',0777 ,true);
				
				}
				
				
				$model->file->saveAs(Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$fileName);
				$model->file->saveAs(Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->file);
				
				copy($folder .Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->assetId.'.dat' ,
      				Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->assetId.'/'.$model->assetId.'_0'.'.dat'  );
				
				
				copy($folder .Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->assetId.'.dat' ,
				Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->file);
				
				
				
				//updates the fileaccesslog
				$command = Yii::app()->db->createCommand();
				$command->insert('fileaccesslog', array(
    					'action'=>'I',
    					'assetId'=>$model->assetId,
						'uId'=> Yii::app()->user->getState("uid"),
					));
					
				//update the asset_revision	
				$command->insert('asset_revision', array(
    					'assetId'=>$model->assetId,
						'modifiedBy'=> Yii::app()->user->getState("uid"),
						'note'=>'intial commit',
						'revision'=>0,
						
					));
				
				
				if(!empty($_POST['tags'])){
				$tag = $_POST['tags'];
				foreach($tag as $tagRow){
					$AssetTag = new AssetTags;
            	    $AssetTag->assetId = $model->assetId;
            	    $AssetTag->tagId = $tagRow ;
                	$AssetTag->save();
       			}}
				
       			if(!empty($_POST['Asset']['tagsUser'])){
       			$tagsUser=explode(",",$_POST['Asset']['tagsUser']);
       			foreach($tagsUser as $tagsRow){
					$Tags = new Tags;
            	    $Tags->tagName = $tagsRow;
            	    $Tags->orgId  = Yii::app()->user->getId();
                	$Tags->save();
                	$AssetTag1 = new AssetTags;
                	$AssetTag1->assetId = $model->assetId;
                	$AssetTag1->tagId = $Tags->tagId;
                	$AssetTag1->save();
                	
       			}
       			}
				
				if(!empty($_POST['read'])){
				$read = $_POST['read'];
				foreach($read as $readRow){
					$AssetOuFilep = new AssetOuFilep;
        	        $AssetOuFilep->assetId = $model->assetId;
            	    $AssetOuFilep->ouId = $readRow;
            	    $AssetOuFilep->fpId = 0;
                	$AssetOuFilep->save();
       			}}

       			
       			if(!empty($_POST['write'])){
				$write = $_POST['write'];
       			foreach($write as $writeRow){
					$AssetOuFilep = new AssetOuFilep;
        	        $AssetOuFilep->assetId = $model->assetId;
            	    $AssetOuFilep->ouId = $writeRow;
            	    $AssetOuFilep->fpId = 1;
                	$AssetOuFilep->save();
       			}}
       			

				if(!empty($_POST['edit'])){
				$edit = $_POST['edit'];
				foreach($edit as $editRow){
					$AssetOuFilep = new AssetOuFilep;
        	        $AssetOuFilep->assetId = $model->assetId;
            	    $AssetOuFilep->ouId = $editRow;
            	    $AssetOuFilep->fpId = 2;
                	$AssetOuFilep->save();
       			}}

       			
				if(!empty($_POST['delete'])){
				$delete = $_POST['delete'];
				foreach($delete as $deleteRow){
					$AssetOuFilep = new AssetOuFilep;
        	        $AssetOuFilep->assetId = $model->assetId;
            	    $AssetOuFilep->ouId = $editRow;
            	    $AssetOuFilep->fpId = 3;
                	$AssetOuFilep->save();
       			}}
       			
       			if(!empty($_POST['Aread'])){
				$read = $_POST['Aread'];
				foreach($read as $readRow){
					$AssetUserFilep = new AssetUserFilep;
        	        $AssetUserFilep->assetId = $model->assetId;
            	    $AssetUserFilep->uId = $readRow;
            	    $AssetUserFilep->fpId = 0;
                	$AssetUserFilep->save();
       			}}

       			
       			if(!empty($_POST['Awrite'])){
				$write = $_POST['Awrite'];
       			foreach($write as $writeRow){
					$AssetUserFilep = new AssetUserFilep;
        	        $AssetUserFilep->assetId = $model->assetId;
            	    $AssetUserFilep->uId = $writeRow;
            	    $AssetUserFilep->fpId = 1;
                	$AssetUserFilep->save();
       			}}
       			

				if(!empty($_POST['Aedit'])){
				$edit = $_POST['Aedit'];
				foreach($edit as $editRow){
					$AssetUserFilep = new AssetUserFilep;
        	        $AssetUserFilep->assetId = $model->assetId;
            	    $AssetUserFilep->uId = $editRow;
            	    $AssetUserFilep->fpId = 2;
                	$AssetUserFilep->save();
       			}}

       			
				if(!empty($_POST['Adelete'])){
				$delete = $_POST['Adelete'];
				foreach($delete as $deleteRow){
					$AssetUserFilep = new AssetUserFilep;
        	        $AssetUserFilep->assetId = $model->assetId;
            	    $AssetUserFilep->uId = $editRow;
            	    $AssetUserFilep->fpId = 3;
                	$AssetUserFilep->save();
       			}}
       			
       			
       			
			}

			$this->redirect(array('view','id'=>$model->assetId));
		}

		$this->render('create',array(
			'model'=>$model,'modelUsers'=>$modelUsers,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Asset'])) {
			$model->attributes=$_POST['Asset'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->assetId));
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
		
		$model=new Asset('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Asset'])) {
			$model->attributes=$_GET['Asset'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Asset('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Asset'])) {
			$model->attributes=$_GET['Asset'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Asset the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Asset::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}
	
public function actionViewer($id)
	{
		$model= $this->loadModel($id);
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		 $this->render('viewer', array('model'=>$model));
		//$this->render('viewer', array('a'=>$id));
	}

	//editor for image manipulation 
//image editor
public function actionEditor($id)
	{
		$model= $this->loadModel($id);
		$count = 0;
		$name = $model->file;
		$catid = $model->categoryId;
		$orgId = Yii::app()->user->getId();
		
	//	$image=Yii::app()->image->load('upload/'.$orgId.'/'.$catid.'/'.'6.jpg');
		$image=Yii::app()->image->load('upload/'.'6.jpg');
		
		if(isset($_POST['flip']))
        {
		  $a = $_POST['side'];
		  
		  if ($a == 1)
		  $b = 5;
		  else if ($a == 2)
		  $b = 6;
		  
		  $image->flip($b);
		  $image->save('upload/'.'6_1.jpg'); 
		  $count = 1;
        }
      
        
        if(isset($_POST['convert']))
        {
        	$handle = new upload('upload/6.jpg');
	 		if ($handle->uploaded) {
	 			$a = $_POST['format'];
	 			if ($a == 1)
	 			$handle->image_convert = 'png';
	 			else if ($a == 2)
	 			$handle->image_convert = 'jpg';
	 			else if ($a == 3)
	 			$handle->image_convert = 'gif';
	 			else if ($a == 4)
	 			$handle->image_convert = 'bmp';
	 			$handle->process('upload/');
	 			//echo 'converted';
	 		}
        }
        
		if(isset($_POST['negative']))
        {
        	$handle = new upload('upload/6_1.jpg');
	 		if ($handle->uploaded) {//$handle->image_convert = 'gif';
	 			$handle->image_negative = true;
	 			$handle->process('upload/');
	 		}
        }
        
		if(isset($_POST['brightness']))
        {
        	$a = $_POST['Attribute']['brightness'];
		 	 $b = (int)$a;
        	$handle = new upload('upload/6_1.jpg');
	 		if ($handle->uploaded) {//$handle->image_convert = 'gif';
	 			$handle->image_brightness = $a;
	 			$handle->process('upload/');
	 		}
	 		
        }
        
	if(isset($_POST['contrast']))
        {
        	$a = $_POST['Attribute']['contrast'];
		  	$b = (int)$a;
        	$handle = new upload('upload/6_1.jpg');
	 		if ($handle->uploaded) {//$handle->image_convert = 'gif';
	 			$handle->image_brightness = $a;
	 			$handle->process('upload/');
	 		}
        }
       if(isset($_POST['text']))
        {
        	$a = $_POST['Attribute']['text'];
		   $b = $_POST['Attribute']['text_color'];
		   $c = $_POST['Attribute']['text_x'];
		   $d = $_POST['Attribute']['text_y'];
        	$handle = new upload('upload/6_1.jpg');
	 		if ($handle->uploaded) {//$handle->image_convert = 'gif';
	 			$handle->image_text = $a;
	 		    $handle->image_text_color = $b;
	 			$handle->image_text_x = (int)$c;
	 			$handle->image_text_y = (int)$d; 
	 			$handle->process('upload/');
	 		}
        }
       
        
		if(isset($_POST['crop']))
        {
        	 $a = $_POST['Attribute']['crop_x'];
		  $b = (int)$a;
		  
		   $c = $_POST['Attribute']['crop_y'];
		  $d = (int)$c;
         $image->crop($b, $d);
        $image->save('upload/'.'6_1.jpg'); 
        $count = 1;
        }
      	
        if(isset($_POST['resize']))
        {
        	 $a = $_POST['Attribute']['resize_x'];
		  $b = (int)$a;
		  
		   $c = $_POST['Attribute']['resize_y'];
		  $d = (int)$c;
      	 
        	
        	$image->resize($b, $d);
      	 $image->save('upload/'.'6_1.jpg'); 
      	 $count = 1;
        }
        
        if(isset($_POST['rotate']))
        {
        	 $a = $_POST['Attribute']['rotate'];
		  $b = (int)$a;
      	 $image->rotate($b);
      	  $image->save('upload/'.'6_1.jpg'); 
      	  $count = 1;
        }
        
        if(isset($_POST['sharpen']))
        {
        	 $a = $_POST['Attribute']['sharpen'];
		  $b = (int)$a;
      	 $image->sharpen($b);
      	  $image->save('upload/'.'6_1.jpg'); 
      	  $count = 1;
        }
        
        if(isset($_POST['quality']))
        {
        	 $a = $_POST['Attribute']['quality'];
		  $b = (int)$a;
      	 $image->quality($b);
      	  $image->save('upload/'.'6_1.jpg'); 
      		
      	  $count = 1;
        }
      	
	if(isset($_POST['save']))
        {
      	
      		$count = 1;
        }
        if ($count == 0)
			$image->save('upload/'.'6_1.jpg'); 
			
		if(isset($_POST['buttonCancel']))
        {
         	unlink(Yii::app()->basePath.'/../upload/'. '6_1.jpg');
        	$this->redirect(Yii::app()->homeUrl);
        }
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('editor', array('a'=>$id, 'model'=>$model,));
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Asset $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='asset-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionProperties($id){
		
		$model=$this->loadModel($id);
		
		$this->render('properties',
		 array('model'=>$model)
		);
	}
	public function actionInfoOptions($id){
		
		$model=$this->loadModel($id);
		
		$this->render('infoOptions',
		 array('model'=>$model)
		);
	}
	
	/*
	 * view of asset for reviewer to authorize/reject
	 */
	
	public function actionReviewAssetDetails($id){
		
			$model=$this->loadModel($id);
		
			$this->render('reviewAssetDetails',
		 	array('model'=>$model)
			);
	}
	
	public function actionHistory($id){
		$model=$this->loadModel($id);
		
		$this->render('history',
		 array('model'=>$model)
		);
		
	}
	
	public function actionVersionViewUpdate($id = null) {
		$model = AssetRevision::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
 
        $this->renderPartial('../AssetRevision/view', array('model' => $model));
        Yii::app()->end();
	}

	public function actionInfoOptionsViewUpdate($id = null) {
		$model = Asset::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
 
        $this->renderPartial('infoOptions', array('model' => $model));
        Yii::app()->end();
	}
	
	
	
	
	
	public function actionUserTable($id = null) {
        $model = Ou_structure::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
 
        $this->renderPartial('usersPermission', array('model' => $model));
        Yii::app()->end();
	}
	
	public function actionDownload($id){
	
		$model = $this->loadModel($id);
		//print_r(	Yii::app()->user->getId());die();
		if (isset($_SERVER['HTTP_RANGE'])) 
			$range = $_SERVER['HTTP_RANGE'];
			$dir_path = Yii::getPathOfAlias('webroot') .'/upload/'.Yii::app()->user->getId().'/'.$model->categoryId.'/';
		
			$filePath=$dir_path.$id.'.dat';
			if (file_exists($filePath))
    		{
        		
    			//updates the fileaccesslog
				$command = Yii::app()->db->createCommand();
				$command->insert('fileaccesslog', array(
    					'action'=>'D',
    					'assetId'=>$model->assetId,
						'uId'=> Yii::app()->user->getState("uid"),
					));
				
    			
    			// send headers to browser to initiate file download
        		header ('Content-Type: application/octet-stream');
        		header ('Content-Disposition: attachment; filename="' . $model->file . '"');
        		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        		header('Pragma: public');
        		readfile($filePath);
        		
        		
        		
           }
   		 else
    		{
        		echo 'File does not exist...';
    		}
			
	  }

	  public function actionCheckOut($id){
			$model=$this->loadModel($id);
		
			
			$this->render('checkOut',
		 	array('model'=>$model)
		);  	
	  }
	  
	  public function actionCheckOutAsset($id){
	
		$model = $this->loadModel($id);
		//print_r(	Yii::app()->user->getId());die();
		if (isset($_SERVER['HTTP_RANGE'])) 
			$range = $_SERVER['HTTP_RANGE'];
			$dir_path = Yii::getPathOfAlias('webroot') .'/upload/'.Yii::app()->user->getId().'/'.$model->categoryId.'/';
		
			$filePath=$dir_path.$id.'.dat';
			if (file_exists($filePath))
    		{
    			
    			$command = Yii::app()->db->createCommand();
        		$command->update('asset', array(
   				 'status'=>2,
				), 'assetId=:assetId', array(':assetId'=>$model->assetId));
        		
        		// send headers to browser to initiate file download
        		header ('Content-Type: application/octet-stream');
        		header ('Content-Disposition: attachment; filename="' . $model->file . '"');
        		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        		header('Pragma: public');
        		readfile($filePath);
        		
        		//updates the fileaccesslog
				$command = Yii::app()->db->createCommand();
				$command->insert('fileaccesslog', array(
    					'action'=>'CO',
    					'assetId'=>$model->assetId,
						'uId'=> Yii::app()->user->getState("uid"),
					));
        		
				
           }
   		 else
    		{
        		echo 'File does not exist...';
    		}
			
	  }
	  
	  	  
		public function actionAuthorizeOrReject($id)
		{
    		$model=$this->loadModel($id);

    		// uncomment the following code to enable ajax-based validation
    		/*
    		if(isset($_POST['ajax']) && $_POST['ajax']==='asset-authorizeOrReject-form')
    		{
        		echo CActiveForm::validate($model);
        		Yii::app()->end();
    		}
    		*/
    		
    		

    		if(isset($_POST['buttonAuthorize']))
    		{
       			 //$model->attributes=$_POST['Asset'];
       			 
        		 
        		{
            		// form inputs are valid, do something here
            		$command = Yii::app()->db->createCommand();
					$command->update('asset', array(
   				 	'status'=>1,
						), 'assetId=:assetId', array(':assetId'=>$model->assetId));
        			$this->redirect(array("/users/review/".Yii::app()->user->getState("uid")));
        		}
    		}
			if(isset($_POST['buttonReject']))
    		{
       			 //$model->attributes=$_POST['Asset'];
       			 
        		 
        		{
            		// form inputs are valid, do something here
            		$command = Yii::app()->db->createCommand();
					$command->update('asset', array(
   				 	'status'=>5,
						), 'assetId=:assetId', array(':assetId'=>$model->assetId));
        			
            		$this->redirect(array("/users/review/".Yii::app()->user->getState("uid")));
        		}
    		}
    		$this->render('authorizeOrReject',array('model'=>$model));
		}
		
		
		
	/*
	 * function for checkIn of a particular asset
	 */	
	public function actionCheckInform2($id)
		{
			//loads the particular model
			$model = $this->loadModel($id);
		
 			//on submit button the file is saved
			if(isset($_POST['buttonSubmit'])){
				//if file errors are present
				if ($_FILES["file"]["error"] > 0) {
  					echo "Error: " . $_FILES["file"]["error"] . "<br>";
				}
				
				//get the file
				else {
  					echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  					echo "Type: " . $_FILES["file"]["type"] . "<br>";
  					echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  					echo "Stored in: " . $_FILES["file"]["tmp_name"];
  					
  					$command = Yii::app()->db->createCommand();
        		
	  	  			//changing the data of the asset checked in , in the database
	  	  			$command->update('asset', array(
   				 	'file'=>$_FILES["file"]["name"],
	  	  			'size'=>$_FILES["file"]["size"],
	  	  			'type'=>$_FILES["file"]["type"],
	  	  			'status'=>3,
						), 'assetId=:assetId', array(':assetId'=>$model->assetId));
  					
  				}
			
				$file = $_FILES["file"]["tmp_name"];
				//moves the file to required place
				$orgId = Yii::app()->user->getId();
				$categoryId = $model->categoryId;
				$assetId = $model->assetId;

				//counts the number of revisions alreaay present for the record and assign present number to new revision
			    $records = AssetRevision::model()->findAll('assetId=:assetId',array(':assetId'=>$model->assetId));
			    $presentNumber = count($records);
			    
				
				if(move_uploaded_file($_FILES["file"]["tmp_name"],
      			Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->assetId.'.dat'))
      			
      			{
      				copy($folder .Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$model->assetId.'.dat' ,
      				Yii::app()->basePath.'/../upload/'.$orgId.'/'.$categoryId.'/'.$assetId.'/'.$model->assetId.'_'.$presentNumber.'.dat'  );
      				
      			}

      			
				//updates the fileaccesslog
				$command = Yii::app()->db->createCommand();
				$command->insert('fileaccesslog', array(
    					'action'=>'CI',
    					'assetId'=>$model->assetId,
						'uId'=> Yii::app()->user->getState("uid"),
					));

				//inserting new record to asset revision
				$command->insert('asset_revision', array(
    					'assetId'=>$model->assetId,
						'modifiedBy'=> Yii::app()->user->getState("uid"),
						'note'=>$_POST['note'],
						'revision'=>$presentNumber,
						
					));
					
					
				
			    
      	//redirect back to the checkIn page of the user    
        $this->redirect(array("/users/checkIn/".Yii::app()->user->getState("uid")));
  	}

  	//renders the checkInform2 for the user
	$this->render('checkInform2',array('model'=>$model));				
					
	}

	/*
	 * Download according to the version
	 */
	
	public function actionDownloadVersion($id,$version){
	
		$model = $this->loadModel($id);
		//print_r(	Yii::app()->user->getId());die();
		if (isset($_SERVER['HTTP_RANGE'])) 
			$range = $_SERVER['HTTP_RANGE'];
			$dir_path = Yii::getPathOfAlias('webroot') .'/upload/'.$model->orgId.'/'.$model->categoryId.'/'.$model->assetId.'/';
		
			$filePath=$dir_path.$id.'_'.$version.'.dat';
			if (file_exists($filePath))
    		{
    			
    			//updates the fileaccesslog
				$command = Yii::app()->db->createCommand();
				$command->insert('fileaccesslog', array(
    					'action'=>'D',
    					'assetId'=>$model->assetId,
						'uId'=> Yii::app()->user->getState("uid"),
					));
				
    			
        		// send headers to browser to initiate file download
        		header ('Content-Type: application/octet-stream');
        		header ('Content-Disposition: attachment; filename="' . $model->file . '"');
        		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        		header('Pragma: public');
        		readfile($filePath);
           }
   		 else
    		{
        		echo 'File does not exist...';
    		}
			
	  }
	  
	  
	  
	  
	public function actionAjaxCheckbox(){
	/*$data=Category::model()->findAll('topic_id=:topic_id',
            array(':categoryId'=>(int) $_POST['Users']['categoryId']));

   $data=CHtml::listData($data,'category_id','category_name');

   foreach($data as $value=>$category_name)
   {
        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($category_name),true);
   } 
	*/
		
		//print_r($_POST['Asset']['categoryId']);
		
		//$command = Yii::app()->db->createCommand();
		


if(!isset($_POST['Asset']['categoryId']))
        
            throw new CHttpException(404, 'The requested page does not exist.');
 else
 {
 	print_r("_postt");
 	print_r($_POST['Asset']['categoryId']);
 	
 	$dept_id = Yii::app()->db->createCommand()
    ->select('id' )
    ->from('category_has_ou_structure')
	 ->where('cat_id=:id', array(':id'=>$_POST['Asset']['categoryId']))
    ->queryAll();
    
    print_r("dept_id");
    print_r($dept_id);
    
    $tagId = Yii::app()->db->createCommand()
    ->select('tagId' )
    ->from('tags_has_ou_structure')
	 ->where('id=:id', array(':id'=>$dept_id))
    ->queryAll();
    
     print_r("tag_id");
    print_r($tagId);
 	
    
 	
 	
 	
 /*	$dept_id = Yii::app()->db->createCommand(array(
    'select' => array('id'),
    'from' => 'CategoryHasOuStructure',
    'where' => 'cat_id=:id',
    'params' => array(':id'=>$_POST['Asset']['categoryId']),
	))->queryAll(); 
	
	$tagId=Yii::app()->db->createCommand(array(
    'select' => array('tagId'),
    'from' => 'TagsHasOuStructure',
    'where' => 'id=:id',
    'params' => array(':id'=>$dept_id),
	))->queryAll();
	
	
/*	$tagName=Yii::app()->db->createCommand(array(
    'select' => array('tagName'),
    'from' => 'Tags',
    'where' => 'tagId=:id',
    'params' => array(':id'=>$dept_id),
	))->queryAll(); */
	
	
	//$usersId = array(1,2); //must be array
	
$criteria=new CDbCriteria();
$criteria->select = 'tagName';
$criteria->addInCondition('tagId',$tagId);

//$criteria = new CDbCriteria();
//$criteria->condition = 'id=:id';
//$criteria->params = array(':id'=>$id);
$tagName = Tags::model()->findAll($criteria);

print_r($model1);
 	
        $this->renderPartial('ajaxcheckbx', array('tagName' => $tagName));
        Yii::app()->end();
        
        
	
 }
	
	
	}
	
	
}	
			
    			  



