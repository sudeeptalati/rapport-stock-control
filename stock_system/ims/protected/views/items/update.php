<?php
 

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	//array('label'=>'View Items', 'url'=>array('view', 'id'=>$model->item_id)),
	//array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>

<h1>Update Items <?php echo $model->item_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>