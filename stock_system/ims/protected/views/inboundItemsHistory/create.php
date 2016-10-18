<?php
 

$this->menu=array(
	 
	array('label'=>'Show Previously Added Items  (Inbound History)', 'url'=>array('admin')),
);
?>

<div style="float:left;"><h1>Add Item to Stock # Inbound</h1></div>
<br><br><br>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>