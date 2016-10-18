<?php

class SearchController extends Controller
{
	 /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';
    /**
     * (non-PHPdoc)
     * @see CController::init()
     */
    public function init()
    {
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');
        parent::init(); 
    }
 
    public function actionCreate()
    {	
		 $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
 
        $items = Items::model()->findAll();
        foreach($items as $item)
        {
        	
			$doc = new Zend_Search_Lucene_Document();
			
			Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive());
            
 
            $doc->addField(Zend_Search_Lucene_Field::keyword('part_number',
                                          CHtml::encode($item->part_number), 'utf-8')
            );
 
            $doc->addField(Zend_Search_Lucene_Field::Text('name',
                                            CHtml::encode($item->name)
                                                , 'utf-8')
            );   
         
            $doc->addField(Zend_Search_Lucene_Field::Text('description',
                                          CHtml::encode($item->description)
                                          , 'utf-8')
            );
            
            $doc->addField(Zend_Search_Lucene_Field::Text('barcode',
                                          CHtml::encode($item->barcode)
                                          , 'utf-8')
            );
            
             $doc->addField(Zend_Search_Lucene_Field::float('available_quantity',
                                          CHtml::encode($item->available_quantity)
                                          , 'utf-8')
            );
           
             $doc->addField(Zend_Search_Lucene_Field::float('current_quantity',
                                          CHtml::encode($item->current_quantity)
                                          , 'utf-8')
            );

            $index->addDocument($doc);
        	}
        	$index->commit();
        	echo 'Lucene index created';
    	}//end of create.
   
 
    public function actionSearch()
    {
    	//working.	
     	 $this->layout='column2';
         if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) 
         {
         	Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive());
            $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
            $results = $index->find($term);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);       
 			 			
            $this->render('search', compact('results', 'term', 'query'));
            
        }    	
    }//end of search.
    
}
