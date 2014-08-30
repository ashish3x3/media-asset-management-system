<?php
/* @var $this OrganisationController */
/* @var $model Organisation */

$this->breadcrumbs=array(
	'Organisations'=>array('index'),
	$model->orgId=>array('view','id'=>$model->orgId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Organisation', 'url'=>array('index')),
	
	array('label'=>'View Organisation', 'url'=>array('view', 'id'=>$model->orgId)),
	array('label'=>'Manage Organisation', 'url'=>array('admin')),
);
?>

<h1>Update Organisation <?php echo $model->orgId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>