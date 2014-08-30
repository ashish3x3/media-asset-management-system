<?php
/* @var $this AssetRevisionController */
/* @var $model AssetRevision */
?>

<?php
$this->breadcrumbs=array(
	'Asset Revisions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AssetRevision', 'url'=>array('index')),
	array('label'=>'Manage AssetRevision', 'url'=>array('admin')),
);
?>

<h1>Create AssetRevision</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>