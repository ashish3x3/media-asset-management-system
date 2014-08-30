<?php
/* @var $this AssetRevisionController */
/* @var $model AssetRevision */
?>

<?php
$this->breadcrumbs=array(
	'Asset Revisions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AssetRevision', 'url'=>array('index')),
	array('label'=>'Create AssetRevision', 'url'=>array('create')),
	array('label'=>'View AssetRevision', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AssetRevision', 'url'=>array('admin')),
);
?>

    <h1>Update AssetRevision <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>