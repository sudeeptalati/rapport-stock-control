<?php
$this->breadcrumbs=array(
	'Alternate Part Numbers',
);

$this->menu=array(
	array('label'=>'Create AlternatePartNumbers', 'url'=>array('create')),
	array('label'=>'Manage AlternatePartNumbers', 'url'=>array('admin')),
);
?>

<h1>Alternate Part Numbers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
