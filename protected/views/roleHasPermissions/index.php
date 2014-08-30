<?php
/* @var $this RoleHasPermissionsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Role Has Permissions',
);

$this->menu=array(
	array('label'=>'Create RoleHasPermissions','url'=>array('create')),
	array('label'=>'Manage RoleHasPermissions','url'=>array('admin')),
);
?>

<h1>Role Has Permissions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>