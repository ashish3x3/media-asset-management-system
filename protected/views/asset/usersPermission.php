<br />
<hr >


<?php

	
  $dept_id=$model->id;
   
   	   $dataProvider = new CActiveDataProvider('Users', array(
                                'criteria'=>array(
                        'condition'=>'ouId=:ouId',
                        'params'=>array(':ouId'=>$dept_id),
    
                    ),
	
                                'pagination'=>array(
                                                'pageSize'=>15,
                                )));
			
			//$dataProvider = Ou_structure::model()->findAll('orgId=:orgId',array('orgId'=>$orgId));
			$this->widget('bootstrap.widgets.TbGridView', array(
				//'selectionChanged' => 'updateUsersTable',
				'selectableRows' => 2,
				'id'=>'Agview',
				'dataProvider'=>$dataProvider,
				'rowHtmlOptionsExpression' => 'array("uid"=>$data->uid)',
				'columns'=>array(
    			array('name'=>'name','header'=>'Users'),    /*in header give the role name while passing*/
	 			//array('header'=>'Read','value'=>'','id'=>'headerA'),
	    		array(
	    		    
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'Aread',
	        		'selectableRows'=>1,
	    			'header'=>'Read',
	    		
	    		),    	
	    		//array('header'=>'Write','value'=>'','id'=>'headerA'),
	    		array(
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'Awrite',
	        		'selectableRows'=>1,
	    			'header'=>'Write',
	    		),
	    		//array('header'=>'Edit','value'=>'','id'=>'headerA'),
	    		array(
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'Aedit',
	        		'header'=>'Edit',
	    			'selectableRows'=>1,
	    		),
	    		//array('header'=>'Delete','value'=>'','id'=>'headerA'),
	    		array(
	        		'class'=>'CCheckBoxColumn',
	        		'id'=>'Adelete',
	        		'selectableRows'=>1,
	    			'header'=>'Delete',
	    		)    	
	      ),
   		)
		);

 		
	?>
   
   
   

 
 