<?php
/* @var $this RoleController */
/* @var $dataProvider CActiveDataProvider */
?>

<style type="text/css">

 .summary{
 display:none;}
 
  .table{
  margin-bottom:0px;}

</style>

<?php
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Create Role','url'=>array('index')),
	array('label'=>'Manage Role','url'=>array('admin')),
);
?>

<h1>Roles</h1>
<?php $this->renderPartial('roleform', array('model'=>$model)); ?>

