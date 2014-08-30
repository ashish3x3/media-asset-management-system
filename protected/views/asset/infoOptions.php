
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

<div class="" style="margin-left:7em;">
<?php  echo TbHtml::button('View', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
<?php  echo CHtml::link(
    'Check Out',
     Yii::app()->createUrl('Asset/CheckOut' , array('id' => $model->assetId)),
     array('class'=>'btnPrint btn btn-primary','target'=>'_blank'));
 ?>
<?php  echo TbHtml::button('History',array(
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
				'submit' => Yii::app()->baseUrl.'/asset/history/'.$model->assetId,
                //'confirm'=>"Please confirm to cancle transaction",
                'class'=>'submit'
                
            )); ?>

<?php  echo TbHtml::button('Manage', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
<?php  /*echo TbHtml::button('Download', array('color' => TbHtml::BUTTON_COLOR_PRIMARY,
		'submit' => Yii::app()->baseUrl.'/asset/download/'.$model->assetId,)); */

echo CHtml::link(
    'Download',
     Yii::app()->createUrl('Asset/Download' , array('id' => $model->assetId)),
     array('class'=>'btnPrint btn btn-primary','target'=>'_blank'));

?>

<?php 
echo CHtml::link(
    'Properties',
     Yii::app()->createUrl('Asset/properties' , array('id' => $model->assetId)),
     array('class'=>'btnPrint btn btn-primary','target'=>'_blank'));



?>

</div>
