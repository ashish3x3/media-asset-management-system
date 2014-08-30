
<?php
$this->pageTitle=Yii::app()->name . ' - Search results';
$this->breadcrumbs=array(
		'Search Results',
);
?>
 
<h3>Search Results for: "<?php echo CHtml::encode($term); ?>"</h3>
<div>
 <?php 
  /*
 echo CHtml::link('DOCUMENT',array('search/search',
 		'q'=>$term
 		 ));
 echo  str_repeat('&nbsp;',5);
echo CHtml::link('IMAGES',array('search/search1',
		'param'=>$term
));
 echo  str_repeat('&nbsp;',5);
echo CHtml::link('VIDEO',array('search/search2',
		'param'=>$term
));
echo  str_repeat('&nbsp;',5);
echo CHtml::link('AUDIO',array('search/search3',
		'param'=>$term
));*/
echo TbHtml::tabs(array(
        //'display' => null, // default is static to top
      //  'color' => TbHtml::NAVBAR_COLOR_INVERSE,
       // 'collapse' => true,
       // 'items' => array(
        //	array(
        	//	'class' => 'bootstrap.widgets.TbNav',
        		//'items'=>array(
				array('label'=>'Documents', 'url'=>array('search/search', 'q'=>$term)),
				array('label'=>'Images', 'url'=>array('/search/search1', 'param'=>$term)),
				array('label'=>'Videos', 'url'=>array('/search/search2', 'param'=>$term)),
				array('label'=>'Audio', 'url'=>array('/search/search3', 'param'=>$term)),
			
        		
        		
        )); 
 
   
  ?>
  
</div> 
<br>
<br>

<?php if ($flag=='1'): ?>
           
              <h4>Image:</h4>
          <?php if (!empty($results)): ?>
                <?php foreach($results as $result): 
                ?>  
           
                   
                    <?php
                    if(($pos=strrpos($result->title,'.'))!==false)
    			    $ext=substr($result->title,$pos+1);
                    ?>
                       <?php 
                       if($ext=='jpg' || $ext=='gif' || $ext=='png'):
                       ?>
    			         <p>Title: <?php echo $query->highlightMatches(CHtml::encode($result->title)); ?></p>
                        <p>Link: <?php  //echo CHtml::link("View",array("asset/"."viewer"=>$result->name)); 
                        	echo CHtml::link("view", array("asset/","viewer"=>$result->name));
                        ?></p>
                          <?php 
                       $ext1=substr($result->content,0,200);
                      
                        ?>
                       <p>Content: <?php   echo $query->highlightMatches(CHtml::encode($ext1)); ?></p> 
                      
                <?php        
                      $orgId = Yii::app()->user->getId();
					  $categoryId = $result->content;
					 // $file = $result->file;
					  $a = "http://localhost/final/upload/".$orgId.'/'.$categoryId.'/'.$result->title; 
					  //print_r($a);
					  //die();
					  ?>
                       <img id = "image" src = "<?php echo $a;?>" height=100 width = 100 alt=""> 
                       <?php endif; ?>
                    <hr/>
                <?php endforeach; ?>
 
            <?php else: ?>
                <p class="error">No results matched your search terms.</p>
            <?php endif; ?>
    
 <?php elseif ($flag=='3'):  ?>   
  <h4>AUDIO:</h4>
          <?php if (!empty($results)): ?>
                <?php foreach($results as $result): 
                ?>  
           
                   
                    <?php
                    if(($pos=strrpos($result->title,'.'))!==false)
    			    $ext=substr($result->title,$pos+1);
                    ?>
                       <?php 
                       if($ext==='mp3'):
                       ?>
    			         <p>Title: <?php echo $query->highlightMatches(CHtml::encode($result->title)); ?></p>
                        <p>Link: <?php // echo CHtml::link($query->highlightMatches(CHtml::encode($result->link)),array('asset/'.$result->name)); 
                       	echo CHtml::link("view", array("asset/","viewer"=>$result->name));
                       ?></p>
                          <?php 
                       $ext1=substr($result->content,0,200);
                        ?>
                       <p>Content: <?php   echo $query->highlightMatches(CHtml::encode($ext1)); ?></p> 
                       <?php endif; ?>
                    <hr/>
                <?php endforeach; ?>
 
            <?php else: ?>
                <p class="error">No results matched your search terms.</p>
            <?php endif; ?>
    
 
 
 
 <?php elseif  ($flag=='2'):  ?> 
      <h4>VIDEO:</h4>
          <?php if (!empty($results)): ?>
                <?php foreach($results as $result): 
                ?>  
           
                   
                    <?php
                    if(($pos=strrpos($result->title,'.'))!==false)
    			    $ext=substr($result->title,$pos+1);
                    ?>
                       <?php 
                       if($ext==='mp4'||$ext==='3gp'||$ext==='avi'):
                       ?>
    			         <p>Title: <?php echo $query->highlightMatches(CHtml::encode($result->title)); ?></p>
                        <p>Link: <?php // echo CHtml::link($query->highlightMatches(CHtml::encode($result->link)),array('asset/'.$result->name));
							echo CHtml::link("view", array("asset/","viewer"=>$result->name));
                       ?></p>
                          <?php 
                       $ext1=substr($result->content,0,200);
                        ?>
                       <p>Content: <?php   echo $query->highlightMatches(CHtml::encode($ext1)); ?></p> 
                       <?php endif; ?>
                    <hr/>
                <?php endforeach; ?>
 
            <?php else: ?>
                <p class="error">No results matched your search terms.</p>
            <?php endif; ?>
    
  
    
  <?php else : ?>   
 
 <h4>DOCUMENT:</h4>
  <?php if (!empty($results)): ?>
                <?php foreach($results as $result): 
               // echo "hereee";
                ?>  
                    <?php
                    if(($pos=strrpos($result->title,'.'))!==false)
    			    $ext=substr($result->title,$pos+1);
                    ?>
                       <?php
                       if($ext=='xlsx' || $ext=='docx' || $ext=='pptx' || $ext == 'doc' || $ext == 'odt'
                       || $ext == 'ppt'):
                       ?>
    			         <p>Title: <?php echo $query->highlightMatches(CHtml::encode($result->title)); ?></p>
                        <p>Link: <?php // echo CHtml::link($query->highlightMatches(CHtml::encode($result->link)),array('asset/'.$result->name)); 
                       echo CHtml::link("view", array("asset/","viewer"=>$result->name));
                       ?></p>
                          <?php 
                       $ext1=substr($result->content,0,200);
                        ?>
                       <p>Content: <?php   echo $query->highlightMatches(CHtml::encode($ext1)); ?></p>
                       
                        <?php elseif ($ext == 'pdf' || $ext == 'odp'): ?>
                        <p>Title:  <?php echo $query->highlightMatches(CHtml::encode($result->title));?></p>
                           <p>Link: <?php  echo CHtml::link("view", array("asset/","viewer"=>$result->name)); ?></p>
                       
                        
                       <?php else: ?>
                       <?php 
                        $tagId = $result->name;
                      
                        $connection = Yii::app()->db;
                        $sql3 = "select assetId from asset_tags where tagId = :tagId";
					    $command = Yii::app()->db->createCommand($sql3);
			
					    $command->bindParam(":tagId",$tagId,PDO::PARAM_INT);
					    $dataReader = $command->query();
					    while (($model1 = $dataReader->read())!== false)
					    {
					    	$a = $model1['assetId'];
					    	$sql = "select file from asset where assetId = :assetId";
			    			$command = $connection->createCommand($sql);
			    			$command->bindParam(":assetId",$a,PDO::PARAM_INT);
			    			$dataReader2 = $command->query();
        					$row = $dataReader2->read();
        					$dataReader2->close();
        
        					$ans = $row['file'];
                       		?>
                           <p>Title: <?php echo $ans; ?></p>
                           <p>Link: <?php  echo CHtml::link("view", array("asset/","viewer"=>$a)); ?></p>
                           <p> <?php  // echo$query->highlightMatches(CHtml::encode($result->name)); ?></p> 
                           <?php  }?>
                        <?php endif; ?>
                    
                <?php endforeach; ?>
            
            <?php else: ?>
                <p class="error">No results matched your search terms.</p>
            <?php endif; ?>
             
   <?php endif; ?>   
             
 