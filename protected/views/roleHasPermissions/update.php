<?php
/* @var $this RoleHasPermissionsController */
/* @var $model RoleHasPermissions */
?>

<?php
$this->breadcrumbs=array(
	'Role Has Permissions'=>array('index'),
	$model->pid=>array('view','id'=>$model->pid),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleHasPermissions', 'url'=>array('index')),
	array('label'=>'Create RoleHasPermissions', 'url'=>array('create')),
	array('label'=>'View RoleHasPermissions', 'url'=>array('view', 'id'=>$model->pid)),
	array('label'=>'Manage RoleHasPermissions', 'url'=>array('admin')),
);
?>

    <h1>Update RoleHasPermissions <?php echo $model->pid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>