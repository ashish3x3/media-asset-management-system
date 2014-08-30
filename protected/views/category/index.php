<?php
/* @var $this Category1Controller */
/* @var $dataProvider CActiveDataProvider */
?>

<?php

$this->menu=array(
	array('label'=>'Create Category','url'=>array('create')),
	array('label'=>'Manage Category','url'=>array('admin')),
);
?>

<h1>Categories</h1>


<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>