<?php
 

$this->menu=array(
	 
	array('label'=>'Remove Items from Stock (Outbound)', 'url'=>array('/items/outboundSearch')),
);
?>

<div style="float:right;"><h1>Remove Item from Stock # Outbound</h1></div>
<br><br>
  
  

 

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'outbound-items-history-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'history_id_item',
		//'main_item_id',
 		array( 'name'=>'part_number', 'value'=>'$data->mainItem->part_number' ),
 		array( 'name'=>'item_search', 'value'=>'$data->mainItem->name' ),
		'quantity_moved',
		'current_quantity_in_stock',
		'available_quantity_in_stock',
		'comments',
		//'created',
		array('name'=>'created','value'=>'date("d-M-Y",$data->created)'),
		//'user_id',
		array( 'name'=>'username', 'value'=>'$data->user->username' ),
		
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