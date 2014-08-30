<?php
/* @var $this RoleHasPermissionsController */
/* @var $model RoleHasPermissions */
?>

<?php
$this->breadcrumbs=array(
	'Role Has Permissions'=>array('index'),
	$model->pid,
);

$this->menu=array(
	array('label'=>'List RoleHasPermissions', 'url'=>array('index')),
	array('label'=>'Create RoleHasPermissions', 'url'=>array('create')),
	array('label'=>'Update RoleHasPermissions', 'url'=>array('update', 'id'=>$model->pid)),
	array('label'=>'Delete RoleHasPermissions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleHasPermissions', 'url'=>array('admin')),
);
?>

<h1>View RoleHasPermissions #<?php echo $model->pid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'rid',
		'pid',
	),
)); ?>