<?php

$this->menu=array(
	array('label'=>'View Added Items History', 'url'=>array('index')),
//	array('label'=>'Create InboundItemsHistory', 'url'=>array('create')),
//	array('label'=>'Update InboundItemsHistory', 'url'=>array('update', 'id'=>$model->history_id_item)),
//	array('label'=>'Delete InboundItemsHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->history_id_item),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Inbound Items History', 'url'=>array('admin')),
);
?>

<div style="float:left;"> <h1>Add Item to Stock # Inbound</h1></div>
<br>
<br>
<br>
<span style='font-size:x-large;'><?php echo $model->mainItem->name; ?> # <?php echo $model->mainItem->part_number; ?></span>
<br>
<br>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
// 		'history_id_item',
// 		'main_item_id',
//		'mainItem.name',
//		'mainItem.part_number',
		'quantity_moved',
		'current_quantity_in_stock',
		'available_quantity_in_stock',
		'comments',
		//'user_id',
//		'user.username'
//
//,
		array(  'name'=>'user_id',
			'value'=>$model->user->username,
		),

		array(  'name'=>'supplier_id',
			'value'=>$model->supplier->name,
		),

 
        array(  'name'=>'item_purchase_date',
 					'value'=>(Setup::model()->formatdate($model->item_purchase_date)),
 			),


		/*
            array(  'name'=>'items_on_order_id',
                    'value'=>$model->itemsOnOrder->purchaseOrder->order_number,
                ),
        */
			
		//'items_on_order_id',

		array(  'name'=>'created',
					'value'=>(date('d-M-Y H:i',$model->created)),
			),	),
)); ?>

<?php 

//for getting search in view.
//$im=new Items('search');
echo "<hr>";
?>

<h2> Add more Items </h2>
<?php 

echo $this->forward('/Items/inboundSearch',false);

?>

