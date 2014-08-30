
<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<style type="text/css">
 	 .checkbox.inline + .checkbox.inline{
 	 margin-left:0px;
 	 padding-right:10px !important;}
 	 .checkbox{
 	 padding-right: 10px !important;
 	 width: 35%;}
</style>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'pchange',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<h1>Select the permissions for modules you want to assign to the role</h1>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	
	
	<div class="span12">
	
	<div class="" style="margin-left:-2em">
		<?php 
		 $orgId= Yii::app()->user->getId();
			$criteria=new CDbCriteria();
			$criteria->compare('orgId', $orgId, true);
		echo TbHtml::inlinecheckBoxListControlGroup('Modules','',CHtml::listData(ModData::model()->findAll(), 'mod_id', 'mod_name'), array('span'=>3,'label'=>'Modules','help' => '<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>	 
	 </div>	 
	 <div class="" style="margin-left:-2em">
		<?php 
		 $orgId= Yii::app()->user->getId();
			$criteria=new CDbCriteria();
			$criteria->compare('orgId', $orgId, true);
		echo TbHtml::inlinecheckBoxListControlGroup('basicpermissions','',CHtml::listData(Basicpermissions::model()->findAll(), 'id', 'vpermission'), array('span'=>3,'label'=>'Permssions','help' => '<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>	 
	 </div>	 
	 <div class="span12">
	
	 </div>
	
	
	    
	<div class="row buttons" id="">
		<?php echo TbHtml::submitButton(Yii::t('Yii','Update'),array(
 			'name'=>'buttonUpdate',
			'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    ));?>
		<?php //echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'B1')); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		    
	
	
	</div>

	
	

	<?php $this->endWidget(); ?>

	</div><!-- form -->
	
	<script type="text/javascript">
	/*$(input['B1']).on('submit',function(){
   		if($('#Users_password').val()!=$('#cpassword').val()){
       	alert('Password not matches');
       	return false;
   		}
   	return true;
		});*/
	</script>
