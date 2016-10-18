<?php
$this->breadcrumbs=array(
	'Inbound Items Histories',
);

$this->menu=array(
	//array('label'=>'Create Inbound Items History', 'url'=>array('create')),
	array('label'=>'Manage Inbound Items History', 'url'=>array('admin')),
);
?>

<h1>Inbound Items Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
