<?php
$this->breadcrumbs=array(
	'Item On Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ItemOnOrder', 'url'=>array('index')),
	array('label'=>'Manage ItemOnOrder', 'url'=>array('admin')),
);
?>

<h1>Create ItemOnOrder</h1>

<?php

			$model->items_id=$_GET['item_id'];
			$model->purchase_order_id=$_GET['po_id'];
			/*
			echo $model->items_id."<br>";
			echo $model->purchase_order_id;
			*/
			$item_check_sql = "SELECT COUNT(*) FROM item_on_order  WHERE items_id==".$model->items_id." AND purchase_order_id==".$model->purchase_order_id;
			$results = Yii::app()->db->createCommand($item_check_sql)->queryScalar();

			if($results!=0)
			{
				$ordered_item_id = "SELECT items_id FROM item_on_order  WHERE items_id==".$model->items_id." AND purchase_order_id==".$model->purchase_order_id;
				$ordered_item_id = Yii::app()->db->createCommand($ordered_item_id)->queryScalar();
	
				$url='/PurchaseOrder/preview/'.$model->purchase_order_id.'?ordered_item_id='.$ordered_item_id;
				$this->redirect(array($url));
				
				//$this->redirect(array('/PurchaseOrder/preview','id'=>$model->purchase_order_id));
			}//end if if(results).
			else {
					echo $this->renderPartial('_form', array('model'=>$model)); 
				}

?>