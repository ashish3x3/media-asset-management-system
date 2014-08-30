<?php
/* @var $this AssetController */
/* @var $model Asset */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'asset-checkInform2-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	
	   <h2><?php echo "checkIn file".$model->file."\n";?></h2>
	   <br />
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
		   
	   
	   <?php echo CHtml::FileField('file', '');?>

		<?php echo TbHtml::label('Note for checkIn','note')?>
	   	<?php echo TbHtml::textArea('note', '', array('rows' => 3,'span'=>8)); ?>
	
	
       <?php //echo CHtml::button('Submit', array('submit' => array('users/checkIn','id'=>Yii::app()->user->getState("uid")),'id'=>'submitButton'));?>
    	<?php echo TbHtml::submitButton('Submit',array('name'=>'buttonSubmit','color'=>TbHtml::BUTTON_COLOR_PRIMARY)); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->
