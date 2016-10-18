<?php
$this->breadcrumbs=array(
	'Alternate Part Numbers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AlternatePartNumbers', 'url'=>array('index')),
	array('label'=>'Create AlternatePartNumbers', 'url'=>array('create')),
	array('label'=>'Update AlternatePartNumbers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AlternatePartNumbers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AlternatePartNumbers', 'url'=>array('admin')),
);
?>

<h1>View AlternatePartNumbers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'main_item_id',
		'alternate_item_id',
	),
)); ?>
