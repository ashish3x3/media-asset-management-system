<?php
/* @var $this AssetRevisionController */
/* @var $model AssetRevision */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'assetId',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'modifiedOn',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'modifiedBy',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'note',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'revision',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->