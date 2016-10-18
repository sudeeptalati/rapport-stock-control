
<?php 	
	$this->layout=false;
	header('Content-type: application/json');
	?>

<?php
	
	$results = array ('results'=>$model);
	echo CJSON::encode($results);
	
	
	//echo $model;
	
	$json_file=CJSON::encode($model);
	Yii::app()->end();

	
?>
	