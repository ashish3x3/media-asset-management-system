<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	
	<link rel="stylesheet" type="text/css" href="/extensions/bootstrap/assets/css/bootstrap.min.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<style type="text/css">
	
		.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, 
	.nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus{
	background-color:#fff;}

	.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, 
	.nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus
	{
		color:#000 !important;
	}
	@media (min-width: 1200px)
	{
	.container{
	 width :1100px;
	}
		
	};
	</style>
	
	
</head>


<body class="container" >

<?php Yii::app()->bootstrap->register(); ?>


<div class="container" id="page">

	<?php 
	$orgId = Yii::app()->user->getId();
	$record = Yii::app()->db->createCommand()
    ->select('orgName')
    ->from('organisation')    
    ->where('orgId=:orgId', array(':orgId'=>$orgId))
    ->queryRow();
	?>
	
	 
       <?php $this->widget('bootstrap.widgets.TbNavbar', array(
        'brandLabel' => 'MAM',
        //'display' => null, // default is static to top
        'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        'collapse' => true,
        'items' => array(
        	array(
        		'class' => 'bootstrap.widgets.TbNav',
        		'items'=>array(
				array('label'=>'Home', 'url'=>array('site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Register(organisation)', 'url'=>array('/organisation/register1'),'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Organisations','url'=>array('/organisation/index'),'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>$record['orgName'], 'url'=>array('site/index')),
			),
        		
        		),
        	),
        )); ?>

<div class="span3 pull-right" style="margin-top:3em;text-transform:uppercase;font-weight:900;font-size:2em;color:maroon;">
	<?php echo $record['orgName'];?>
</div>

	<br>
	<br>
	<?php
      	$this->widget('SearchBlock', array(
      	)); ?>
	

<?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php 
	endif*/
	?>
 
<div style="margin-top:5em;">
	<?php

	if(!Yii::app()->user->isGuest){
	$id =  Yii::app()->user->getId();
	echo TbHtml::tabs(array(
	
	
	
    array('label' => 'Add Asset', 'url' => '/final/asset/create'),
    //array('label' => 'Media Browser', 'url' => '/final/index.php/media'),
    array('label' => 'Viewer', 'url' => '/final/site/viewer'),
    array('label' => 'Check In', 'url' => array('/users/checkIn','id'=>Yii::app()->user->getState("uid"))),
    array('label' => 'Review', 'url' => array('/users/review','id'=>Yii::app()->user->getState("uid"))),
    array('label' => 'Check Out', 'url' => '/final/addasset/onlineeditor'),
    array('label' => 'Admin', 'items' => array(
        array('label' => 'Manage OU', 'url' => array('/ou_structure/tree')),
        array('label' => 'Add tags', 'url' => array('/tags/create')),
        array('label' => 'Add category', 'url' => array('/category/create')),
        array('label' => 'users', 'items'=>array(array('label'=>'Add user','url'=>array('/users/create')),array('label'=>'Manage user','url'=>array('/users/admin')))),
        array('label' => 'Role', 'items'=>array(array('label'=>'Add role','url'=>array('/role/index')))),
        array('label' => 'Module', 'items'=>array(array('label'=>'Add module','url'=>array('/module/create')))),
        array('label' => 'Permissions', 'items'=>array(array('label'=>'Add permission','url'=>array('/permissions/create')),array('label'=>'Manage permissions','url'=>array('/permissions/admin')))),
    )),
	)); 
	}
?>
</div>

<?php echo $content; ?>	    
</div><!-- page -->
</body>
</html>