<?php 
?>
<?php
 /*
 $b = "http://localhost/final/Viewer.js/#../".$a;
 
 
 $asset = Asset::model()->find('assetId=:assetId',array(':assetId'=>$a));
 $category = $asset->categoryId;
 //print_r($category);die();
 
 $a = $asset->file;
 
 $assetId = $asset->assetId;
 */
 
 $b = "http://localhost/final/Viewer.js/#../upload/".Yii::app()->user->getId()."/".$model->categoryId."/".$model->file;
 
 $orgId = Yii::app()->user->getId();
 $categoryId = $model->categoryId;
 $file = $model->file;
 ?> 
 
 
 
<?php  
 //echo $a;
?>
  <?php 
  $a = "http://localhost/final/upload/".$orgId.'/'.$categoryId.'/'.$file;
  
  if(($pos=strrpos($file,'.'))!==false)
  $ext=substr($file,$pos+1);
  ?>
  <?php 	
  if ($ext == 'jpg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp'): 
  ?>  <?php 
  $a = "http://localhost/final/upload/".$orgId.'/'.$categoryId.'/'.$file;
   
  
  ?>
  <img id = "image" src = "<?php echo $a;?>"> 
  
  <?php elseif ($ext == 'mp4' || $ext == 'flv' || $ext == 'ogg' || $ext == 'webm' || $ext == 'mp3' || $ext == 'wav'):
?>
   <?php 
  //$a = "http://localhost/final/upload/".$orgId.'/'.$categoryId.'/'.$file;
  
  ?><?php   
 
   $this->widget ( 'ext.mediaElement.MediaElementPortlet',
    array ( 
    'url' => $a,   
     'mimeType' =>'video/mp4',
    ));
    ?><?php 
   elseif ($ext == 'pdf' || $ext == 'odt' || $ext == 'odp'): ?>
  <iframe id="viewer" src = "<?php echo $b;?>"
  width='800' height='500' allowfullscreen webkitallowfullscreen></iframe>
  
  <?php else:?>
  
  <?php endif;?>
 
 
 
 
 
<?php /* 
if ($a == "odpp.odp") {?>	
    <iframe id="viewer" src = "http://localhost/final/Viewer.js/#../odpp.odp" 
    width='800' height='500' allowfullscreen webkitallowfullscreen></iframe>
<?php } else if ($a == "encryption.odt") {?>
     <iframe id="viewer" src = "http://localhost/final/Viewer.js/#../encryption.odt" 
    width='800' height='500' allowfullscreen webkitallowfullscreen></iframe>
<?php } else {?>
     <iframe id="viewer" src = "http://localhost/final/Viewer.js/#../ab.pdf" 
    width='800' height='500' allowfullscreen webkitallowfullscreen></iframe>
<?php }?>

<iframe src="https://apps.groupdocs.com/document-viewer/Embed/afc28a3349cb09d096288f9dc312144b7a853efa5c0e2a0ecf1b7927baddefa7?quality=50&use_pdf=False&download=False&print=False&signature=%2FjWgVjs2WWFYw5zcO5UfeqjIc1Q" frameborder="0" width="600" height="500"></iframe>
<?php */ ?>