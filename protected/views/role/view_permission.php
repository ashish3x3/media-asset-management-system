<div class="form">


<?php

$orgId = Yii::app()->user->getId();
$connection = Yii::app()->db;

$sq = "select mid from module_organisation where orgId = :orgId";
$command = Yii::app()->db->createCommand($sq);
$command->bindParam(":orgId",$orgId,PDO::PARAM_INT);
$dataReader = $command->query();
//$dataReader->close();

$number=0;
   
while (($model1 = $dataReader->read())!== false)
{

$a = $model1['mid'];

$criteria=new CDbCriteria;
$criteria->compare('mid', $a, false);
$dataProvider = new CActiveDataProvider('permissions', array('criteria'=>$criteria));

$sq = "select name from module where mid = :mid";
$command = Yii::app()->db->createCommand($sq);
$command->bindParam(":mid",$a,PDO::PARAM_INT);
$dataReader3 = $command->query();
$row = $dataReader3->read();
    //$dataReader3->close();
$b = $row['name'];


$this->rid = $model->rid;
$this->widget('zii.widgets.grid.CGridView', array(
'id'=>'gview',
'selectableRows'=>0,
'dataProvider'=>$dataProvider,
'rowHtmlOptionsExpression' => 'array("id"=>$data->pid)',
'columns'=>array(
   array('name'=>'name','header'=>$b),  
   
   array(
       'class'=>'CCheckBoxColumn',
       'id'=>'CB'.$number,
       'selectableRows'=>0,
   		'checked'=> 'Yii::app()->controller->isChecked($this->grid->controller->rid, $data->pid)' , 	
   )    	
),
   	  )
);
$number++;
}
?>
	<div class="form-actions">
	<div class="row buttons" id="">
		<?php  echo TbHtml::submitButton('Submit',array(
 			'name'=>'buttonUpdate',
			'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    ));?>
		<?php //echo TbHtml::submitButton($model->isNewRecord ? 'Permission_change' : 'Save'); ?>
		<?php echo TbHtml::submitButton(Yii::t('Yii','Cancel'),array(
 			'name'=>'buttonCancel',
			'color'=>TbHtml::BUTTON_COLOR_DANGER,
		    ));?>
		    
	</div>
   </div>
   
 
</div>
 
 

