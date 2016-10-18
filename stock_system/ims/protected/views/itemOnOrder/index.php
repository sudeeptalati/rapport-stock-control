<?php
$this->breadcrumbs=array(
	'Item On Orders',
);

$this->menu=array(
	//array('label'=>'Create ItemOnOrder', 'url'=>array('create')),
	array('label'=>'Manage Item On Order', 'url'=>array('admin')),
);
?>

<h1>Item On Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
