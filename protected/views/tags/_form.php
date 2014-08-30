<?php
/* @var $this TagsController */
/* @var $model Tags */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'tags-form',
    'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
            
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
			 echo  TbHtml::dropDownListControlGroup('dept_id','',
			 CHtml::listData(ou_structure::model()->findAll($criteria), 'id', 'name'), 
			 array('span'=>3,'label'=>'Add tag for','multiple'=>true), array('label'=>'child')); ?>
			
            
			<?php echo $form->textfieldControlGroup($model,'tagName',
			array('span'=>2,'rows'=>1,'label'=>'Tag Name','help'=>'Add multiple tags with commas(,)')); ?>
			
			 
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    
		)); ?>
		
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		    
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->