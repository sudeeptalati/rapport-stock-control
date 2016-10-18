<?php

class ItemsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('getyearlydataofstockjson','yearlyvalueofstockstats', 'generatebarcodelabel','create','update','InboundSearch','OutboundSearch','admin','FreeSearch','SearchEngine','PurchaseOrderList','index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
						   //allow admin to perform any action.
				//'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Items;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->item_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		//$actual_quantity=$model->current_quantity;

		// Uncomment the following line if AJAX validation is needed	
		 $this->performAjaxValidation($model);
		
		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
			//echo "DUE ADTE  ".$model->factory_due_date;
			
			
			
			
			
			if($model->save())
			{
			
				$this->redirect(array('view','id'=>$model->item_id));

				/*
				$original_quantity=$_POST['original_quantity'];
				$original_available_quantity=$_POST['original_available_quantity'];
				//echo "Actual ".$original_quantity;
				//echo "Current ".$model->current_quantity;
				if($original_quantity==$model->current_quantity && $original_available_quantity==$model->available_quantity)
				{
					//echo "value is same";

					
				}
				
				elseif ($original_quantity>$model->current_quantity && $original_available_quantity==$model->available_quantity)
				{
					//echo "ORIGINAL QUANTITY WAS MORE, ITEM REMOVED";
					
					$OutModel=new OutboundItemsHistory;
					$OutModel->main_item_id=$model->item_id;
					$OutModel->quantity_moved=$original_quantity-$model->current_quantity;
					//current_quantity is already having quantity_moved value also,so it is not subtracted here as it will be subtracted again in beforeSave() func.
					$OutModel->current_quantity_in_stock=$model->current_quantity+$OutModel->quantity_moved;
					$OutModel->available_quantity_in_stock=$model->current_quantity+$OutModel->quantity_moved;
					//$OutModel->quantity_moved=$original_quantity-$model->current_quantity;									
					if ($OutModel->save())
					{
						$this->redirect(array('view','id'=>$model->item_id));
						//echo "SAVED";
					}
					else 
						echo $OutModel->getError() ;
					
					//$this->redirect(array('view','id'=>$model->item_id));
					
				}//end of 1st elseif
				
				elseif ($original_quantity<$model->current_quantity && $original_available_quantity==$model->available_quantity) 
				{
					//echo "ORIGINAL QUANTITY WAS LESS, ITEM ADDED";
					
					$InModel=new InboundItemsHistory;
					$InModel->main_item_id=$model->item_id;
					$InModel->quantity_moved=$model->current_quantity-$original_quantity;
					//current_quantity is already having quantity_moved value also,so it is not added here as it will be added again in beforeSave() func.
					$InModel->current_quantity_in_stock=$model->current_quantity-$InModel->quantity_moved;
					$InModel->available_quantity_in_stock=$model->current_quantity-$InModel->quantity_moved;
					//$original_available_quantity=$original_available_quantity+
					
					//$InModel->quantity_moved=0;
					//$InModel->quantity_moved=$model->current_quantity-$original_quantity;									
					if ($InModel->save())
					{
						//$model->available_quantity=$model->current_quantity;
						$this->redirect(array('view','id'=>$model->item_id));
						//echo "SAVED";
					}
					else 
					{
							echo $InModel->getError() ;	
					}
					
					//$this->redirect(array('view','id'=>$model->item_id));
					
				}//end of 2nd elseif
				
				elseif ($original_quantity==$model->current_quantity && $original_available_quantity>$model->available_quantity)
				{
					//echo "ORIGINAL AVAILABLE QUANTITY WAS MORE, ITEM REMOVED";
					
					$OutModel=new OutboundItemsHistory;
					$OutModel->main_item_id=$model->item_id;
					$OutModel->quantity_moved=$original_available_quantity-$model->available_quantity;
					//current_quantity is already having quantity_moved value also,so it is not subtracted here as it will be subtracted again in beforeSave() func.
					$OutModel->current_quantity_in_stock=$model->current_quantity+$OutModel->quantity_moved;
					$OutModel->available_quantity_in_stock=$model->current_quantity+$OutModel->quantity_moved;
					//$OutModel->quantity_moved=$original_quantity-$model->current_quantity;									
					if ($OutModel->save())
					{
						$this->redirect(array('view','id'=>$model->item_id));
						//echo "SAVED";
					}
					else 
						echo $OutModel->getError() ;
					
					//$this->redirect(array('view','id'=>$model->item_id));
					
				}//END OF 3RD ELSEIF
				
				elseif ($original_quantity==$model->current_quantity && $original_available_quantity<$model->available_quantity)
				{
					//echo "ORIGINAL QUANTITY WAS LESS, ITEM ADDED";
				
					$InModel=new InboundItemsHistory;
					$InModel->main_item_id=$model->item_id;
					$InModel->quantity_moved=$model->available_quantity-$original_available_quantity;
					//current_quantity is already having quantity_moved value also,so it is not added here as it will be added again in beforeSave() func.
					$InModel->current_quantity_in_stock=$model->current_quantity-$InModel->quantity_moved;
					$InModel->available_quantity_in_stock=$model->current_quantity-$InModel->quantity_moved;
					//$original_available_quantity=$original_available_quantity+
					
					//$InModel->quantity_moved=0;
					//$InModel->quantity_moved=$model->current_quantity-$original_quantity;									
					if ($InModel->save())
					{
						//$model->available_quantity=$model->current_quantity;
						$this->redirect(array('view','id'=>$model->item_id));
						//echo "SAVED";
					}
					else 
					{
							echo $InModel->getError() ;	
					}
					
					//$this->redirect(array('view','id'=>$model->item_id));
					
				}//end of 4th elseif
				*/
				}//end of if(model->save())
		}//if(isset($_POST['Items']))

		$this->render('update',array(
			'model'=>$model,
		));
		
	}//end of update.

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*
		$dataProvider=new CActiveDataProvider('Items');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		
		$this->redirect(array('admin'));
		
	}

	/**
	 * Manages all models.
	 */
	
	public function actionAdmin()
	{
		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Items::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionInboundSearch()
	{
	    /*
		 * if URL contains a variable id, the layout is set to false because 
		 * this view is also called in Inbound Item History view function
		 * THIS WAS DONE TO ADD VIEW AFETER THE INDBOUND ACTION
		 */		
		if( !empty($_GET['id']))
		{
			$this->layout=false;		
		} 

		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];
		
		$this->render('inboundSearch',array(
				'model'=>$model,
		));
				
	}//end of function actionInboundSearch()
	
	public function actionOutboundSearch()
	{

		/*
		 * if URL contains a variable id, the layout is set to false because 
		 * this view is also called in Inbound Item History view function
		 */		
		if( !empty($_GET['id']))
		{
			$this->layout=false;		
		} 
		
    	$model=new Items('search');
    	$model->unsetAttributes();  // clear any default values
    	
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];
			
		$this->render('outboundSearch',array(
			'model'=>$model,
		));
    	/*$model=new Items('search');

    	// uncomment the following code to enable ajax-based validation
    	/*
    	if(isset($_POST['ajax']) && $_POST['ajax']==='items-OutboundSearch-form')
    	{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
    	}
    	

    	if(isset($_POST['Items']))
    	{
        	$model->attributes=$_POST['Items'];
        	if($model->validate())
        	{
            	// form inputs are valid, do something here
            	return;
        	}
    	}
    	$this->render('OutboundSearch',array('model'=>$model));
	}*/
	}//end of outboundSearch
	
	public function actionJsonSearch($keyword)
	{
		
		/*$model=new Items('freeSearch');
//		$keyword=$_GET['search_data'];
				$keyword=$_GET['search_data'];
			//$this->render('jsonSearch', array('results' => $results));
		//echo "key value is ".$keyword;	
//		$this->render('jsonSearch',array('model'=>$model,
//										 'dataProvider'=>results,
//										 ));


//		if(isset($_GET['search_data']))
//		{
			
//			$keyword=$_GET['search_data'];
			//$model->=$_GET['Items'];
//	   		$this->render('admin',array(
//			'model'=>$model,
//			));
//			
			//echo "key value is ".$keyword;
//			echo "key value is ".$keyword;
			//$keyword=$id;
			//$this->render('jsonSearch',array('model'=>$model,));
//		}*/
		
		
	
		$model=Items::model()->freeSearch($keyword);
		//echo "I  M ".$keyword;
		$this->render('jsonSearch',array('model'=>$model,));
	
	}
	

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
  	protected function gridStatusColumn($data,$row)
     {
      $image = $data->available_quantity == 0 ? '/images/nostock.jpg' : '/images/instock.jpg';   

      
      if ($data->available_quantity==0){
      		$image ="/images/red.png"; 
       		}
      elseif ($data->available_quantity <$data->recommended_lowest_quantity)
		     {
      			$image ="/images/yellow.png"; 
       			}else
      				{
 				     $image ="/images/green.png"; 
       				}
      
      
       return CHtml::image(Yii::app()->baseUrl . $image,'item_id');  
     }     

     
     
     
	public function actionPurchaseOrderList()
	{
		
		$this->layout=false;
		
		
		
		
	    $model=new Items('search');
	    $model->unsetAttributes();  // clear any default values
	
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='items-purchaseOrderList-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	    
	    
	
	    if(isset($_GET['Items']))
	    {
	        $model->attributes=$_GET['Items'];
//	        if($model->validate())
//	        {
//	            // form inputs are valid, do something here
//	            return;
//	        }
	    }
	    $this->render('purchaseOrderList',array('model'=>$model,));
	}//end of purchaseOrderList.
	
	
	public function actionFreeSearch()
	{
		$model=new Items('search');
		$this->render('freeSearch',array('model'=>$model));
	}
	
	public function actionSearchEngine($keyword)
	{
		//echo "THIS IS IAJAXX  ".$keyword;
		
		
		$model=new Items();
		$model->unsetAttributes();  // clear any default values
		
		$results=$model->freeSearch($keyword);
		
	
		$this->renderPartial('_ajax_search',array(
				'results'=>$results,
		));
		
		
	}
	
	
	
	
	public function actionGeneratebarcodelabel($id)
	{
		$model=$this->loadModel($id);
	
		$this->renderPartial('generatebarcodelabel',array(
				'model'=>$model,
		));
	
	}///end of public function actionGeneratebarcodelabel($id)
	


	public function actionYearlyvalueofstockstats()
	{
		$data='<h1>Statistics</h1>';

		$model=new Items();

		$data=$model->generateyearlystockvaluedata();

		///As this isa array you need to convert it into string and then convert it into json object
		$json_data_string= json_encode($data);
		$json_data=json_decode($json_data_string);

		//echo $json_data->totalvalueofallstock->total_exc_vat;

		//echo json_encode($data);

		$this->renderPartial('statistics',array('json_data'=>$json_data,'json_data_string'=>$json_data_string));
		//$this->render('statistics',array('json_data'=>$json_data,'json_data_string'=>$json_data_string));



	}///end of	public function actionStatistics()

	public function actionGetyearlydataofstockjson()
	{	
		$model=new Items();
		$data=$model->generateyearlystockvaluedata();
		echo json_encode($data);
	}
	
	protected function exporttoexcel($dataProvider)
	{
		header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
		header( "Content-Disposition: inline; filename=\"Items Stock  ".date("F j, Y").".xls\"" );

		$dataProvider = $model->search();
		$dataProvider->pagination = False;
		?>

		<table border="1"> <tr>
				<th>item_id</th>
				<th>Company_id</th>
				<th>Part Number</th>
				<th>Part Name</th>
				<th>description</th>
				<th>barcode</th>
				<th>Location Room</th>
				<th>Location Row</th>
				<th>Location Column</th>
				<th>Location Shelf</th>
				<th>Category_id</th>
				<th>Available Quantity</th>
				<th>Current Quantity</th>
				<th>recommended_lowest_quantity </th>
				<th>recommended_highest_quantity</th>
				<th>remarks</th>
				<th>active</th>
				<th>created</th>
				<th>modified</th>
				<th>deleted</th>
			</tr>

			<?php
			//echo "item_id \t company_id \t part_number \t name \t description \t barcode \t location_room \t location_row \t location_column \t location_shelf \t category_id \t current_quantity \t available_quantity \t recommended_lowest_quantity \t recommended_highest_quantity \t remarks \t active \t created \t modified \t deleted \n";
			foreach( $dataProvider->data as $data )
			{
				if ($data->available_quantity>0)
				{
					echo "<tr>";
					echo "<td>".$data->item_id."</td>";
					echo "<td>".$data->company_id."</td>";
					echo "<td>".$data->part_number."</td>";
					echo "<td>".$data->name."</td>";
					echo "<td>".$data->description."</td>";
					echo "<td>".$data->barcode."</td>";
					echo "<td>".$data->location_room."</td>";
					echo "<td>".$data->location_row."</td>";
					echo "<td>".$data->location_column."</td>";
					echo "<td>".$data->location_shelf."</td>";
					echo "<td>".$data->category_id."</td>";
					echo "<td>".$data->current_quantity."</td>";
					echo "<td>".$data->available_quantity."</td>";
					echo "<td>".$data->recommended_lowest_quantity."</td>";
					echo "<td>".$data->recommended_highest_quantity."</td>";
					echo "<td>".$data->remarks."</td>";
					echo "<td>".$data->active."</td>";
					echo "<td>".$data->created."</td>";
					echo "<td>".$data->modified."</td>";
					echo "<td>".$data->deleted."</td>";
					echo "</tr>";

				}//end of if($data).

				//echo $data->item_id, "\t",$data->company_id, "\t", $data->part_number, "\t", $data->name, "\t", $data->description, "\t", $data->barcode, "\t", $data->location_room,  "\t",$data->location_row, "\t", $data->location_column, "\t", $data->location_shelf, "\t", $data->category_id, "\t", $data->current_quantity, "\t", $data->available_quantity, "\t", $data->recommended_lowest_quantity, "\t", $data->recommended_highest_quantity, "\t", $data->remarks, "\t", $data->active, "\t", $data->created, "\t", $data->modified, "\t", $data->deleted,"\n";
			}//end foreach
			?>
		</table>
		<?php

		Yii::app()->end();

	}///end of 	protected exporttoexcel($data)
}
