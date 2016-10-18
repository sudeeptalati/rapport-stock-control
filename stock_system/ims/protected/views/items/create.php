<?php
 

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>

<h1>Add New Items</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>