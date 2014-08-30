<?php
/* @var $this ReviewerOustructureController 
 @var $model ReviewerOustructure 
 @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reviewer-oustructure-reviewerFind-form',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<?php $department = Ou_structure::model()->find('id=:id',array(':id'=>$model->ouId))?>
	<p>Select the reviewer for ur department <b><?php echo $department->name;?></b> </p>
    
    
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<?php echo $form->dropDownListControlGroup($model,'uId',CHtml::listData(Users::model()->findAll('ouId=:ouId',array(':ouId'=>$model->ouId)), 'uid', 'name'),array('label'=>'reviewer'));
             ?>

	<div class="row buttons">
		<?php echo TbHtml::submitButton('Submit',array('color'=>TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->