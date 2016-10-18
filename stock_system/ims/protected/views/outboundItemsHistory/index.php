<?php
$this->breadcrumbs=array(
	'Outbound Items Histories',
);

$this->menu=array(
	//array('label'=>'Create OutboundItemsHistory', 'url'=>array('create')),
	array('label'=>'Manage Outbound Items History', 'url'=>array('admin')),
);
?>

<h1>Outbound Items Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
