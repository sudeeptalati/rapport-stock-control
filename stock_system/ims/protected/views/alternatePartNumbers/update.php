<?php
$this->breadcrumbs=array(
	'Alternate Part Numbers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AlternatePartNumbers', 'url'=>array('index')),
	array('label'=>'Create AlternatePartNumbers', 'url'=>array('create')),
	array('label'=>'View AlternatePartNumbers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AlternatePartNumbers', 'url'=>array('admin')),
);
?>

<h1>Update AlternatePartNumbers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>