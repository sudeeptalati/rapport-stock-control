<?php
$this->breadcrumbs=array(
	'Inbound Items Histories'=>array('index'),
	$model->history_id_item=>array('view','id'=>$model->history_id_item),
	'Update',
);

$this->menu=array(
	array('label'=>'List InboundItemsHistory', 'url'=>array('index')),
	array('label'=>'Create InboundItemsHistory', 'url'=>array('create')),
	array('label'=>'View InboundItemsHistory', 'url'=>array('view', 'id'=>$model->history_id_item)),
	array('label'=>'Manage InboundItemsHistory', 'url'=>array('admin')),
);
?>

<h1>Update InboundItemsHistory <?php echo $model->history_id_item; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>