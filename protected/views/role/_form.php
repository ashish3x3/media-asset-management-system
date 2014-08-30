<?php
/* @var $this RoleController */
/* @var $model Role */
/* @var $form TbActiveForm */
?>

<style type="text/css">

 .btn{
 margin-right:15px;}

</style>


<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'role-form',
    'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>3,'maxlength'=>60)); ?>

            <?php echo $form->textFieldControlGroup($model,'weight',array('span'=>3)); ?>
            
             <?php echo $form->textFieldControlGroup($model,'description',array('span'=>3)); ?>

        <div class="form-actions">
        
         <div class="row buttons">   
          <?php 
        
            echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    ));
			echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));
		    
		   ?>
		   </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->