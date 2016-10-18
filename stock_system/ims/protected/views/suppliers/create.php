<?php
 

$this->menu=array(
	 
	array('label'=>'Manage Suppliers', 'url'=>array('admin')),
);
?>

<h1>Create Suppliers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>