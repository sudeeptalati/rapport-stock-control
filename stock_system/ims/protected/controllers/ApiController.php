<?php 

class ApiController extends Controller
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';
 
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array();
    }
 
    // Actions
    public function actionLoaditembyitemid()
    {
     	if(isset($_GET['item_id']))
    		$main_item_id=$_GET['item_id'];
		else{
			$msg='Item id Missing ';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		
		
		
		
		$itemModel=Items::model()->findByPk($main_item_id);
		$itemModel->setAttribute("company_id",$itemModel->suppliers->name);
		
		$itemModel->setAttribute("factory_due_date",$this->formatdate($itemModel->factory_due_date));
		$itemModel->setAttribute("created",$this->formatdate($itemModel->created));
		$itemModel->setAttribute("modified",$this->formatdate($itemModel->modified));
		$itemModel->setAttribute("stock_date",$this->formatdate($itemModel->stock_date));
		$itemModel->setAttribute("purchase_date",$this->formatdate($itemModel->purchase_date));
		
		$itemModel->setAttribute("comments",Setup::model()->printjsonnotesorcommentsinhtml($itemModel->comments));
	 
		
	 
		
		if ($itemModel)
		{
			$results = array ('results'=>$itemModel);
		   	$this->_sendResponse(200, CJSON::encode($results));
		}else
		{
			$msg='Cannot find the item';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}

    }///end of public function actionLoaditembyitemid()
    
    
    
    
    
    
    
    public function actionItemFreeSearch()
    {
    	    //$this->_checkAuth();
		    //$keyword=$id;
		    // Check if id was submitted via GET
		    //URL to access ItemFreeSearch is /root/api/ItemFreeSearch/model/keyword
		    
    
    		if(!isset($_GET['keyword']))
		        $this->_sendResponse(500, 'Error: Parameter <b>keyword</b> is missing' );
			
			if(!isset($_GET['model']))
		        $this->_sendResponse(500, 'Error: Parameter <b>model</b> is missing' );
		 	
		 
		 	$keyword=$_GET['keyword'];
    		$oldmodel=$_GET['model'];
    		//echo "Keu is =".$keyword." MODEL is ".$oldmodel;
    		
		   // if(!isset($_GET['id']))
    		
		    switch($_GET['model'])
		    {
		        // Find respective model    
		        case 'Items':
		            //$model = Items::model()->findByPk($_GET['id']);
		        	$results=Items::model()->freeSearch($keyword);
		        	$allitems=$results->getData();
		        	break;
		        	
		        	
		        default:
		            $this->_sendResponse(501, sprintf(
		                'Mode <b>view</b> is not implemented for model <b>%s</b>',
		                $_GET['model']) );
		            exit;
		    }
		    // Did we find the requested model? If not, raise an error
		    if(is_null($allitems))
		        $this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
		    else{
		        //$this->_sendResponse(200, CJSON::encode($_GET['model']));
		    	
		    	$results_array = array ('results'=>$allitems);
		    	$this->_sendResponse(200, CJSON::encode($results_array));
		    }///end of else of if
		    
    	
    }///end of function Item free search
    
    public function actionOutbound()
    {
    	//getting values from url.
    	if(isset($_POST['item_id']))
    		$main_item_id=$_POST['item_id'];
		else{
			$msg='Item id Missing ';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		
		if(isset($_POST['quantity_moved']))
    		$quantity_moved=$_POST['quantity_moved']; 
       	else{
			$msg='quantity moved id Missing ';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		 

    	
    	//echo "quantity Moved is : ".$quantity_moved."		Item id is: ".$main_item_id."		CLASSmodel is: ".$oldmodel;
    	
    	//getting values from items table.
    	$model=new OutboundItemsHistory;
  
		$itemModel=Items::model()->findByPk($main_item_id);
		if ($itemModel)
		{
			$model->current_quantity_in_stock= $itemModel->current_quantity;
			$model->available_quantity_in_stock= $itemModel->available_quantity;
			$current_quantity_in_stock=$model->current_quantity_in_stock;
			$available_quantity_in_stock=$model->available_quantity_in_stock;
			
			//saving values to outbound 
			$model->main_item_id=$main_item_id;
			$model->available_quantity_in_stock=$available_quantity_in_stock;
			$model->current_quantity_in_stock=$current_quantity_in_stock;
			$model->quantity_moved=$quantity_moved;
			$model->comments="Via API / Mobile App";
			
			if($model->save())
			{
		 	
			
			}
			else 
			{
				$msg='';
				$errors=$model->getErrors();
				foreach ($errors as $e)
				{
					$msg.="-----".$e[0]; 
				}				

				$results = array ('results'=>$msg);
				$this->_sendResponse(400, CJSON::encode($results));
			}
		
		
		
 		}
		else
		{
			$msg='No Item found with id '.$main_item_id; 	
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		
	
		
		//updating items table.
		
		$itemModel->updateByPk(
								$model->main_item_id,
								array
								(
									'available_quantity'=>$itemModel->available_quantity-$model->quantity_moved,
									'current_quantity'=>$itemModel->current_quantity-$model->quantity_moved,
								)														
								);		
		//output in JSON
		if(is_null($model))
		      $this->_sendResponse(404, 'No Item found with id '.$main_item_id);
		else
		{
		     // $this->_sendResponse(200, CJSON::encode($_GET['model']));
		    $msg="Sucessfully Saved";
		  	$results = array ('results'=>$msg);
		   	$this->_sendResponse(200, CJSON::encode($results));
		}
		
    }//end of actionOutbound.
    
    public  function actionInbound()
    {
    	
    	if(isset($_POST['item_id']))
    		$main_item_id=$_POST['item_id'];
		else{
			$msg='Item id Missing ';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		
		
		if(isset($_POST['quantity_moved']))
    		$quantity_moved=$_POST['quantity_moved']; 
       	else{
			$msg='quantity moved id Missing ';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		
       
        if(isset($_POST['supplier_id']))
    		$supplier_id=$_POST['supplier_id'];
    	else{
			$msg='supplier id id Missing ';
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
		}
		
    	
    	
        $itemModel=Items::model()->findByPk($main_item_id);

		if ($itemModel)
		{
			
	    	$model=new InboundItemsHistory;
	    	
			$model->current_quantity_in_stock= $itemModel->current_quantity;
			$model->available_quantity_in_stock= $itemModel->available_quantity;
			$current_quantity_in_stock=$model->current_quantity_in_stock;
			$available_quantity_in_stock=$model->available_quantity_in_stock;


			$model->main_item_id=$main_item_id;
			$model->available_quantity_in_stock=$available_quantity_in_stock;
			$model->current_quantity_in_stock=$current_quantity_in_stock;
			$model->quantity_moved=$quantity_moved;
			$model->supplier_id=$supplier_id;
			$model->comments="Via API / Mobile App";

			if($model->save())
			{
				//echo "available_quantity_in_stock = ".$available_quantity_in_stock."current_quantity_in_stock = ".$current_quantity_in_stock;
			}
			else 
			{

				$msg='';
				//$msg.='ERROR:'.var_dump($model->getErrors());
				$errors=$model->getErrors();
				foreach ($errors as $e)
				{
					$msg.="-----".$e[0]; 
				}				

				$results = array ('results'=>$msg);
				$this->_sendResponse(400, CJSON::encode($results));
			}

		}
		else 
		{
		 	$msg='No Item found with id '.$main_item_id;
		 	
		 	$results = array ('results'=>$msg);
			$this->_sendResponse(400, CJSON::encode($results));
				
				
		}
		
		//saving values to inbound table 
		
		$itemModel->updateByPk(
								$model->main_item_id,
								array
								(
									'available_quantity'=>$itemModel->available_quantity+$model->quantity_moved,
									'current_quantity'=>$itemModel->current_quantity+$model->quantity_moved,
								)														
								);		
		//output in JSON
		if(is_null($model))
		      $this->_sendResponse(404, 'No Item found with id '.$main_item_id);
		else
		{
		     // $this->_sendResponse(200, CJSON::encode($_GET['model']));
		    $msg="Sucessfully Saved";
		  	$results = array ('results'=>$msg);
		   	$this->_sendResponse(200, CJSON::encode($results));
		}///end of else of if
		
    }//end of actionInbound.
    
    
    public function actionGetactivesupplierslist()
    {
    
 	   	$listdata = CHtml::listData(Suppliers::model()->findAll(array('condition' => 'active=1', 'order' => "`name` ASC")),'id', 'name' );
	    	
    	$alldata=array();	
    	foreach ($listdata as $key=>$value)
    	{
    		$each_record=array();
    		$each_record['supplier_id']=$key;
    		$each_record['supplier_name']=$value;
    		array_push($alldata,$each_record);
    	}
    	
    	$results = array ('results'=>$alldata);

    	$this->_sendResponse(200, CJSON::encode($results));
    }///ennd of public function actionGetactivesupplierslist()

    
    
    public function actionList()
    {
    }
    
    public function actionView()
    {
    }
    public function actionCreate()
    {
    }
    public function actionUpdate()
    {
    }
    public function actionDelete()
    {
    }
    
    
    
    
    
    
    
    
    
    
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
    	// set the status
    	$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    	header($status_header);
    	// and the content type
    	header('Content-type: ' . $content_type);
    
    	// pages with body are easy
    	if($body != '')
    	{
    		// send the body
    		echo $body;
    		exit;
    	}
    	// we need to create the body if none is passed
    	else
    	{
    		// create some body messages
    		$message = '';
    
    		// this is purely optional, but makes the pages a little nicer to read
    		// for your users.  Since you won't likely send a lot of different status codes,
    		// this also shouldn't be too ponderous to maintain
    		switch($status)
    		{
    		case 401:
    		$message = 'You must be authorized to view this page.';
    		break;
    		case 404:
    		$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
    		break;
    		case 500:
    		$message = 'The server encountered an error processing your request.';
    		break;
    		case 501:
    		$message = 'The requested method is not implemented.';
    		break;
    	}
    
    		// servers don't always have a signature turned on
    		// (this is an apache directive "ServerSignature On")
    		$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
    
    		// this should be templated in a real-world solution
    		$body = '
    		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    		<html>
    		<head>
    		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    		<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
    		</head>
    		<body>
    		<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    		<p>' . $message . '</p>
    		<hr />
    		<address>' . $signature . '</address>
    </body>
    </html>';
    
    echo $body;
    exit;
    }
    }///end of function send Response
    
    private function _getStatusCodeMessage($status)
    {
    	// these could be stored in a .ini file and loaded
    	// via parse_ini_file()... however, this will suffice
    	// for an example
    	$codes = Array(
    			200 => 'OK',
    			400 => 'Bad Request',
    			401 => 'Unauthorized',
    			402 => 'Payment Required',
    			403 => 'Forbidden',
    			404 => 'Not Found',
    			500 => 'Internal Server Error',
    			501 => 'Not Implemented',
    	);
    	return (isset($codes[$status])) ? $codes[$status] : '';
    }///end of function getStatusCodeMessages
    
 private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if(!(isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME']) and isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD']))) {
            // Error: Unauthorized
            
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME'];
        $password = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD'];
        // Find the user
        $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
        if($user===null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if(!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }//end of function checkAuth
    
    
 	public function formatdate($d)
	{
		if ($d != '' || $d != NULL)
			return date('d-M-Y', $d);
		else
			return '';
	}

	public function formatdatewithtime($d)
	{
		if ($d != '' || $d != NULL)
			return date('d-M-Y h:i A', $d);
		else
			return '';
	}

	public function formatonlytime($d)
	{
		if ($d != '' || $d != NULL)
			return date('H:i A', $d);
		else
			return '';
	}

    
    
}///end of class 