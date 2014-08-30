<?php
/* @var $this AssetRevisionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Asset Revisions',
);

$this->menu=array(
	array('label'=>'Create AssetRevision','url'=>array('create')),
	array('label'=>'Manage AssetRevision','url'=>array('admin')),
);
?>

<h1>Asset Revisions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>