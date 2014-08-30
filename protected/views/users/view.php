<?php
/* @var $this UsersController */
/* @var $model Users */
?>


<style type="text/css">

	img{
	    width:25em;
	    height:30em;}

</style>



<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->uid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'uid',
		'name',
		'password',
		'email',
		//'status',
		array('name'=>'Status','value'=>$model->getStatus()),
		//'picture',
		'mobile',
		'quota',
		'DateCreated',
		'LastUpdate',
		'orgId',
		array(
                'name'=>'Picture',
				'type'=>'raw',
                'value'=>html_entity_decode(CHtml::image($this->createUrl('Users/DisplaySavedImage', array('id'=>$model->uid))
																				,'alt'
					)),
                ),
	),
)); ?>


