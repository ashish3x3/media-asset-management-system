<?php
/*
 * form for check in of a document
 */		
?>


<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'asset-checkin-form',
    'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<fieldset>
	<legend>CHECK IN <?php echo $model->file; ?></legend>
    
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php $model1 = new AssetRevision; ?>
            
            <?php echo $form->textFieldControlGroup($model,'file',array('disabled'=>true,'placeholder'=>$model->file)); ?>

			<?php echo $form->textAreaControlGroup($model,'description',array('disabled'=>true,'rows'=>3,'span'=>6,'placeholder'=>$model->description)); ?>
			
            
            <?php echo $form->fileFieldControlGroup($model,'file'); ?>
			
			<?php echo $form->textAreaControlGroup($model1,'note',array('rows'=>3,'span'=>6)); ?>

            
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,

		)); ?>
		
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		
		
    </div>
</fieldset>
    <?php $this->endWidget(); ?>

</div><!-- form -->