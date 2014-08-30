
<h2><?php echo $model->file; ?></h2>



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


<style type="text/css">
 .btn {margin-left:.2em;}

</style>

<div class="" style="margin-left:5em;">
<?php 
echo CHtml::link(
    'Authorize/Reject',
     Yii::app()->createUrl('Asset/AuthorizeOrReject' , array('id' => $model->assetId)),
     array('class'=>'btnPrint btn btn-primary'));



?>

</div>
