<?php
/* @var $this AssetRevisionController */
/* @var $model AssetRevision */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'asset-revision-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'assetId',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'modifiedOn',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'modifiedBy',array('span'=>5)); ?>

            <?php echo $form->textAreaControlGroup($model,'note',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textFieldControlGroup($model,'revision',array('span'=>5,'maxlength'=>10)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->