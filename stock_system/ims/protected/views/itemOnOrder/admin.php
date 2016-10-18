<?php
 ;

$this->menu=array(
	array('label'=>'List Item On Order', 'url'=>array('index')),
	//array('label'=>'Create ItemOnOrder', 'url'=>array('create')),
);

 
?>

<h1>Items On Orders</h1>
 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'item-on-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'purchase_order_id',
			//'order_status',
		//'suppliers_id',
		//'item_status',
		//'out_of_stock_factory_date',
			
//		array( 'name'=>'order_number', 'value'=>'$data->purchaseOrder->order_number'),
		array( 'name'=>'order_number',
					'type'=>'raw',
					'value'=>'CHtml::link($data->purchaseOrder->order_number,Yii::app()->createUrl("purchaseOrder/preview" , array("id"=>$data->purchase_order_id,)))',
			),
		array( 'name'=>'item_name', 'value'=>'$data->items->name'),
		array( 'name'=>'part_number', 'value'=>'$data->items->part_number'),
			//'order_status',
		
		array
		(
			'type'=>'html',
			'name'=>'item_status',
			'value'=>'$data->status->name',
			//'filter'=>false,
		),
			
//		array
//			(
//					'type'=>'html',
//					'name'=>'item_status',
//					'value'=>'$data->getItemStatus($data->item_status)',
//					'filter'=>false,
//			),

			array(  
				'name'=>'created',
				//'type'=>'datetime',
				'value'=>'date("d-M-Y",$data->created)',
				//	'filter'=>false,
			),
			/*
		array(
					'name'=>'item_status',
					'value'=>'Lookup::item("item_status",$data->getItemStatus($data->item_status))',
					'filter'=>Lookup::items('item_status'),
			),
		*/
		array( 'name'=>'supplier_name', 'value'=>'$data->suppliers->name'),
			array(
					'class'=>'CButtonColumn',
					'template'=>'{view}',
			),
			

		/*
		'factory_due_date',
		'quantity_ordered',
		'unit_price',
		'total_price',
		'created',
		
		array(
			'class'=>'CButtonColumn',
		),
		*/
	),
)); ?>
