Tagcloud accepts either an array, or an array of objects

ex1.
<?php
--view--
$tags= array('tag1','tag2');
  $this->widget('application.extensions.cumulus.Tagcloud.php', 
 		array(
 		 'tags' =>$tags,    
		));
?>
will display the tagcloud with just 2 tags.

ex2. 
<?php
--view--
$tags= Tag::model()->findall();
  $this->widget('application.extensions.cumulus.Tagcloud.php', 
 		array(
 		 'tags' =>$tags,    
		));
?>
will display all the tags in $tags array.
