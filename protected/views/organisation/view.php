<?php
/* @var $this OrganisationController */
/* @var $model Organisation */

$this->breadcrumbs=array(
	'Organisations'=>array('index'),
	$model->orgId,
);

$this->menu=array(
	array('label'=>'List Organisation', 'url'=>array('index')),
	//array('label'=>'Create Organisation', 'url'=>array('create')),
	array('label'=>'Update Organisation', 'url'=>array('update', 'id'=>$model->orgId)),
	array('label'=>'Delete Organisation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orgId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Organisation', 'url'=>array('admin')),
);
?>

<h1>View Organisation #<?php echo $model->orgId; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		"orgName:text:Organisation Name",
		"noEmp:number:Number Of Employees",
		"phone:text:Phone",
		"email:email:Email id",
		"addr1:text:Address Street 1",
		"addr2:text:Address Street 2",
		"state:text:State",
		"country:text:Country",
		"orgType:text:Type of Organisation",
		"description:text:Description",
		"fax:number:Fax",
		"orgId:number:Organisation ID",
	),
)); ?>
