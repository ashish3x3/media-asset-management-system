<?php
/* @var $this DepartmentController */
/* @var $data Department */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dept_id),array('view','id'=>$data->dept_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orgId')); ?>:</b>
	<?php echo CHtml::encode($data->orgId); ?>
	<br />


</div>