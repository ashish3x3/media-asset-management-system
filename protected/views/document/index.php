<?php
/* @var $this DocumentController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Documents',
);

$this->menu=array(
	array('label'=>'Create Document','url'=>array('create')),
	array('label'=>'Manage Document','url'=>array('admin')),
);
?>

<h1>Documents</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>