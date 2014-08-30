<?php
/* @var $this Category1Controller */
/* @var $data Category1 */
?>

<div class="view">

	
    	<?php
	//no need of category id
    /*echo CHtml::encode($data->getAttributeLabel('cat_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cat_id),array('view','id'=>$data->cat_id)); */?>
	<br />	

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->cat_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Departments')); ?>:</b>
	<?php echo CHtml::encode($data->getDepartments()); ?>
	<br />

	<b><?php /* echo CHtml::encode($data->getAttributeLabel('unitCode')); ?>:</b>
	<?php echo CHtml::encode($data->ou_structure->name); */?>
	<br />
	
	<?php 
	//check with present department table
	?>
	<?php /* echo CHtml::encode($data->getAttributeLabel('unitCode')); ?>:</b>
	<?php echo CHtml::encode($data->unitCode);*/ ?>
	<br />


</div>