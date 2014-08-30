<?php
/* @var $this RoleController */
/* @var $model Role */
?>

<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->name=>array('view','id'=>$model->rid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Role', 'url'=>array('index')),
	array('label'=>'Create Role', 'url'=>array('index')),
	array('label'=>'View Role', 'url'=>array('view', 'id'=>$model->rid)),
	array('label'=>'Manage Role', 'url'=>array('admin')),
);
?>

    <h1>Update Role <?php echo $model->rid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>