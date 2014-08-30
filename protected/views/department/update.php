<?php
/* @var $this DepartmentController */
/* @var $model Department */
?>

<?php
$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->name=>array('view','id'=>$model->dept_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Department', 'url'=>array('index')),
	array('label'=>'Create Department', 'url'=>array('create')),
	array('label'=>'View Department', 'url'=>array('view', 'id'=>$model->dept_id)),
	array('label'=>'Manage Department', 'url'=>array('admin')),
);
?>

    <h1>Update Department <?php echo $model->dept_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>