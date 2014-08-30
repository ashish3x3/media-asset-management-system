   <style type="text/css">
    #form1{
    margin-top:5em;}
   </style>
   
   <div id="form1">
   <?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL); ?>
   <fieldset>
     <legend>ADD DEPARTMENTS TO YOUR ORGANISATION</legend>
     <?php echo TbHtml::numberFieldControlGroup('Unitcode', '',
     array('label' => 'Unit code', 'placeholder' => 'Unitcode','min'=>0)); ?>
     <?php echo TbHtml::textFieldControlGroup('name', '',
     array('label' => 'Unit name', 'placeholder' => 'unit name')); ?>
     
     <?php echo TbHtml::textAreaControlGroup('textArea','',
     array('label'=>'Description','span'=>8,'rows'=>'5')); ?>

     <div class="span4 offset1">
     <?php echo TbHtml::button('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
     <?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		
     </div>
     
     </fieldset>
    <?php echo TbHtml::endForm(); ?>
    </div>
