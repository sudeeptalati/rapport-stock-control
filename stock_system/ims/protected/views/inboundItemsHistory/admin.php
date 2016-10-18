<?php
 

$this->menu=array(
	array('label'=>'Add Items to Stock (Inbound)', 'url'=>array('/items/inboundSearch')),
	//array('label'=>'Create InboundItemsHistory', 'url'=>array('create')),
);
 ?>
 

<div style="float:left;"><h1>Add Item to Stock # Inbound</h1></div>

<br><br>
 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inbound-items-history-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'history_id_item',
		//'main_item_id',
		array( 'name'=>'part_number', 'value'=>'$data->mainItem->part_number' ),
		array( 'name'=>'item_search', 'value'=>'$data->mainItem->name' ),
		array( 'name'=>'barcode', 'value'=>'$data->mainItem->barcode' ),

		'quantity_moved',
		'current_quantity_in_stock',
		'available_quantity_in_stock',
		
// 		array(
// 					'name'=>'comments',
// 					'type'=>'html',
// 					'value'=>'$data->comments',
// 			),

		array( 'name'=>'user_id', 'value'=>'$data->user->name','filter'=>false ),
		array( 'name'=>'supplier_id', 'value'=>'$data->supplier->name','filter'=>false ),

		array(
				'name'=>'created','value'=>'date("d-M-Y",$data->created)','filter'=>false
			),	
			
		/*
		'user_id',
		'items_on_order_id',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php echo CHtml::submitButton( 'Export to excel', array( 'name' => 'export' ) ); ?>
<?php $this->endWidget(); ?>