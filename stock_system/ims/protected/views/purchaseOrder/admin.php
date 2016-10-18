<?php
 
$this->menu=array(
	//array('label'=>'List Purchase Order', 'url'=>array('index')),
	array('label'=>'Create Purchase Order', 'url'=>array('/suppliers/purchaseOrder')),
	array('label'=>'Add A New Suppliers', 'url'=>array('/suppliers/create')),
);
 
?>



<h1>Purchase Orders</h1>

 
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
		
	'columns'=>array(
		//'id',

		'order_number',
			
		array( 'name'=>'supplier_name',
				'type'=>'raw',
				'value'=>'CHtml::link($data->suppliers->name,Yii::app()->createUrl("purchaseOrder/preview" , array("id"=>$data->id,)))',
				),
	
		array( 'name'=>'user_name', 
				'header'=>'Raised By',
			   'value'=>'$data->user->username',
			 ),
	

	//'order_status',
	 
		 
	array(
			'name'=>'order_status',
			'value'=>'Status::item("Status",$data->order_status)',
			'filter'=>Status::items('Status'),
		),
		
	
		array(  
				'name'=>'date_of_order', 'value'=>'$data->date_of_order==null ? "":date("d-M-Y",$data->date_of_order)', 'filter'=>false
			),
			
			 
		array(  
				'name'=>'date_of_order_recieved','value'=>'$data->date_of_order_recieved==null ? "":date("d-M-Y",$data->date_of_order_recieved)', 'filter'=>false
			),
		
		
		
		/*
		'total_cost',
		'vat',
		'net_cost',
		'created',
		'modified',
		'cancelled',
		*/
		
		array(
		'class'=>'CButtonColumn',
		'template'=>'{update}',
		'buttons'=>array(
			'update'=>array(
					'url'=>'Yii::app()->createUrl("purchaseOrder/preview" , array("id"=>$data->id,))',
					),
				),
					),
					
	),
)); ?>
