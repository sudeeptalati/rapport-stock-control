<?php 	
	$this->layout=false;
	
	header('Content-type: application/json');
	
	$secret_key=Setup::model()->getsecretkey();
	$results = array ('results'=>$secret_key);
	
	echo CJSON::encode($results);
	//$json_file=CJSON::encode($model);
		
	Yii::app()->end();

	
	
	
	
?>
	