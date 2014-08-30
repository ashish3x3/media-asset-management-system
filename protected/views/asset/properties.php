<h2>
<?php echo $model->file;?>
</h2>

<?php
	$properties =$this->widget('zii.widgets.CDetailView',array(
    		'htmlOptions' => array(
        		'class' => 'table table-striped table-condensed table-hover',
  			  ),
    		'data'=>$model,
    		'attributes'=>array(
				'assetId',
  			    'assetName',
  			    'file',
  			  	array('name'=>'Owner Name','value'=>$model->users->name),
    			array('name'=>'Category Name','value'=>$model->category->name),
				'createDate',
				'comment',
				array('name'=>'Status','value'=>$model->getStatus()),
				array('name'=>'Publication','value'=>$model->getPublication()),
				array('name'=>'Online Editable','value'=>$model->getOnlineEditable()),
				'size',
				'type',
				
	),
),true) ;
?>

<?php 

 $accesslog = new CActiveDataProvider('Fileaccesslog',array('criteria'=>array(
                        'condition'=>'assetId=:assetId',
                        'params'=>array(':assetId'=>$model->assetId,),
    
                    ),
					 )) ;

 $accessLogView = $this->widget('bootstrap.widgets.TbGridView',array(
	'dataProvider'=>$accesslog,
	'columns'=>array(
 	 //'assetId',
 	 //'uId',
 	 //add the version also
 	 array('name'=>'filename','value'=>'$data->asset->file'),
 	 array('name'=>'Username','value'=>'$data->users->name'),
 	 array('name'=>'act','value'=>'$data->getAction()')
 	),
 
),true);

?>


<?php echo TbHtml::tabbableTabs(array(

    array('label' => 'Properties', 'active' => true, 'content' =>$properties),
    
    
    array('label' => 'Notes', 'content' => TbHtml::textArea('Notes','',array('label'=>'Notes:','span'=>6,'rows'=>4))),
    
    
    array('label' => 'AccessLog', 'content' => $accessLogView),
    
    
    array('label' => 'Description', 'content' =>$model->description),
    
    
    array('label' => 'Tags', 'content' => $model->getTags() ),
    
    
    array('label' => 'Email', 'content' => 'EMAIL UNDER CONSTRUCTION'),
    
), array('placement' => TbHtml::TABS_PLACEMENT_LEFT)); ?>

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
<?php  echo CHtml::link(
    'Download',
     Yii::app()->createUrl('Asset/Download' , array('id' => $model->assetId)),
     array('class'=>'btnPrint btn btn-primary','target'=>'_blank'));

?>

</div>
