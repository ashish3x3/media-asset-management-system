<?php
/* @var $this DocumentController */
/* @var $model Document */
?>

<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->Name=>array('view','id'=>$model->docId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Document', 'url'=>array('index')),
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'View Document', 'url'=>array('view', 'id'=>$model->docId)),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

    <h1>Update Document <?php echo $model->docId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>