<?php
/* @var $this OrganisationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Organisations',
);

$this->menu=array(
	
	array('label'=>'Manage Organisation', 'url'=>array('admin')),
	//array('label'=>'Add Department', 'url'=>array('adddept')),
);
?>

<h1>Organisations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
