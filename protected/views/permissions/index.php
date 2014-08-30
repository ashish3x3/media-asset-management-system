<?php
/* @var $this PermissionsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Permissions',
);

$this->menu=array(
	array('label'=>'Create Permissions','url'=>array('create')),
	array('label'=>'Manage Permissions','url'=>array('admin')),
);
?>

<h1>Permissions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>