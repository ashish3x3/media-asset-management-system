<?php
/* @var $this ModuleController */
/* @var $model Module */
?>

<?php
$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->name=>array('view','id'=>$model->mid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
	array('label'=>'Create Module', 'url'=>array('create')),
	array('label'=>'View Module', 'url'=>array('view', 'id'=>$model->mid)),
	array('label'=>'Manage Module', 'url'=>array('admin')),
);
?>

    <h1>Update Module <?php echo $model->mid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>