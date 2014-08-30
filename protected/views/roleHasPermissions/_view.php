<?php
/* @var $this RoleHasPermissionsController */
/* @var $data RoleHasPermissions */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('pid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pid),array('view','id'=>$data->pid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rid')); ?>:</b>
	<?php echo CHtml::encode($data->rid); ?>
	<br />


</div>