<?php
/* @var $this TagsController */
/* @var $model Tags */
?>

<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->tagId,
);

$this->menu=array(
	array('label'=>'List Tags', 'url'=>array('index')),
	array('label'=>'Create Tags', 'url'=>array('create')),
	array('label'=>'Update Tags', 'url'=>array('update', 'id'=>$model->tagId)),
	array('label'=>'Delete Tags', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tagId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tags', 'url'=>array('admin')),
);
?>

<h1>View Tags #<?php echo $model->tagId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'tagId',
		'tagName',
		array(
		'name'=>'organisation name',
		'value'=>$model->organisation->orgName),
		array(
		'name'=>'department name',
		'value'=>$model->getDepartments()),
	),
)); ?>