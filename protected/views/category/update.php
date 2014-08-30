<?php
/* @var $this Category1Controller */
/* @var $model Category1 */
?>

<?php

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->cat_id)),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

    <h1>Update Category1 <?php echo $model->cat_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>