<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<fieldset>	
	<?php echo $form->textFieldControlGroup($model, 'username',
		array('label'=>'Username','Placeholder'=>'Username'));?>
	<?php echo $form->passwordFieldControlGroup($model, 'password',
		array('label'=>'Password','Placeholder'=>'Password'));?>
	<div style="margin-left:3em;">
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo TbHtml::submitButton('Login',array('color'=>TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
	</div>
	</div>

</fieldset>
<?php $this->endWidget(); ?>
</div><!-- form -->
	
