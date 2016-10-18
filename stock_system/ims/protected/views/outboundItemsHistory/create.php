<?php
 

$this->menu=array(
	 
	array('label'=>'Show Previously Removed Items  (Outbound History)', 'url'=>array('admin')),
);
?>

<div style="float:right;"><h1>Remove Item from Stock # Outbound</h1></div>
<br><br><br>
  
  


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>