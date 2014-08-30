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
<?php 
$this->menu=array(
	array('label'=>'List Role', 'url'=>array('index')),
	array('label'=>'Manage Role', 'url'=>array('admin')),
);
?>


 
<?php $gridColumns = array(
			/*array('name'=>'rid', 'header'=>'Role_id'),*/
			array('name'=>'name', 'header'=>'ROLE'),
			array('name'=>'weight','header'=>'EDIT PERMISSIONS','type'=>'raw', 
			'value'=>'CHtml::link("Edit permissions", array("role/","permission_change"=>$data->rid))'),
			array('name'=>'weight','header'=>'EDIT ROLE','type'=>'raw', 
			'value'=>'CHtml::link("Edit Role", array("role/", "update"=>$data->rid))'),
			array('name'=>'weight','header'=>'VIEW PERMISSIONS','type'=>'raw', 
			'value'=>'CHtml::link("View permissions", array("role/", "view_permission"=>$data->rid))'),
);?>
<?php 
 
$criteria=new CDbCriteria;
$orgId = Yii::app()->user->getId();
$criteria->compare('orgId',$orgId);

$dataProvider = new CActiveDataProvider('Role', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'weight ASC',
			),
));

?>

<?php $this->widget('bootstrap.widgets.TbGridView1',array(
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$dataProvider,
	/*'itemView'=>'_view',*/
	'columns'=>$gridColumns,
));
?>


 
 
<?php //echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE); ?>
	
    <?php //echo $form->textFieldControlGroup($model, 'name', array('placeholder'=>'Name')); ?>
    <?php //echo $form->textFieldControlGroup($model, 'weight',array('placeholder'=>'Weight')); ?>
    <?php //echo $form->textFieldControlGroup($model, 'description', array('placeholder'=>'Description')); ?>
    
    <?php 
    // echo CHtml::link("Add Role",array("role/create")); 
   // echo TbHtml::submitButton($model->isNewRecord ? 'Add role' : 'Save',array(
		//    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		  //  ));
    ?>
    
<?php //echo TbHtml::endForm(); ?>
<?php //$this->endWidget(); ?>
<?php
/* @var $this RoleController */
/* @var $model Role */
/* @var $form TbActiveForm */
?>

<style type="text/css">

 .btn{
 margin-right:15px;}

</style>


<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'role-form',
    'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    
    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>3,'maxlength'=>60)); ?>

            <?php echo $form->textFieldControlGroup($model,'weight',array('span'=>3)); ?>
            
             <?php echo $form->textFieldControlGroup($model,'description',array('span'=>3)); ?>

        <div class="form-actions">
        
         <div class="row buttons">   
          <?php 
        
            echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    ));
			
		   ?>
		   </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->