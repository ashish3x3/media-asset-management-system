<?php
/* @var $this AssetController */
/* @var $data Asset */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('assetId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->assetId),array('view','id'=>$data->assetId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assetName')); ?>:</b>
	<?php echo CHtml::encode($data->assetName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDate')); ?>:</b>
	<?php echo CHtml::encode($data->createDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publication')); ?>:</b>
	<?php echo CHtml::encode($data->publication); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('onlineEditable')); ?>:</b>
	<?php echo CHtml::encode($data->onlineEditable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewer')); ?>:</b>
	<?php echo CHtml::encode($data->reviewer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reviewerComments')); ?>:</b>
	<?php echo CHtml::encode($data->reviewerComments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownerId')); ?>:</b>
	<?php echo CHtml::encode($data->ownerId); ?>
	<br />

	*/ ?>

</div>