<?php
/* @var $this ModuleController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Modules',
);

$this->menu=array(
	array('label'=>'Create Module','url'=>array('create')),
	array('label'=>'Manage Module','url'=>array('admin')),
);
?>

<h1>Modules</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'dataProvider'=>$dataProvider,
	/*'itemView'=>'_view',*/
    'columns'=>array('mid','name','description'),
)); ?>