	
	<style type="text/css">
	
		.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, 
	.nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus{
	background-color:#fff;}

	.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, 
	.nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus
	{
		color:#000 !important;
	}
	body{
	background-color: white !important;}
	.span12{
	margin-left:0em !important;}	
	
	
	</style>
	

	

<?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php 
	endif*/
	?>
 
<?php

$this->widget('application.widgets.JsTreeWidget',
             array('modelClassName' => 'Ou_structure',
                     'jstree_container_ID' => 'Ou_structure-wrapper',
                     'themes' => array('theme' => 'classic', 'dots' => true, 'icons' => false),
                     'plugins' => array('themes', 'html_data', 'contextmenu','search','crrm', 'dnd', 'cookies', 'ui'), 
             ));
?>

  
