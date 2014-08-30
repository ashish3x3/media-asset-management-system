<?php
/* @var $this TagsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tags',
);

$this->menu=array(
	array('label'=>'Create Tags','url'=>array('create')),
	array('label'=>'Manage Tags','url'=>array('admin')),
);
?>

<h1>Tags</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>