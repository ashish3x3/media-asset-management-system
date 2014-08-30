<?php
/* @var $this AssetController */
/* @var $model Asset */
?>

<?php
$this->breadcrumbs=array(
	'Assets'=>array('index'),
	$model->assetId=>array('view','id'=>$model->assetId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Asset', 'url'=>array('index')),
	array('label'=>'Create Asset', 'url'=>array('create')),
	array('label'=>'View Asset', 'url'=>array('view', 'id'=>$model->assetId)),
	array('label'=>'Manage Asset', 'url'=>array('admin')),
);
?>

    <h1>Update Asset <?php echo $model->assetId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>