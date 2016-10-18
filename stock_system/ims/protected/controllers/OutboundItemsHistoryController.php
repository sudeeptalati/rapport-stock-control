<?php

class OutboundItemsHistoryController extends Controller
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
				'actions'=>array('create','update','admin','index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
	public function actionCreate($main_item_id)
	{
		$model=new OutboundItemsHistory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->main_item_id=$main_item_id;
		
		if(isset($_POST['OutboundItemsHistory']))
		{
			$model->attributes=$_POST['OutboundItemsHistory'];
			if($model->save())
			{
			$available_quantity=$model->available_quantity_in_stock-$model->quantity_moved;
			$current_quantity=$model->current_quantity_in_stock-$model->quantity_moved;
			//$q_moved=$model->quantity_moved;
			$itemModel = Items::model()->updateByPk(
													$model->main_item_id,
													array
														(
														'available_quantity'=>$available_quantity+$model->quantity_moved,
														'current_quantity'=>$current_quantity+$model->quantity_moved
														)														
														);		
					
			
			//if($model->save())
				$this->redirect(array('view','id'=>$model->history_id_item));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
		
		/*original
		if(isset($_POST['OutboundItemsHistory']))
		{
			$model->attributes=$_POST['OutboundItemsHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->history_id_item));
		}

		$this->render('create',array(
			'model'=>$model,
		));*/
	}//end of create().

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

		if(isset($_POST['OutboundItemsHistory']))
		{
			$model->attributes=$_POST['OutboundItemsHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->history_id_item));
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
		$dataProvider=new CActiveDataProvider('OutboundItemsHistory');
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
		$model=new OutboundItemsHistory('search');
		$model->unsetAttributes();  // clear any default values
		
		//for excel.
		
		if( isset( $_GET[ 'export' ] ) )
        {
            header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
            header( "Content-Disposition: inline; filename=\"Outbound Items History ".date("F j, Y").".xls\"" );

                        $dataProvider = $model->search();
                        $dataProvider->pagination = False;
            //$itemModel=Items::model()->findByPk($item_id);
            ?>
            <table border="1"> <tr>
			<th>History_id_item</th>
			<th>Part number</th>
			<th>Item name</th>
			<th>Quantity_moved</th>
			<th>Current_quantity_in_stock</th>
			<th>User Name</th>
			<th>created</th>
			</tr>
            <?php 
            //echo "history_id_item \t main_item_id \t quantity_moved \t current_quantity_in_stock \t created \n";
			foreach( $dataProvider->data as $data )
			{
				echo "<tr>";
	 			echo "<td>".$data->history_id_item."</td>";
	 			echo "<td>".$data->mainItem->part_number;
	 			echo "<td>".$data->mainItem->name."</td>";
	 			echo "<td>".$data->quantity_moved."</td>";
	 			echo "<td>".$data->current_quantity_in_stock."</td>";
	 			echo "<td>".$data->user->username."</td>";
	 			echo "<td>".$data->created."</td>";
				echo "</tr>";
			
				//echo $data->history_id_item , "\t", $data->mainItem->name, "\t", $data->quantity_moved, "\t", $data->current_quantity_in_stock, "\t", $data->created, "\n";
			}//end of foreach().
		?>
		</table>
		<?php 
			
			Yii::app()->end();
		}//end of if(isset())
		
		if(isset($_GET['OutboundItemsHistory']))
			$model->attributes=$_GET['OutboundItemsHistory'];

		$this->render('admin',array(
			'model'=>$model,
		));
		
		
		
		/*original.
		$model=new OutboundItemsHistory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OutboundItemsHistory']))
			$model->attributes=$_GET['OutboundItemsHistory'];

		$this->render('admin',array(
			'model'=>$model,
		));*/
	}//end of admin.

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=OutboundItemsHistory::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='outbound-items-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
