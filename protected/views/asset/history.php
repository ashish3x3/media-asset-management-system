<h2>ASSET HISTORY<?php echo $model->file;?></h2>

<?php

	$dataProvider = new CActiveDataProvider('AssetRevision',array(
	  'criteria'=>array('condition'=>'assetId=:assetId',
						'params'=>array(':assetId'=>$model->assetId)),
	  'sort'=>array(
                        'defaultOrder'=>'revision DESC',
                    ),
	
	));
?>

<h2><?php $model->file?></h2>


<script type="text/javascript">
    function updateUsersBlocks(grid_id) {
 
        var keyId = $.fn.yiiGridView.getSelection(grid_id);
        keyId  = keyId[0]; //above function returns an array with single item, so get the value of the first item
 
        $.ajax({
            url: '<?php echo $this->createUrl('VersionViewUpdate'); ?>',
            data: {id: keyId},
            type: 'GET',
            success: function(data) {
                $('#version_details').html(data);
            }
        });
    }
</script>



<?php
	//$modifiedBy = "1";


	$this->widget('zii.widgets.grid.CGridView',array(
	'dataProvider'=>$dataProvider,
	'selectionChanged' => 'updateUsersBlocks',
	'selectableRows' => 1, 
	'columns'=>array(
 	 'revision',
	 'modifiedOn',
	//'modifiedBy',
	 array('name'=>'modified by','value'=>'$data->users->name'),
	 'note',
 	 array('name'=>'view','type'=>'raw','value'=>'CHtml::link("view",array("/asset/"))'),
 	),
 
	));
?>


<div id='version_details'>
//your php-html code
</div>
