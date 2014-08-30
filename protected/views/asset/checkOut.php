
<h1> Click to check out the selected document and begin downloading it to your local workstation</h1>

<?php
  echo CHtml::link(
    'Check Out',
     Yii::app()->createUrl('Asset/CheckOutAsset' , array('id' => $model->assetId)),
     array('class'=>'btnPrint btn btn-primary','target'=>'_blank'));
 ?>
 
 <p>Once the document has completed downloading, you may Continue</p>