
<?php

class ImportController extends Controller
{

	public $layout='//layouts/column2';


	public function actionItemsimport()
	{
		$this->render('itemsimport');
	}//end of action import.	
	
	
	public function actionCsvuploadandimport()
	{
	/*
	echo "****************";
	echo "<hr>";
	echo $_FILES["uploadedfile"]["type"];
	echo "<br>";
	echo $_FILES["uploadedfile"]["name"];
	echo "<br>";
	echo $_FILES["uploadedfile"]["error"];
	echo "<br>";

	echo "<hr>";
	*/
	if (isset($_FILES['uploadedfile']['name']))
	{
		$info = pathinfo($_FILES['uploadedfile']['name']);
		if ($info["extension"] == "csv")
		{

			$mimes = array('text/csv', 'application/csv', 'text/comma-separated-values', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'application/octet-stream', 'application/txt', 'text/tsv');
			if (in_array($_FILES['uploadedfile']['type'], $mimes))
			{
			//	echo "<br> This is a CSV file<br>";
			$filepath = $this->uploadfile($_FILES);
			//	$this->readmycsvfile($filepath);
			$this->render('csvuploadandimport',array('filepath'=>$filepath));
			}else
			{
				echo "<br> This is not a Valid CSV File. Please Upload a Valid CSV file<br>";
			}
		}//end if if ($info["extension"] == "csv")
		else
			{
				echo "This is not a CSV file";
			}
	}///end of if (isset($_FILES['uploadedfile']['name']))
	else
	{
		$this->redirect(array('import/itemsimport'));
	}

}///end of action csvupload



public function uploadfile($tempfile)
{
//echo "---------------";
	$target_path = "temp/". basename( $tempfile['uploadedfile']['name']);

	if(move_uploaded_file($tempfile['uploadedfile']['tmp_name'], $target_path))
	{
		//echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded<BR>";
		return $target_path;
	
	} 
	else
	{
					echo "There was an error uploading the file, please try again!";
	}
	
	
	
	
}//END OF FUNCTION UPLAOD LFILR



public function readmycsvfile($filepath)
{
$file = fopen($filepath,"r");

while(! feof($file))
{
  print_r(fgetcsv($file));
}

fclose($file);

}//////////////end of function readfile


 
public function actionSimpleitemsimport()
{
	$this->render('simpleitemsimport');
}	 


public function actionProcesssimpleitemsimport()
{

 

	 
	if (isset($_FILES['uploadedfile']['name']))
	{
		$info = pathinfo($_FILES['uploadedfile']['name']);
		if ($info["extension"] == "csv")
		{
			$mimes = array('text/csv', 'application/csv', 'text/comma-separated-values', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'application/octet-stream', 'application/txt', 'text/tsv');
			if (in_array($_FILES['uploadedfile']['type'], $mimes))
			{
			//	echo "<br> This is a CSV file<br>";
			$filepath = $this->uploadfile($_FILES);
			//	$this->readmycsvfile($filepath);
			$this->render('processsimpleitemsimport',array('filepath'=>$filepath));
			}else
			{
				echo "<br> This is not a Valid CSV File. Please Upload a Valid CSV file<br>";
			}
		}//end if if ($info["extension"] == "csv")
		else
			{
				echo "This is not a CSV file";
			}
	}///end of if (isset($_FILES['uploadedfile']['name']))
	else
	{
		$this->redirect(array('import/itemsimport'));
	}
	


	}///end of actionProcesssimpleitemsimport()

	
	
	
	
	
	

}///end of class


?>