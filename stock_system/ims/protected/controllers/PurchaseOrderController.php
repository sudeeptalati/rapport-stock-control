<?php

class PurchaseOrderController extends Controller
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
				'actions'=>array('preview'),
				'users'=>array('*'),
			),
				*/
				
				
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('notifySupplier', 'orderRecieved','finaliseOrder','create','update','index','view','admin','autoCreate','preview','itemsAdmin','sendOrder','OrderPreview','testConnection','OrderExcel','OrderCsv'),
				'users'=>array('@'),
			),
				
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
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
	public function actionCreate($suppliers_id)
	{
		$model=new PurchaseOrder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$model->suppliers_id=$suppliers_id;

		if(isset($_POST['PurchaseOrder']))
		{
			$model->attributes=$_POST['PurchaseOrder'];
			//$model->save();
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
				
		}
		

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/*
	 *MY CREATE CONTROLLER 
	 */
		
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PurchaseOrder']))
		{
			$model->attributes=$_POST['PurchaseOrder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

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
		$dataProvider=new CActiveDataProvider('PurchaseOrder');
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
		$model=new PurchaseOrder('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['PurchaseOrder']))
		{
			$model->attributes=$_GET['PurchaseOrder'];
		}
			

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
		$model=PurchaseOrder::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchase-order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

/*
 * #######################################
 * MY FUNCTIONS  
 * #######################################
 */

	public function actionAutoCreate($suppliers_id)
	{
		$model=new PurchaseOrder;
		$model->suppliers_id=$suppliers_id;
		$model->order_status='1';//since initailly PO is in draft stage
		//$model->save();
		if($model->save())
		{
			//echo "supplier id".$model->suppliers_id;
			/*WE are passing here the purchase order id
			 * $model->id is id of purchase order table
			 */
			$this->redirect(array('preview','id'=>$model->id));
			
		 }
	}//end of autoCreate().


	
	public function actionPreview($id)
	{
	    $model=$this->loadModel($id);
	    
	    if(isset($_POST['PurchaseOrder']))
	    {
	    	$model->attributes=$_POST['PurchaseOrder'];
	    	
	    	$message='';
	    	$items_on_order_count=$model->getItemsOnOrder($id);
	    	if(count($items_on_order_count)==0)
	    	{
	    		$message.='Please add some Items before finalising.<br> ';
	    	}
	    	
	    	
	    	if (empty($model->shipping_cost)) 
	    	{
	    		$message.='Please enter the shipping cost at the end. If no Shipping cost add amount as 0.0';
	    	}


	    	
	    	if(!empty($message)) 
	    	{
	    		$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	    				'id'=>'juiDialog',
	    				'options'=>array(
	    						'title'=>'Shipping Cost Missing',
	    						'autoOpen'=>true,
	    						'modal'=>'true',
	    						'show' => 'blind',
                            	'hide' => 'explode'
	    						//'width'=>'40px',
	    						//'height'=>'40px',
	    						),
	    				'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',
       					
	    				
	    		));
	    		
	    		echo $message;
	    		$this->endWidget();
	    		
	    		
	    		
	    	}//end of message empty if
	    	else
	    	{
	    		
	    		$taxable_amount=$model->shipping_cost+$model->total_cost;
	    		$vat_percentage=Yii::app()->params['vat_in_percentage'];
	    		
	    		$model->vat=($taxable_amount*$vat_percentage)/100;
	    		$model->net_cost=$model->total_cost+$model->shipping_cost+$model->vat;

	    		
	    		
	    		if ($model->save())
	    		{
	    		$this->redirect(array('finaliseOrder','id'=>$model->id));
	    		}
	    	}//end of else
	    
	    }
	    
	    if ($model->order_status==1)
	    {
		$this->render('preview',array('model'=>$model));
	    	}
	    	else
	    	{
	    		$this->render('finaliseOrder',array('model'=>$model));
	    	   }
	    
	}//end of preview.
	
	
	public function actionItemsAdmin()
	{
	    $model=new PurchaseOrder('search');
	    
	    //$this->layout=false;

	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='purchase-order-itemsAdmin-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	
	    if(isset($_POST['PurchaseOrder']))
	    {
	        $model->attributes=$_POST['PurchaseOrder'];
	        if($model->validate())
	        {
	            // form inputs are valid, do something here
	            return;
	        }
	    }
	    $this->render('itemsAdmin',array('model'=>$model));
	}//end of itemsAdmin.

	
	public function actionSendOrder($id)
	{
		
		$model=$this->loadModel($id);
	    $setupModel = Setup::model()->findByPk(1);
		
		$reciever_email=$model->suppliers->email;
		$reciever_name=$model->suppliers->contact_person;
		//$sender_email=Yii::app()->params['adminEmail'];
		$sender_email = $setupModel->email;
		//$sender_name=Yii::app()->params['company_name'];
		$sender_name = $setupModel->company;
		
		$message = new YiiMailMessage();
	    $message->setTo(
	    		array($reciever_email=>$reciever_name));
	    $message->setFrom(array($sender_email=>$sender_name));
	    $message->setSubject('Purchase Order: '.$model->order_number);

	    $message->setBody($this->render('orderPreview',array('model'=>$model,), true),'text/html');
	    $numsent = Yii::app()->mail->send($message);
	   	$numsent=1;
	    if($numsent==1)
	    	{
	    		/*Changing the status of items on order*/
	    		$items_on_order=PurchaseOrder::model()->getItemsOnOrder($id);
	    		foreach ($items_on_order as $item)
	    		{
	    			//echo 'THIS S '.$item->id;
	    			ItemOnOrder::model()->updateByPk(	$item->id,
									    				array
	    													(
	    													'item_status'=>'2',/*Since 2 is static order status for item on order*/
	    													)
	    			);
	    		}

	    		/*changing the po status*/
	    		PurchaseOrder::model()->updateByPk(	$id,
									    				array
	    													(
	    													'order_status'=>'2',/*Since 2 is static order status for send*/
	    													'user_id'=>Yii::app()->user->id,
	    													'date_of_order'=>time(),
	    													)
	    		);
	    		
	    		
	    		$message='The purchase order has been successfully sent.';
		    	$this->redirect(array('finaliseOrder','id'=>$model->id));
				
	    	
	    	}//end of succesfful send if
	    else
	    	$this->raiseEvent('Error', 'error');
	    //$this->refresh();
		

	}//end of function actionSendOrder
	
	
	public function actionOrderPreview($id)
	{

		$model=$this->loadModel($id);

		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mPDF('', 'A5');
		# render (full page)
		$mPDF1->WriteHTML($this->render('orderPreview',array('model'=>$model,), true));
	    # Load a stylesheet
	    $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
	    $mPDF1->WriteHTML($stylesheet, 1);
		# Outputs ready PDF
	    $mPDF1->Output();
    	//$this->render('orderPreview',array('model'=>$model));

	}///end of orderpreview
	
	public function actionOrderExcel($id)
	{
		//echo "ID IN CONTROLLR".$id;
		$model=$this->loadModel($id);
		$order_id=$model->order_number;
		
		$model=$this->loadModel($id);
		$setupModel = Setup::model()->findByPk(1);
		
		header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
  		header( "Content-Disposition: inline; filename=\"Purchase Order  ".$model->order_number.".xls\"" );
		
		$itemModel=$model->getItemsOnOrder($id);
		?>
		<table>
		<tr>
		<td><?php echo "Supplier name : ";?></td>
		<td><?php echo $model->suppliers->name;?></td>
		<td><?php echo "Purchase Order No: ";?></td>
		<td><?php echo $model->order_number;?></td>
		</tr>
		<tr>
		<td><?php echo "Address :";?></td>
		<td><?php echo $model->suppliers->town."\n".$model->suppliers->postcode_s." ".$model->suppliers->postcode_e;?></td>
		<td><?php echo "Order placed by: ";?></td>
		<td><?php echo $model->user->name;?></td>
		</tr>
		</table>
		
		
		<table border="1"><tr>
		<th>Part Number</th>
		<th>Part Name</th>
		<th>Quantity Ordered</th>
		<th>Price</th>
		<th>Total</th>
		<th>Comments</th>
		</tr>
		 
		<?php 
		foreach($itemModel as $data)
		{
			?>
			
			<tr>
			<td style="vertical-align:middle";align="center"><?php echo $data->items->part_number;?></td>
			<td style="vertical-align:middle";align="center"><?php echo $data->items->name;?></td>
			<td style="vertical-align:middle";align="center"><?php echo $data->quantity_ordered;?></td>
			<td style="vertical-align:middle";align="center"><?php echo $data->unit_price;?></td>
			<td style="vertical-align:middle";align="center"><?php echo $data->total_price;?></td>
			<td><?php echo $data->comments;?></td>
			</tr>
			
			
		<?php 
		}
		?>
		<tr><td colspan="6"></td></tr>
		<tr><th colspan="4" style="width:10%;text-align:right">Subtotal</th>
		<td colspan="2" style="width:10%;text-align:left"><?php echo $model->total_cost;?></td></tr>
		<tr><th colspan="4" style="width:10%;text-align:right">Shipping Cost</th>
		<td colspan="2" style="width:10%;text-align:left"><?php  echo $model->shipping_cost;?></td></tr>
		<tr><th colspan="4" style="width:10%;text-align:right">VAT @ <?php echo Yii::app()->params['vat_in_percentage'];?>%</th>
		<td colspan="2" style="width:10%;text-align:left"><?php echo $model->vat;?></td></tr>
		<tr><th colspan="4" style="width:10%;text-align:right">Total</th>
		<td colspan="2" style="width:10%;text-align:left"><?php echo $model->net_cost; ?></td></tr>
		</table>
		<?php 
		
	}///end of orderExcel
	
	public function actionOrderCsv($id)
	{
		//echo "IN ACTION CSV";
		
		$model=$this->loadModel($id);
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/csv');
		header('Content-disposition: attachment; filename=Purchase Order  '.$model->order_number.'.csv');
		
		//$enrollment = Reports::getEnrollment($courseId);
		//$order=PurchaseOrder::getItemsOnOrder($id);
		$itemModel=$model->getItemsOnOrder($id);
		$separator=",";
		
		foreach ($itemModel as $data)
		{
	    	$tmp = array(
	        $data->items->part_number,
	        $data->items->name,
	        $data->quantity_ordered,
	        $data->quantity_ordered,
	        $data->unit_price,
	        $data->total_price,
	       
	        	);

    		echo join($separator, $tmp)."\n";

		}
		
		Yii::app()->end();
		
	}//end of orderCsv
	
	
	
	public function actionFinaliseOrder($id)
	{
		$model=$this->loadModel($id);
		$this->render('finaliseOrder',array(
				'model'=>$model,
		));
	}
	
	public function actionOrderRecieved($id)
	{
			$model=$this->loadModel($id);

			/*THIS WILL CALCULATE THE STATUS OF THE PURCHASE ORDER ON THE BASIS OF ALL OTHER ITEMS*/
			$items_on_order_model =PurchaseOrder::model()->getItemsOnOrder($id);
			
			$flag1=0;
			$flag2=0;
			$flag3=0;
			foreach ($items_on_order_model as $ordered_items)
			{
				
				$item_status_id=$ordered_items->item_status;
				/**
				 * 2 means all items are on order and when recieved for first time all items will have the status 2. 
				 * NOTE:-- THIS IS ALSO CONSIDERED AS RESET POSITION
				*/
				if ($item_status_id==2)
				{
					$flag1=2;
				}
				elseif ($item_status_id==3 || $item_status_id>=10)//3 means all items are marked as recieved without any problem
				{
					$flag2=3;
					
				}else
				{
					$flag3=4;
					break;
				}
			
			}//end of foreach
			
			$order_status='';

			if ($flag1==2 && $flag2==0 && $flag3==0)
			{
				$order_status=3;///i.e. order is recieved
				
				PurchaseOrder::model()->updateByPk($id, array(
						'date_of_order_recieved'=>time(),
				
				));
			}
			else if($flag1==0 && $flag2==3 && $flag3==0)/// i.e. all items are checked and ok so order can be completed
			{
				$order_status=10;
			}
			else
			{
				$order_status=4; //i.e. order is partially recieved and some more order is to come
			}
				
			
			
			PurchaseOrder::model()->updateByPk($id, array(
					'order_status'=>$order_status,
			
			));
			
			$model=$this->loadModel($id);
			
			
			

			$this->render('orderRecieved',array(
					'model'=>$model,
			));
	}///end of function ordeer recievded
	
	public function actionNotifySupplier($id)
	{

		$model=$this->loadModel($id);
		$setupModel = Setup::model()->findByPk(1);
		
		$model=$this->loadModel($id);
		$itemsOnOrderModel=$model->getItemsOnOrder($id);
		
		$reciever_email=$model->suppliers->email;
		$reciever_name=$model->suppliers->contact_person;
		//$sender_email=Yii::app()->params['adminEmail'];
		$sender_email = $setupModel->email;
		//$sender_name=Yii::app()->params['company_name'];
		$sender_name = $setupModel->company;
		
		$message = new YiiMailMessage();
		$message->setTo(
				array($reciever_email=>$reciever_name));
		$message->setFrom(array($sender_email=>$sender_name));
		$message->setSubject('Items missing or damaged - Purchase Order: '.$model->order_number.' ');
		
		$message->setBody($this->renderPartial('finaliseOrder',array('model'=>$model,), true),'text/html');
		$numsent = Yii::app()->mail->send($message);
		$numsent=1;
		if($numsent==1)
		{
				
				$this->redirect(array('finaliseOrder','id'=>$model->id));
		}else
			{
				$this->raiseEvent('Error', 'error');
			}//end of else
			
	}//end of function notify supplier
	
	
	public function actionTestConnection($id)
	{
		$model=$this->loadModel($id);
		//echo "IN ACTION TEST CONNECTION <br>";
		
		if(!$conn = @fsockopen("google.com", 80, $errno, $errstr, 30))
		{
			echo "PLEASE CHECK YOUR INTERNET CONNECTION";
			echo $model->id;
		}
		else 
		{
			$root = dirname(dirname(__FILE__));
			//echo "<br>".$root;
			$filename = $root.'/config/mail_server.json';
			//echo "<br>file url = ".$filename;
			
			$send_receive_address = '';
			
			//echo "INTERNET IS CONNECTED";
			
			if(file_exists($filename))
			{
				//echo "<br>File is present";
				$data = file_get_contents($filename);
				$decodedata = json_decode($data, true);
				$send_receive_address = $decodedata['smtp_username'];
				//echo "<br>email addr = ".$send_receive_address;
				
			}//end of if file exists.
			else
			{
				//echo "<br>Unable to find valid email address";
			}
			
			$model=new PurchaseOrder;
			
			$reciever_email=$send_receive_address;
			$sender_email=$send_receive_address;
			
			$message = new YiiMailMessage();
			$message->setTo(array($reciever_email));
		    $message->setFrom(array($sender_email));
		    $message->setSubject('Test');
			
		    $message->setBody("This is a test mail from Stock System");
		    
		    
		    # You can easily override default constructor's params
// 			$mPDF1 = Yii::app()->ePdf->mPDF('', 'A5');
// 			# render (full page)
// 			$mPDF1->WriteHTML($this->render('orderPreview',array('model'=>$model,), true));
// 		    # Load a stylesheet
// 		    $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
// 		    $message->setBody($mPDF1->WriteHTML($stylesheet, 1));
		   	//$message->setBody('THIS IS TEST MAIL');
		    //$numsent = Yii::app()->mail->send($message);
		    if(Yii::app()->mail->send($message))
		   	{
		   		echo "TEST EMAIL IS SENT, CONNECTION IS OK<br>"; 
		   	}
		   	
		   		
		   
		   	
			
			
		}//end of else.
		
	}//end of testConnection.
	
	
	
	
}////end of class
