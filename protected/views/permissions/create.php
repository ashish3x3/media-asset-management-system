<?php
/* @var $this PermissionsController */
/* @var $model Permissions */
?>

<?php
$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Permissions', 'url'=>array('index')),
	array('label'=>'Manage Permissions', 'url'=>array('admin')),
);
?>

<h1>Create Permissions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>