<?php
/* @var $this OrganisationController */
/* @var $model Organisation */
/* @var $form CActiveForm */
?>

<style>
	.add-on{
	margin-top:3px;
	margin-left:0px;}

</style>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'organisation-form',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<fieldset>
		<!--<legend>CREATE A NEW ORGANISATION</legend>-->
		
		<p class="note">Fields with <span class="required">*</span> are required.</p>
		
		<?php echo $form->errorSummary($model); ?>
		
		<?php echo $form->textFieldControlGroup($model, 'orgName',array('label'=>'Organisation Name','Placeholder'=>'Name of your organisation')); ?>
		
		<?php echo $form->numberFieldControlGroup($model,'noEmp',array('label'=>'Number of employess','min'=>0,'placeholder'=>0));?>
		
		<?php echo $form->textFieldcontrolGroup($model,'phone',
	        		array('maxlength'=>'12','minlength'=>'10','label'=>'Phone Number','placeholder' => 'Phone Number','prepend'=>'+91')); ?>
		
		<?php echo $form->emailFieldControlGroup($model, 'email',array('label'=>'Email','Placeholder'=>'Mail id of your organisation')); ?>
		
		<?php echo $form->textFieldControlGroup($model, 'addr1',array('label'=>'Address Street 1','Placeholder'=>'Address')); ?>
		
		<?php echo $form->textFieldControlGroup($model, 'addr2',array('label'=>'Address Street 2','Placeholder'=>'Address')); ?>
	
		<?php echo $form->textFieldControlGroup($model, 'state',array('label'=>'State','Placeholder'=>'State')); ?>
		
		<?php echo $form->textFieldControlGroup($model, 'country',array('label'=>'Country','Placeholder'=>'country')); ?>
		
		<?php echo $form->dropDownListControlGroup($model, 'orgType',
			array('Profit', 'Non-profit', 'NGO'), array('label'=>'Type Of organisation')); ?>
		
		<?php echo $form->textAreaControlGroup($model, 'description',
			array('span' => 8, 'rows' => 5,'label'=>'Description')); ?>

		<?php echo $form->textFieldcontrolGroup($model,'fax',
	        		array('maxlength'=>'12','minlength'=>'10','label'=>'Fax','placeholder' => 'Fax Number')); ?>

		
		<div class="row buttons">
		<?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		   
	</div>
	
	</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->
