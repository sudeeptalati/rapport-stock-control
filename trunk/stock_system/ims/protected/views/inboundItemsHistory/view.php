<?php
$this->breadcrumbs=array(
	'Inbound Items Histories'=>array('index'),
	$model->history_id_item,
);

$this->menu=array(
	array('label'=>'List Inbound Items History', 'url'=>array('index')),
//	array('label'=>'Create InboundItemsHistory', 'url'=>array('create')),
//	array('label'=>'Update InboundItemsHistory', 'url'=>array('update', 'id'=>$model->history_id_item)),
//	array('label'=>'Delete InboundItemsHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->history_id_item),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Inbound Items History', 'url'=>array('admin')),
);
?>

<h1>Inbound History # <?php echo $model->mainItem->part_number; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
// 		'history_id_item',
// 		'main_item_id',
		'mainItem.name',
		'mainItem.part_number',
		'quantity_moved',
		'current_quantity_in_stock',
		'available_quantity_in_stock',
		'comments',
		//'user_id',
		'user.username',
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

