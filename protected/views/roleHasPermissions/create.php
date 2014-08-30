<?php
/* @var $this RoleHasPermissionsController */
/* @var $model RoleHasPermissions */
?>

<?php
$this->breadcrumbs=array(
	'Role Has Permissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RoleHasPermissions', 'url'=>array('index')),
	array('label'=>'Manage RoleHasPermissions', 'url'=>array('admin')),
);
?>

<h1>Create RoleHasPermissions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>