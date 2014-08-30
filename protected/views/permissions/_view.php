<?php
/* @var $this PermissionsController */
/* @var $data Permissions */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('pid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pid),array('view','id'=>$data->pid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />
	
	<?php //instead of role id have to display the roles for which this permission has been granted?>
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('role_rid'));*/ ?></b>
	<?php /* echo CHtml::encode($data->role_rid); */?>
	<br />


</div>