<?php
/* @var $this Ou_structureController */
/* @var $model Ou_structure */
?>

<?php
$this->breadcrumbs=array(
	'Ou Structures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ou_structure', 'url'=>array('index')),
	array('label'=>'Manage Ou_structure', 'url'=>array('admin')),
);
?>

<h1>Create Ou_structure</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>