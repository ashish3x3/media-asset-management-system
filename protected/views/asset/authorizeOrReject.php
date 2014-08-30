<?php
/* @var $this AssetController */
/* @var $model Asset */
/* @var $form CActiveForm */
?>
<style type="text/css">

	#box1{
	margin-left:3em;}
	{
	margin-left:6em;}
</style>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'asset-authorizeOrReject-form',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<h2>AUTHORIZE OR REJECT <?php echo $model->file;?></h2>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo TbHtml::label('File', 'file'); ?>
	<?php echo TbHtml::textField('file',$model->file,array('disabled'=>true,'placeholder'=>$model->file)); ?>	

	<div id="note" style="">
			<?php echo TbHtml::label('Comment', 'comment'); ?>
			<?php echo TbHtml::textArea('comment','',array('label'=>'comment','rows'=>3,'span'=>6)); ?>
	</div>
     
     <div id="label1">
    <?php echo TbHtml::label('email all users', 'email'); ?> </div>       
    <?php echo TbHtml::checkBoxControlGroup('email', '', array(
        
       )); ?>        
    
     <div id="label1">
    <?php echo TbHtml::label('email to department', 'email2'); ?> </div>       
    <?php echo TbHtml::checkBoxControlGroup('email2', '', array(
        
       )); ?>        
    <?php echo TbHtml::label('email to users', 'email3'); ?>   
    <?php echo TbHtml::dropDownList('email3',' ',CHtml::listData(Users::model()->findAll(),'uid','name'),array('label'=>'email to users','multiple'=>true)); ?>   
	
	<div class="row buttons">
		<?php echo TbHtml::submitButton('Authorize',array('name'=>'buttonAuthorize','color'=>TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		<?php echo TbHtml::submitButton('Reject',array('name'=>'buttonReject','color'=>TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		<?php echo TbHtml::Button('Cancel', array('submit' => CHttpRequest::getUrlReferrer(),'color'=>TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->