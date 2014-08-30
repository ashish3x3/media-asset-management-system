<?php
/* @var $this PermissionsController */
/* @var $model Permissions */
?>

<?php
$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	$model->name=>array('view','id'=>$model->pid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Permissions', 'url'=>array('index')),
	array('label'=>'Create Permissions', 'url'=>array('create')),
	array('label'=>'View Permissions', 'url'=>array('view', 'id'=>$model->pid)),
	array('label'=>'Manage Permissions', 'url'=>array('admin')),
);
?>

    <h1>Update Permissions <?php echo $model->pid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>