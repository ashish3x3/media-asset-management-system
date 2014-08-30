<?php
/* @var $this Category1Controller */
/* @var $model Category1 */



$this->menu=array(
	array('label'=>'List Category1', 'url'=>array('index')),
	array('label'=>'Create Category1', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category1-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Category1s</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'category1-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Name',
		array('name'=>'orgName',
		      'value'=>'$data->organisation->orgName'),
		//'unitCode',
		array('name'=>'name',
		       
			 //to be changed according to many to many
		     //'value'=>'$data->ou_structure->name'
		     ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 

 
?>