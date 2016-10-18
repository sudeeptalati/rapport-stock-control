<?php
$this->breadcrumbs=array(
	'Alternate Part Numbers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AlternatePartNumbers', 'url'=>array('index')),
	array('label'=>'Manage AlternatePartNumbers', 'url'=>array('admin')),
);
?>

<h1>Create AlternatePartNumbers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>