<div style="height:600px;">
<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->widget('ext.pdfJs.QPdfJs',array(
	'url'=>'/final/files/yii.pdf',
	))
?>
</div>