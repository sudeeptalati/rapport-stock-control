<?php
$this->breadcrumbs=array(
	'Item On Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Item On Order', 'url'=>array('index')),
	//array('label'=>'Create ItemOnOrder', 'url'=>array('create')),
//	array('label'=>'View Item On Order', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Item On Order', 'url'=>array('admin')),
);
?>

<h1>Update ItemOnOrder <?php echo $model->id; ?></h1>





<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>