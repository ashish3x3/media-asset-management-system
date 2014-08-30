<?php
/* @var $this TagsController */
/* @var $model Tags */
?>

<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->tagId=>array('view','id'=>$model->tagId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tags', 'url'=>array('index')),
	array('label'=>'Create Tags', 'url'=>array('create')),
	array('label'=>'View Tags', 'url'=>array('view', 'id'=>$model->tagId)),
	array('label'=>'Manage Tags', 'url'=>array('admin')),
);
?>

    <h1>Update Tags <?php echo $model->tagId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>