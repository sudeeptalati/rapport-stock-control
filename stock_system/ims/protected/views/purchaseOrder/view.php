<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Purchase Order', 'url'=>array('index')),
	array('label'=>'Create Purchase Order', 'url'=>array('create')),
	array('label'=>'Update Purchase Order', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Purchase Order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Purchase Order', 'url'=>array('admin')),
);
?>

<h1>View PurchaseOrder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'suppliers_id',
		'suppliers.name',
		//'user_id',
		'user.username',
		'order_number',
		'order_status',
		'date_of_order',
		'total_cost',
		'vat',
		'net_cost',
		array(  'name'=>'created',
					'value'=>(date('d-M-Y H:i',$model->created)),
			),
		'modified',
		'cancelled',
	),
)); ?>
