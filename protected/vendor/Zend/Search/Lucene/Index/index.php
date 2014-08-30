   <?php // Create index
    $index = Zend_Search_Lucene::create('/data/my-index');
     
    $doc = new Zend_Search_Lucene_Document();
     
    // Store document URL to identify it in the search results
    $doc->addField(Zend_Search_Lucene_Field::Text('url', $docUrl));
     
    // Index document contents
    $doc->addField(Zend_Search_Lucene_Field::UnStored('contents', $docContent));
     
    // Add document to the index
    $index->addDocument($doc);
	?>