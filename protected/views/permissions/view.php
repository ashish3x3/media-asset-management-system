<?php
/* @var $this PermissionsController */
/* @var $model Permissions */
?>

<?php
$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Permissions', 'url'=>array('index')),
	array('label'=>'Create Permissions', 'url'=>array('create')),
	array('label'=>'Update Permissions', 'url'=>array('update', 'id'=>$model->pid)),
	array('label'=>'Delete Permissions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Permissions', 'url'=>array('admin')),
);
?>

<h1>View Permissions #<?php echo $model->pid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'pid',
		'name',
		'desc',
		//'mid',//instead have to display role name
		array('name'=>'Module Name',
		       'value'=>$model->module->name
		),
	),
)); ?>