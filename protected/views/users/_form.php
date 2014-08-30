<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<style type="text/css">
 	 .checkbox.inline + .checkbox.inline{
 	 margin-left:0px;
 	 padding-right:10px !important;}
 	 .checkbox{
 	 padding-right: 10px !important;
 	 width: 35%;}
</style>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'users-form',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	
'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<?php echo $form->textFieldControlGroup($model, 'name',array('label'=>'Username','Placeholder'=>'Username')); ?>
	
	<?php echo $form->emailFieldControlGroup($model, 'email',array('label'=>'Email','Placeholder'=>'Valid email id',
		'help'=>'Please enter a freuently used email id')); ?>
	
	
	<?php 
			 $orgId= Yii::app()->user->getId();
			 $connection = Yii::app()->db;
			 $sql3 = "select id from ou_structure where orgId = :orgId";
			 $command = $connection->createCommand($sql3);
			 $command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
			 $dataReader = $command->query();
	         $row = $dataReader->read();
	         $dataReader->close();
	         $ans = $row['id'];
	         
	  	
	         
			 $criteria=new CDbCriteria();
			 $criteria->compare('root', $ans, true);
			 echo  $form->dropDownListControlGroup($model,'ouId',
			 CHtml::listData(Ou_structure::model()->findAll($criteria), 'id', 'name'), 
			 array('span'=>3,'label'=>'Department'), array('label'=>'child')); ?>
	
	<?php echo $form->passwordFieldControlGroup($model, 'password',array('label'=>'Password','Placeholder'=>'Password',
		'help'=>'')); ?>
	
	<?php echo $form->passwordFieldControlGroup($model, 'cpassword',array('label'=>'Confirm Password','Placeholder'=>'Password',
		'id'=>'cpassword')); ?>
	
			
	
	<?php echo $form->textFieldControlGroup($model,'mobile',array('label'=>'Phone','Placeholder'=>'Phone Number')); ?>
	
	<?php echo $form->fileFieldControlGroup($model,'picture',array('label'=>'Photo'));?>
	
	<div class="span12">
	<div class="" style="margin-left:6.4em">
		  
	    <?php 
    $criteria = new CDbCriteria();
    $orgId = Yii::app()->user->getId();
   $criteria->compare('orgId', $orgId, true);
    echo $form->labelEx($model,'Roles');
    $type_list=CHtml::listData(Role::model()->findAll(),'rid','name');
    echo $form->checkBoxList($model,'roles',$type_list,array('checked'=>'checked','value' => '1', 'uncheckValue'=>'0','template'=>'{input}{label}',
            'separator'=>'',
 
        'labelOptions'=>
           array(
           
            'style'=> ' padding-left:6.4em;
                    width: 100px;
                    height:60px;
                    float: left;
                '),
              'style'=>'float:left;',
              ) 
    ); 
    
	    ?>
	 </div>
	 
	  
	 	 
	 </div>
	  <?php echo $form->radioButtonListControlGroup($model, 'status', array(
	  	  'Blocked',
	  	  'Active',
	  	  )); ?>

	     
	 <div class="row buttons" id="" >
		<?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'B1','color'=>TbHtml::BUTTON_COLOR_PRIMARY,)); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		    
	
	
	</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
	
	