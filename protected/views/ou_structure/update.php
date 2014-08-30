<?php
/* @var $this Ou_structureController */
/* @var $model Ou_structure */
?>

<?php
$this->breadcrumbs=array(
	'Ou Structures'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ou_structure', 'url'=>array('index')),
	array('label'=>'Create Ou_structure', 'url'=>array('create')),
	array('label'=>'View Ou_structure', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ou_structure', 'url'=>array('admin')),
);
?>

    <h1>Update Ou_structure <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>