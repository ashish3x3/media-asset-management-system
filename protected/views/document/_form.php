<?php
/* @var $this DocumentController */
/* @var $model Document */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'document-form',
    'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

			<?php echo $form->fileFieldControlGroup($model,'file'); ?>
			
		    <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>3,'maxlength'=>70,'label'=>'File Name')); ?>

            <?php echo $form->dropDownListControlGroup($model,'ownerId',CHtml::listData(Users::model()->findAll(), 'uid', 'name')); ?>
            
            <?php echo $form->dropDownListControlGroup($model,'departmentId',CHtml::listData(Ou_structure::model()->findAll(), 'id', 'name')); ?>
            
         	<?php echo $form->dropDownListControlGroup($model,'categoryId',CHtml::listData(Category::model()->findAll(), 'cat_id', 'name')); ?>
            
			<?php  echo TbHtml::inlinecheckBoxListControlGroup('tags','',CHtml::listData(Tags::model()->findAll(), 'tagId', 'tagName'), array('span'=>3,'label'=>'Roles','help' => '<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>	 
	 
         

            <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>4,'span'=>8)); ?>

            <?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>1,'span'=>8)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		)); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		
		<?php
			$dataProvider = new CActiveDataProvider('Users');
			$model1 = Users::model()->findAll();
			$number = 0;
 			foreach ($model1 as $model2)
 				{
 				$string = $model2->name;
				$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'gview',
				'selectableRows'=>2,
				'dataProvider'=>$dataProvider,

				'columns'=>array(
    			array('name'=>'name','header'=>'Permissions'),    /*in header give the role name while passing*/
	    		array(
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'read'.$number,
	        		'selectableRows'=>1,
	    			'header'=>'Read'
	    		),    	
	    		array(
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'write'.$number,
	        		'selectableRows'=>1,
	    			'header'=>'Write'
	    		),
	    		array(
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'edit'.$number,
	        		'selectableRows'=>1,
	    			'header'=>'Edit'
	    		),    	
	      ),
   		)
		);
 		$number++;
 		}
	?>
		
		
		
		
	    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->