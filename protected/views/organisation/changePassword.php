<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'users-changepassword-form',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>
	<legend>CHANGE PASSWORD</legend>
	<?php echo $form->passwordFieldControlGroup($model, 'oldpassword',array('label'=>' Old Password','Placeholder'=>'Password')); ?>
	
	<?php echo $form->passwordFieldControlGroup($model, 'newpassword',array('label'=>' confirm Password','Placeholder'=>'Password')); ?>
	
	
	<div class="row buttons" id="">
		<?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
	</div>	    
	
</fieldset>
	<?php $this->endWidget(); ?>

