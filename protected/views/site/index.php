<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<style type="text/css">
	#heading1{
	margin-top:1em;}
</style>

<!--<h1>Welcome to <i><?php /*echo CHtml::encode(Yii::app()->name);*/ ?></i></h1>-->




<h1 id="heading1">
 <center>MEDIA ASSET MANAGEMENT </center>
 </h1>
 
 <?php
//Yii::import('application.extensions.cumulus.Tagcloud'); 

/*$this->widget('CTagCloud', array(
    'maxTags'=>false,
    'urlRoute'=>'Tags/find'
)); 
*/



$tags= Tags::model()->findall();
 $this->widget('application.extensions.cumulus.Tagcloud.php', 
 		array(
 		'tags' =>$tags,    
		));
		
		//print_r($tags);
?>
 
 



<div class="span12" style="margin-top:4em;">
	
</div>


  
    

