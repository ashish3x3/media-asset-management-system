<?php

error_reporting(E_ALL ^ ~E_NOTICE ^ ~E_WARNING);
class SearchController extends Controller
{
    public $keyword;
    
    public $data;
  /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    public  $_indexFiles = '\runtime\search';
 
    /**
     * (non-PHPdoc)
     * @see CController::init()
     */
    public function init(){
        Yii::import('application.vendor.*');
        require_once('Zend/Search/Lucene.php');
        parent::init(); 
    }
    public function actionIndex()
    {
    	$this->render('index');
    }
    
   
    	public function actionCreate()
    	{
    		$_indexFiles = '\runtime\search';
    		
    		//$index = Zend_Search_Lucene::create('/data/my-index');
    		
    		 $index = Zend_Search_Lucene::create($_indexFiles);
    		 
    		 
    		//$index = new Zend_Search_Lucene($this->_indexFile, true);
    		  
    		$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    		$index = new Zend_Search_Lucene($this->_indexFiles,true);

    		
    		
    		//CODE  TO GET THE EXTENTION OF FILE
    		/*
    		if(($pos=strrpos($post->file,'.'))!==false)
    			$ext=substr($post->file,$pos+1);
    			
    			*/
    		
    		//CODE TO CONVERT DOC INTO DOCX
    		  /*
    		require_once '../PHPWord.php';
    		
    		$PHPWord = new PHPWord();
    		
    		$document = $PHPWord->loadTemplate('C:\xampp\htdocs\final\upload\\'.$post->file);
    		
    		// Save File
    		
    		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    		$file=basename('C:\xampp\htdocs\final\upload\\'.$post->file, ".doc");
    		$objWriter->save('$file.docx');
    		
    		$data=read_file_docx('C:\xampp\htdocs\final\upload\\'.$post->file);
    		 
    		 */
    		  function read_doc($filename)	{
		$fileHandle = fopen($filename, "r");
		$line = @fread($fileHandle, filesize($filename));   
		$lines = explode(chr(0x0D),$line);
		$outtext = "";
		foreach($lines as $thisline)
		  {
			$pos = strpos($thisline, chr(0x00));
			if (($pos !== FALSE)||(strlen($thisline)==0))
			  {
			  } else {
				$outtext .= $thisline." ";
			  }
		  }
		 $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-				\n\r\t@\/\_\(\)]/","",$outtext);
		return $outtext;
	}
    	function odt_to_text($input_file){
        $xml_filename = "content.xml"; //content file name
        $zip_handle = new ZipArchive;
        $output_text = "";
        if(true === $zip_handle->open($input_file)){
                if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
                        $xml_datas = $zip_handle->getFromIndex($xml_index);
                     //   $var = new DOMDocument;
                        $xml_handle = @DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                        $output_text = strip_tags($xml_handle->saveXML());
                }else{
                        $output_text .="";
                }
                $zip_handle->close();
        }else{
        $output_text .="";
        }
        return $output_text;
}
	
    		
         // METHOD TO EXTRACT FROM DOCX FILE	
    		function read_file_docx($filename)
    		{
    			$striped_content = '';
    			$content = '';
    			if(!$filename || !file_exists($filename)) return false;
    			$zip = zip_open($filename);
    			if (!$zip || is_numeric($zip)) return false;
    			while ($zip_entry = zip_read($zip)) {
    				if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
    				if (zip_entry_name($zip_entry) != "word/document.xml") continue;
    				$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
    				zip_entry_close($zip_entry);
    			}
    			zip_close($zip);
    			$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    			$content = str_replace('</w:r></w:p>', "\r\n", $content);
    			$striped_content = strip_tags($content);
    		
    			return $striped_content;
    		}
    		
    		// METHOD TO EXTRACT FROM PPT FILE
    		 
    		 function pptx_to_text($input_file){
    		$zip_handle = new ZipArchive;
    		$output_text = "";
    		if(true === $zip_handle->open($input_file)){
    		$slide_number = 1; //loop through slide files
    		while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
    		$xml_datas = $zip_handle->getFromIndex($xml_index);
    		$xml_handle =@DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
    		$output_text .= strip_tags($xml_handle->saveXML());
    		$slide_number++;
    		}
    		if($slide_number == 1){
    		$output_text .="";
    		}
    		$zip_handle->close();
    		}else{
    		$output_text .="";
    		}
    		return $output_text;
    		}
				    		 
				    		function parsePPT($filename) {
				    // This approach uses detection of the string
				
				    $fileHandle = fopen($filename, "r");
				    $line = @fread($fileHandle, filesize($filename));
				    $lines = explode(chr(0x0f),$line);
				    $outtext = '';
				
				    foreach($lines as $thisline) {
				        if (strpos($thisline, chr(0x00).chr(0x00).chr(0x00)) == 1) {
				            $text_line = substr($thisline, 4);
				            $end_pos   = strpos($text_line, chr(0x00));
				            $text_line = substr($text_line, 0, $end_pos);
				            $text_line =
				preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$text_line);
				            if (strlen($text_line) > 1) {
				                $outtext.= substr($text_line, 0, $end_pos)."\n";
				            }
				        }
				    }
				    return $outtext;
				    		}
    		//METHOD TO EXTRACT FROM EXCEL FILE
    		function xlsx_to_text($input_file){
    			$xml_filename = "xl/sharedStrings.xml"; //content file name
    			$zip_handle = new ZipArchive;
    			$output_text = "";
    			if(true === $zip_handle->open($input_file)){
    				if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
    					$xml_datas = $zip_handle->getFromIndex($xml_index);
    					$xml_handle = @DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
    					$output_text = strip_tags($xml_handle->saveXML());
    				}else{
    					$output_text .="";
    				}
    				$zip_handle->close();
    			}else{
    				$output_text .="";
    			}
    			return $output_text;
    		}
    	// FOR EACH LOOP TO GET THE DATA
    		//$index->addDocument($doc);
    		
    		
    		$posts = Asset::model()->findAll();
    	foreach($posts as $post){
    		 
    		  
    		 

    		 
    		if(($pos=strrpos($post->file,'.'))!==false)
    			$ext=substr($post->file,$pos+1);
    		 
    		
   if ($ext==='docx')
    {
    		
    		  $a = $post->categoryId;
    		  $b = Yii::app()->user->getId();
    	   
    	$doc = Zend_Search_Lucene_Document_Docx::loadDocxFile(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	  $data=read_file_docx(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 $doc->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    	);
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('name',
    	 		CHtml::encode($post->assetId), 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('title',
    	 		CHtml::encode($post->file)
    	 		, 'utf-8')
    	 );
    	 $doc->addField(Zend_Search_Lucene_Field::Text('content',
    	 		CHtml::encode($data)
    	 		, 'utf-8')
    	 );
    	 
    	 $index->addDocument($doc);
    	 
       }  
    	 elseif($ext=='pptx')
    	 
    	 {
     		  $a = $post->categoryId;
    		  $b = Yii::app()->user->getId();
     
    	$doc1 = Zend_Search_Lucene_Document_Pptx::loadPptxFile(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	$data=pptx_to_text(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	$doc1->addField(Zend_Search_Lucene_Field::Text('title',
    			CHtml::encode($post->file)
    			, 'utf-8')
    	);
    	$doc1->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($data)
    			, 'utf-8')
    	);
    	
    	$doc1->addField(Zend_Search_Lucene_Field::Text('name',
    			CHtml::encode($post->assetId), 'utf-8')
    	);
    	
    	$doc1->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    	);
    	
    	  $index->addDocument($doc1);
    	 }
    	 elseif($ext=='xlsx')
    	 {
    	 	
    	    $a = $post->categoryId;
    		  $b = Yii::app()->user->getId();
    	 
    	    
       
    	$doc3 = Zend_Search_Lucene_Document_Xlsx::loadXlsxFile(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	$data=xlsx_to_text(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	
    	 
    	$doc3->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    	);
    	
    	$doc3->addField(Zend_Search_Lucene_Field::Text('name',
    			CHtml::encode($post->assetId), 'utf-8')
    	);
    	 
    	$doc3->addField(Zend_Search_Lucene_Field::Text('title',
    			CHtml::encode($post->file)
    			, 'utf-8')
    	);
    	$doc3->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($data)
    			, 'utf-8')
    	);
    	
    	 $index->addDocument($doc3);
    	    
    	 }

    	 else if ($ext == 'doc'){
    	 	
    	 	$doc = new Zend_Search_Lucene_Document();
    	 	$data = read_doc(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 	 $doc->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    		);
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('name',
    	 		CHtml::encode($post->assetId), 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('title',
    	 		CHtml::encode($post->file)
    	 		, 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($data)
    			, 'utf-8')
    	);
     
    	 $index->addDocument($doc);
    	 		
    	 
      }else if ($ext == 'odt'){
    	 	
    	 	$doc = new Zend_Search_Lucene_Document();
    	 	$data = odt_to_text(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 	 $doc->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    		);
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('name',
    	 		CHtml::encode($post->assetId), 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('title',
    	 		CHtml::encode($post->file)
    	 		, 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($data)
    			, 'utf-8')
    	);
     
    	 $index->addDocument($doc);
    	 		
    	 
      }  else if ($ext == 'pdf'){
    	 	
    	 //	include( Yii::getPathOfAlias('extensions').'pdf2text.php' );
    	// 	require_once(Yii::app()->basePath . '/extensions/pdf2text.php');
    	 	//$a = new PDF2Text();
    	 //	print_r(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 	//die();
		//	$a->setFilename(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file); //grab the test file at http://www.newyorklivearts.org/Videographer_RFP.pdf
			//$a->decodePDF();
			//$content = $a->output(); 
			
			//print_r($content);
			//die();
      		$doc = new Zend_Search_Lucene_Document();
    	 	$data = odt_to_text(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 	 $doc->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    		);
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('name',
    	 		CHtml::encode($post->assetId), 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('title',
    	 		CHtml::encode($post->file)
    	 		, 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($data)
    			, 'utf-8')
    	);
     
    	 $index->addDocument($doc);
    	 		
    	 
      }   else if ($ext == 'ppt'){
    	 
      		$doc = new Zend_Search_Lucene_Document();
    	 	$data = parseppt(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 	 $doc->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    		);
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('name',
    	 		CHtml::encode($post->assetId), 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('title',
    	 		CHtml::encode($post->file)
    	 		, 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($data)
    			, 'utf-8')
    	);
     
    	 $index->addDocument($doc);
    	 		
    	 
      }  
      else {
      	$doc = new Zend_Search_Lucene_Document();
    	 	//$data = read_doc(Yii::app()->basePath.'\..\upload\\'.$b.'\\'.$a.'\\'.$post->file);
    	 	 $doc->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    		);
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('name',
    	 		CHtml::encode($post->assetId), 'utf-8')
    	 );
    	 
    	 $doc->addField(Zend_Search_Lucene_Field::Text('title',
    	 		CHtml::encode($post->file)
    	 		, 'utf-8')
    	 );
     
    	 $index->addDocument($doc);
      }
    	
      
    		
    }
    
    
    
    	 $posts = Tags::model()->findAll();
     
    foreach($posts as $post){
    	 
    	$doc5 = new Zend_Search_Lucene_Document();
    	 
    	$doc5->addField(Zend_Search_Lucene_Field::Text('title',
    			CHtml::encode($post->tagName), 'utf-8')
    	);
    
    	$doc5->addField(Zend_Search_Lucene_Field::Text('name',
    			CHtml::encode($post->tagId), 'utf-8')
    	);
    	 
    	$doc5->addField(Zend_Search_Lucene_Field::Text('link',
    			CHtml::encode($post->url)
    			, 'utf-8')
    	);
    	 
    	$doc5->addField(Zend_Search_Lucene_Field::Text('content',
    			CHtml::encode($post->orgId)
    			, 'utf-8')
    	);
    	 
    	 
    	$index->addDocument($doc5);
    }
    
    	   
    	 
    	 
    		
    	     
    	    //return $data;
    		 $index->commit();
    		 echo 'Lucene index created';
    		
    	 	 
    		
    	}
    
    public function actionSearch()
    {
    	$this->layout='column2';
    	 
    	 
    	 $_indexFiles = '\runtime\search';
   
    	$index = Zend_Search_Lucene::create($_indexFiles);
    	
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
        $this->layout='column2';
    	 	
    	if ((($term = Yii::app()->getRequest()->getParam('q', null)) !== null)) {
    		
    		  $keyword=$term;
    	   $this->actionCreate();

    	   $index = Zend_Search_Lucene::open($_indexFiles);
    		
    		$results = $index->find($term);
    		$query = Zend_Search_Lucene_Search_QueryParser::parse($term,'utf-8');
    	
    		$this->render('search',compact('results', 'term', 'query'));
    	}
    	  
    	
    }
    
    public function actionSearch1()
    {
    	
    	$flag=1;
    	$this->layout='column2';
    
    
    	$_indexFiles = '\runtime\search';
    	 
    	 
    
    	$index = Zend_Search_Lucene::create($_indexFiles);
    
    
    	 
    	 
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
    	$this->layout='column2';
    	 
    	if ((($term = Yii::app()->getRequest()->getParam('param', null)) !== null)) {
    
    		  
    		$this->actionCreate1();
    
    		$index = Zend_Search_Lucene::open($_indexFiles);
    
    		$results = $index->find($term);
    		$query = Zend_Search_Lucene_Search_QueryParser::parse($term,'utf-8');
    		 
    		$this->render('search',compact('results', 'term', 'query','flag'));
    	}
    	 
    	 
    }
    
    public function actionCreate1()
    {
    	$_indexFiles = '\runtime\search';
    
    	 
    
    	$index = Zend_Search_Lucene::create($_indexFiles);
    	 
    	 
    	//$index = new Zend_Search_Lucene($this->_indexFile, true);
    
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
    
    	$posts = Asset::model()->findAll();
    
    	 
    		 
    	foreach($posts as $post){
    		
    		  
    		 
    		if(($pos=strrpos($post->file,'.'))!==false)
    			$ext=substr($post->file,$pos+1);
    		 
    		if ($ext==='jpg'|| $ext==='gif'|| $ext==='png')
    		{
    			$doc = new Zend_Search_Lucene_Document();
    			
    			$doc->addField(Zend_Search_Lucene_Field::Text('name',
    					CHtml::encode($post->assetId), 'utf-8')
    			);
    			
    			$doc->addField(Zend_Search_Lucene_Field::Text('title',
    					CHtml::encode($post->file), 'utf-8')
    			);
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('link',
    					CHtml::encode($post->url)
    					, 'utf-8')
    			);
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('content',
    					CHtml::encode($post->categoryId)
    					, 'utf-8')
    			);
    
    
    			$index->addDocument($doc);
    		} 
    
    	}
    
    	
    	//return $data;
    	$index->commit();
    	echo 'Lucene index created';
    
    
    
    }
     
    
     
    public function actionSearch2()
    {
    	 
    	$flag=2;
    	$this->layout='column2';
    
    
    	$_indexFiles = '\runtime\search';
    
    
    
    	$index = Zend_Search_Lucene::create($_indexFiles);
    
    
    
    
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
    	$this->layout='column2';
    
    	if ((($term = Yii::app()->getRequest()->getParam('param', null)) !== null)) {
    
    		 
    		$this->actionCreate2();
    
    		$index = Zend_Search_Lucene::open($_indexFiles);
    
    		$results = $index->find($term);
    		$query = Zend_Search_Lucene_Search_QueryParser::parse($term,'utf-8');
    		 
    		$this->render('search',compact('results', 'term', 'query','flag'));
    	}
    
    
    }
    
    public function actionCreate2()
    {
    	$_indexFiles = '\runtime\search';
    
    
    
    	$index = Zend_Search_Lucene::create($_indexFiles);
    
    
    	//$index = new Zend_Search_Lucene($this->_indexFile, true);
    
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
    
    	$posts = Asset::model()->findAll();
    
    	
    	 
    	foreach($posts as $post){
    		
    		if(($pos=strrpos($post->file,'.'))!==false)
    			$ext=substr($post->file,$pos+1);
    		
    		 
    		if ($ext=='mp4'|| $ext=='3gp'|| $ext=='avi')
    		{
    			$doc = new Zend_Search_Lucene_Document();
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('title',
    					CHtml::encode($post->file), 'utf-8')
    			);
    			
    			$doc->addField(Zend_Search_Lucene_Field::Text('name',
    					CHtml::encode($post->assetId), 'utf-8')
    			);
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('link',
    					CHtml::encode($post->url)
    					, 'utf-8')
    			);
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('content',
    					CHtml::encode($post->file)
    					, 'utf-8')
    			);
    
    
    			$index->addDocument($doc);
    		}
    
    	}
    
    
    
    	//return $data;
    	$index->commit();
    	echo 'Lucene index created';
    
    
    
    }
     
    
    public function actionSearch3()
    {
    	 
    	$flag=3;
    	$this->layout='column2';
    
    
    	$_indexFiles = '\runtime\search';
    
    
    
    	$index = Zend_Search_Lucene::create($_indexFiles);
    
    
    
    
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
    	$this->layout='column2';
    
    	if ((($term = Yii::app()->getRequest()->getParam('param', null)) !== null)) {
    
    		echo "****";
    		echo $term;
    		$this->actionCreate3();
    
    		$index = Zend_Search_Lucene::open($_indexFiles);
    
    		$results = $index->find($term);
    		$query = Zend_Search_Lucene_Search_QueryParser::parse($term,'utf-8');
    		 
    		$this->render('search',compact('results', 'term', 'query','flag'));
    	}
    
    
    }
    
    public function actionCreate3()
    {
    	$_indexFiles = '\runtime\search';
    
    
    
    	$index = Zend_Search_Lucene::create($_indexFiles);
    
    
    	//$index = new Zend_Search_Lucene($this->_indexFile, true);
    
    	$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	$index = new Zend_Search_Lucene($this->_indexFiles,true);
    
    	$posts = Asset::model()->findAll();
    
    
    	 
    	foreach($posts as $post){
    		

    		if(($pos=strrpos($post->file,'.'))!==false)
    			$ext=substr($post->file,$pos+1);
    		 
    		if ($ext==='mp3')
    		{
    			$doc = new Zend_Search_Lucene_Document();
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('title',
    					CHtml::encode($post->file), 'utf-8')
    			);
    			
    			$doc->addField(Zend_Search_Lucene_Field::Text('name',
    					CHtml::encode($post->assetId), 'utf-8')
    			);
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('link',
    					CHtml::encode($post->url)
    					, 'utf-8')
    			);
    
    			$doc->addField(Zend_Search_Lucene_Field::Text('content',
    					CHtml::encode($post->file)
    					, 'utf-8')
    			);
    
    
    			$index->addDocument($doc);
    		}
    
    	}
    
    
    
    	//return $data;
    	$index->commit();
    	echo 'Lucene index created';
    
    
    
    }
     
    /*
    public function actionDownload($id){
    
    	$models  = Asset::model()->findAll();
    
    	//print_r(	Yii::app()->user->getId());die();
    	
    	foreach ($models as $model){
    	
    		if($model->assetId==$id)
    		{
				    	if (isset($_SERVER['HTTP_RANGE']))
				    		$range = $_SERVER['HTTP_RANGE'];
				    	$dir_path = Yii::getPathOfAlias('webroot') .'/upload/'.Yii::app()->user->getId().'/'.$model->categoryId.'/';
				    
				    	$filePath=$dir_path.$id.'.dat';
				    	if (file_exists($filePath))
				    	{
				    		return $model->file;
				    		// send headers to browser to initiate file download
				    		//header ('Content-Type: application/octet-stream');
				    		// header ('Content-Disposition: attachment; filename="' . $model->file . '"');
				    		//header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				    		//header('Pragma: public');
				    		//readfile($filePath);
				    		
				    	}
				    	else
				    	{
				    		echo 'File does not exist...';
				    	}
				    	
    		}	    	
    	}		
    	
	 }
		*/		     
    
    
  }
  

 ?>