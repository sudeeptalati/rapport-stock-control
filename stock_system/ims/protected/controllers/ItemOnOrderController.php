<?php

class ItemOnOrderController extends Controller
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
				'actions'=>array('create','update','index','view','admin','PreviewDelete','UpdateStatus', 'CancelItems'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
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
			$model=new ItemOnOrder;
		
			
			
			if(isset($_POST['ItemOnOrder']))
			{
			$model->attributes=$_POST['ItemOnOrder'];
			$model->item_status='1';//since initailly ITEM is in initializing stage
			$model->quantity_recieved=0.0;
			echo "Comments are ".$model->comments;
			
			if($model->save())
			{	
				$po_id=$model->purchase_order_id;
				$this->redirect(array('/PurchaseOrder/preview','id'=>$model->purchase_order_id));
			}
			
		}//end of ifisset().

		
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
		
		if(isset($_POST['ItemOnOrder']))
		{
			$model->attributes=$_POST['ItemOnOrder'];
			
			
			$total_price_before_update=$model->total_price;

			$purchaseOrderQueryModel = PurchaseOrder::model()->findByPk(
													$model->purchase_order_id
														);
														
			$purchaseOrderUpdateModel = PurchaseOrder::model()->updateByPk(
													$model->purchase_order_id,
													array
														(
															'total_cost'=>$purchaseOrderQueryModel->total_cost-$total_price_before_update
														)														
														);		
			
			$model->total_price=$model->unit_price*$model->quantity_ordered;
			
			if($model->save())
			{
				//echo "in itemOnOrder controller";
				$this->redirect(array('/PurchaseOrder/preview','id'=>$model->purchase_order_id));
				
			}

			
		}///end of post if
		$this->render('update',array( 'model'=>$model,));
		
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
		$dataProvider=new CActiveDataProvider('ItemOnOrder');
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
		$model=new ItemOnOrder('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ItemOnOrder']))
			$model->attributes=$_GET['ItemOnOrder'];

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
		$model=ItemOnOrder::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-on-order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionPreviewDelete($id)
	{
		
		$model=$this->loadModel($id);
		
		if($model->item_status==1)
		{
			$purchaseOrderQueryModel = PurchaseOrder::model()->findByPk(
													$model->purchase_order_id
														);

			$updated_total_cost=$purchaseOrderQueryModel->total_cost-$model->total_price;

			$taxable_amount=$purchaseOrderQueryModel->shipping_cost+$purchaseOrderQueryModel->total_cost;
			$vat_percentage=Yii::app()->params['vat_in_percentage'];
			$updated_vat=($taxable_amount*$vat_percentage)/100;
			$updated_net_cost=$purchaseOrderQueryModel->total_cost+$purchaseOrderQueryModel->shipping_cost+$purchaseOrderQueryModel->vat;
			
			
			
			
			$purchaseOrderUpdateModel = PurchaseOrder::model()->updateByPk(
													$model->purchase_order_id,										
													array
														(
															'total_cost'=>$updated_total_cost,
															'vat'=>$updated_vat,
															'net_cost'=>$updated_net_cost,	
														)														
														);

			
													
			$this->loadModel($id)->delete();	

			$this->redirect(array('/PurchaseOrder/preview','id'=>$model->purchase_order_id));
		}//end of if.
		
		else 
		{
			echo "It is not possible to delete now";
			
		}
														
		
		
//		if(Yii::app()->request->isPostRequest)
//		{
//			// we only allow deletion via POST request
//			$this->loadModel($id)->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}//end of previewDelete.
	
	
	public function actionUpdateStatus($id)
	{

		echo 'ID ID '.$id;
		
		
		if (!empty($_GET['all_recieved']))
		{
			$all_recieved=$_GET['all_recieved'];
		}
		
		if ($id==0 && $all_recieved=='true')
		{
			$purchase_id=$_GET['purchase_id'];
			echo $purchase_id;

			$items_on_order_model =PurchaseOrder::model()->getItemsOnOrder($purchase_id);
			foreach ($items_on_order_model as $ordered_items) 
			{
				$item_id=$ordered_items->id;
				echo '<hr>ITEM IUS IS     '.$item_id;
				if ($ordered_items->item_status==2){				
					ItemOnOrder::model()->updateByPk($item_id, array(
														'item_status'=>3,
														'quantity_recieved'=>$ordered_items->quantity_ordered
						));
				}//end of if
			}//end of foreach
		
			$this->redirect(array('/purchaseOrder/orderRecieved/','id'=>$purchase_id));
			
		}///end of if
		else
		{
			$model=$this->loadModel($id);
			
			$current_quantity_recieved=$model->quantity_recieved;
			
			if(isset($_POST['ItemOnOrder']))
			{
				$model->attributes=$_POST['ItemOnOrder'];
				
				
				$status=$model->item_status;
				$diff=$model->ordered_recieved_difference;
				$model->quantity_recieved=$model->quantity_recieved+$diff;
				
				
				$quantity_recieved=$model->quantity_recieved;
				
				
				$quantity_ordered=$model->quantity_ordered;
				echo "<br> QUANTIY RECIEVED  ".$quantity_recieved;
				echo "<br> QUANTIY ORDERED  ".$quantity_ordered;
				echo "<br> DIFF  ".$diff;
				/*
				 * WE have set the flag as 3 for recieved and 6 for damaged
				 * we will do funny calculations based on that
				 * 
				 */
				if ($status==3)
				{
					$comments=$diff.' recieved. ';
					//$comments.=' under the purchase order number '.$model->purchaseOrder->order_number;
					$comments.=' Processed by '.Yii::app()->user->name." on ".date("d-M-y H:i").'<br>';
					
					$model->comments.=$comments;
					if ($quantity_ordered==$quantity_recieved)
					{
						$model->item_status=3;//i.e. all items are recieved
					}
					elseif ($quantity_ordered>$quantity_recieved)
					{
						$model->item_status=4;////i.e. partiually recieved
						echo "RECIEVD is  ".$model->quantity_recieved;
					}
					elseif($quantity_ordered<$quantity_recieved)
					{
							$model->item_status=2;//status reset
							
					}else
						{
							$this->redirect(array('/purchaseOrder/orderRecieved/','id'=>$purchase_id));
						}//end of else
				   
					
					}//end of if of status 50
				if ($status==6)//for quantities that are damaged
				{
					/*THIS MEANS ALL PARTS WERE DAMAGED*/
					if ($quantity_ordered==$quantity_recieved)					
					{
					 	$model->item_status=6;
						}
					else//thsii means partially damaged
					{
						$model->item_status=7;//this is partially damaged item model
					}
										
					
					//echo 'QUANTITRY DAMAGED  '.$diff;
					$model->quantity_damaged=$diff;
					
					$model->quantity_recieved=$current_quantity_recieved;
					//$model->quantity_recieved=0.0;
					/*THIS IS DONE, else the system will store in quantity recieved also*/
					//$model->quantity_recieved=$current_quantity_recieved;
				//	echo 'QUANTITRY Recieved'.$model->quantity_recieved;
					
					
					
					$comments=$diff;
					$comments.=' damaged. '; 
					$comments.=' Processed by: '.Yii::app()->user->name." on ".date("d-M-y H:i").'<br>';
					$quantity_recieved=0.0;
					$model->comments.=$comments;
					
					
				
				}///end of if status 51
				
				
				/*IF any quantity is recieved it wil be added to inbound and the items details will also be updated*/
				if ($quantity_recieved>0)
				{
					echo 'Logic to add in inbound';
					$inbound_model= new InboundItemsHistory();

					$main_item_id=$model->items_id;
					$item_model= Items::model()->findByPk($main_item_id);

					$current_stock=$item_model->current_quantity;
					$available_stock=$item_model->available_quantity;
					$quantity_moved=$quantity_recieved;

					$inbound_model->main_item_id=$model->items_id;
					$inbound_model->quantity_moved=$quantity_recieved;
					$inbound_model->items_on_order_id=$model->id;
					$inbound_model->comments.=$comments.'Purchase Order Number ='.$model->purchaseOrder->order_number;					
					$inbound_model->available_quantity_in_stock=$quantity_moved+$available_stock;
					$inbound_model->current_quantity_in_stock=$quantity_moved+$current_stock;

					
					if ($inbound_model->save())
					{
						echo 'saved';
						Items::model()->updateByPk(
								$main_item_id,
								array
								(
										'available_quantity'=>$quantity_moved+$available_stock,
										'current_quantity'=>$quantity_moved+$current_stock,
								)
						);
						
					}else
					{
						echo 'NOT SAVING INBOUND ENTRY';
					}
					
				}//end of logic to make entry in inbound
				
				
				if($model->save())
				{
					$this->redirect(array('/purchaseOrder/orderRecieved/','id'=>$model->purchase_order_id));
				
				}///end of save

				
				// 			$redirect_url='/purchaseOrder/orderRecieved/'.$purchase_id;
// 			$url=$this->createUrl($redirect_url);
// 			$this->redirect($url);
			}//end of if _POST
			else 
				{
				$item_status=$_GET['item_status'];
				$purchase_id=$_GET['purchase_id'];
				$comments=$_GET['comments'];
				$comments.='<br>Status Reset to On Order by: '.Yii::app()->user->name." on ".date("d-M-y H:i").'<br>';
				
				echo 'THIS IHJS CPDE   '.$item_status;
				
				ItemOnOrder::model()->updateByPk($id, array(
														'item_status'=>$item_status,
														'quantity_recieved'=>'0.0',
														'comments'=>$comments,
						
						));
				
				$this->redirect(array('/purchaseOrder/orderRecieved/','id'=>$purchase_id));
				}//end of else _POST
		}//end of else id=0
	}//end of function
	
	
	
	public function actionCancelItems($id)
	{
			$model=$this->loadModel($id);
			

			$quantity_cancelled=$model->quantity_ordered-$model->quantity_recieved;			
			$model->comments.='<br>'.$quantity_cancelled.' quantity have been cancelled by the user '.Yii::app()->user->name;
			$model->comments.=' on '.date("F j, Y, g:i a");
			
			$model->quantity_ordered=$model->quantity_recieved;
			
			if ($quantity_cancelled==$model->quantity_ordered)
			{
				$model->item_status=11;//item status will be changed to cancelled
			}else
			{
				$model->item_status=3;//item status will be changed to recieeved
			}
			
			$item_total_price_before=$model->total_price;
			$model->total_price=$model->quantity_recieved*$model->unit_price;
			$purchaseOrderQueryModel = PurchaseOrder::model()->findByPk(
					$model->purchase_order_id
			);
			/*HERE IT IS ONLY DEDUCTED BECASUSE IT WILL BE AUTOMATIUCALLY ADDED LATER AFTER FUNCTION*/
			$ameneded_total_cost=$purchaseOrderQueryModel->total_cost-$item_total_price_before;
			
			PurchaseOrder::model()->updateByPk(
					$model->purchase_order_id,
					array
					(
							'total_cost'=>$ameneded_total_cost,
					)
			);
			if($model->save())
			{
				
				
				/*I WIL SEND EMAIL FIRST*/
				$reciever_email=$purchaseOrderQueryModel ->suppliers->email;
				$reciever_name=$purchaseOrderQueryModel ->suppliers->contact_person;
				$sender_email=Yii::app()->params['adminEmail'];
				$sender_name=Yii::app()->params['company_name'];
				
				$message = new YiiMailMessage();
				$message->setTo(
						array($reciever_email=>$reciever_name));
				$message->setFrom(array($sender_email=>$sender_name));
				$message->setSubject('Items Cancelled - Purchase Order: '.$purchaseOrderQueryModel->order_number.' ');
				
				$msg_body='Dear Sir, <br> This is to remind you that we are cancelling the following items from the order as we have not got the delivery of it.<br>';
				
				$msg_body.='<table><tr><th>Name</th><th>Part Number</th><th>Quantity Ordered</th><th>Quantity Cancelled</th></tr>';
				$msg_body.='<tr><td>'.$model->items->name.'</td><td>'.$model->items->part_number.'</td><td>'.$model->quantity_ordered.'</td><td>'.$quantity_cancelled.'</td></tr></table>';				
				$msg_body.='Please Update the Purchase Order Copy <hr>';

				
				$msg_body.=$this->renderPartial('/purchaseOrder/finaliseOrder',array('model'=>$purchaseOrderQueryModel,), true);
				$message->setBody($msg_body,'text/html');
				$numsent = Yii::app()->mail->send($message);
				$numsent=1;
				if($numsent==1)
				{
					echo 'Supplier Notified for cancellation';					
					$this->redirect(array('/purchaseOrder/orderRecieved/','id'=>$model->purchase_order_id));
				
				}else
				{
					$this->raiseEvent('Error', 'error');
				}//end of else
				
				
				
				
				
				
				
				
				//echo "in itemOnOrder controller";
				$this->redirect(array('/PurchaseOrder/orderRecieved','id'=>$model->purchase_order_id));
 			}
 			else 
 			{
 				echo 'error in updating ';
 			}
		
	}///end of fuction cancel Items and 
	
 
	
	
}//end of class
