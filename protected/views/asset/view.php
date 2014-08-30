<?php
/* @var $this AssetController */
/* @var $model Asset */
?>

<?php
$this->breadcrumbs=array(
	'Assets'=>array('index'),
	$model->assetId,
);

$this->menu=array(
	array('label'=>'List Asset', 'url'=>array('index')),
	array('label'=>'Create Asset', 'url'=>array('create')),
	array('label'=>'Update Asset', 'url'=>array('update', 'id'=>$model->assetId)),
	array('label'=>'Delete Asset', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->assetId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Asset', 'url'=>array('admin')),
);


?>

<h1>View Asset #<?php echo $model->assetId; ?></h1>



<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'assetId',
		'assetName',
    	array('name'=>'Category Name','value'=>$model->category->name),
		'createDate',
		'description',
		'comment',
		//'status',
		array('name'=>'Status','value'=>$model->getStatus()),
		//'publication',
		array('name'=>'Publication','value'=>$model->getPublication()),
		//'onlineEditable',
		array('name'=>'Online Editable','value'=>$model->getOnlineEditable()),
		'size',
		'type',
		'reviewer',
		'reviewerComments',
		//'ownerId',
		array('name'=>'Owner Name','value'=>$model->users->name),
		
	),
)); ?>