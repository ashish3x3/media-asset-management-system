<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>


<style type="text/css">

	.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, 
	.nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus{
	background-color:#fff;}

	.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, 
	.nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus
	{
		color:#000 !important;
	}
	
	#page{
	margin-top:3em;
	border:none;}
	
	
</style>

<?php echo TbHtml::tabs(array(
    array('label' => 'Add Asset', 'url' => '#'),
    array('label' => 'Check In', 'url' => '#'),
    array('label' => 'Check Out', 'url' => '#'),
    array('label' => 'Admin', 'items' => array(
        array('label' => 'Add OU', 'url' => '#'),
        array('label' => 'Manage OU', 'url' => '#'),
        array('label' => 'Add tags', 'url' => '#'),
        array('label' => 'Add category', 'url' => '#'),
        array('label' => 'users', 'items'=>array(array('label'=>'Add user','url'=>'#'),array('label'=>'manage user','url'=>'#'))),
        array('label' => 'Role', 'items'=>array(array('label'=>'Add module','url'=>'#'),array('label'=>'Add permission','url'=>'#'))),
        
        
    )),
)); ?>


