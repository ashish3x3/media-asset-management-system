<?php
/* @var $this OrganisationController */
/* @var $data Organisation */
?>

<div class="view">

	<b id ="label_org"><?php echo CHtml::encode($data->getAttributeLabel('Organisation Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orgId), array('view', 'id'=>$data->orgId)); ?>
	<br />

	<b id ="label_org"><?php echo CHtml::encode($data->getAttributeLabel('Organisation Name')); ?>:</b>
	<?php echo CHtml::encode($data->orgName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No of employees')); ?>:</b>
	<?php echo CHtml::encode($data->noEmp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address Street 1')); ?>:</b>
	<?php echo CHtml::encode($data->addr1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address Street 2')); ?>:</b>
	<?php echo CHtml::encode($data->addr2); ?>
	<br />

	 
	<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Type Of organisation')); ?>:</b>
	<?php echo CHtml::encode($data->orgType); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	
	

</div>