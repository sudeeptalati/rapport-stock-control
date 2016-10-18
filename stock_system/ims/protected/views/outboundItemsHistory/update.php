<?php
$this->breadcrumbs=array(
	'Outbound Items Histories'=>array('index'),
	$model->history_id_item=>array('view','id'=>$model->history_id_item),
	'Update',
);

$this->menu=array(
	array('label'=>'List OutboundItemsHistory', 'url'=>array('index')),
	array('label'=>'Create OutboundItemsHistory', 'url'=>array('create')),
	array('label'=>'View OutboundItemsHistory', 'url'=>array('view', 'id'=>$model->history_id_item)),
	array('label'=>'Manage OutboundItemsHistory', 'url'=>array('admin')),
);
?>

<h1>Update OutboundItemsHistory <?php echo $model->history_id_item; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>