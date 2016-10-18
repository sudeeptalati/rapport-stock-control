<?php 


echo "<hr>";

echo $_FILES["uploadedfile"]["type"];
echo "<br>";
echo $_FILES["uploadedfile"]["name"];
echo "<br>";
echo $_FILES["uploadedfile"]["error"];
echo "<br>";



echo "<hr>";

$info = pathinfo($_FILES['uploadedfile']['name']);
if ($info["extension"] == "csv")
{

	$mimes = array('text/csv', 'application/csv', 'text/comma-separated-values', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'application/octet-stream', 'application/txt', 'text/tsv');
	if (in_array($_FILES['uploadedfile']['type'], $mimes))
	{
		echo "<br> This is a CSV file<br>";
		$filepath = uploadfile($_FILES);
		readmycsvfile($filepath);
		
		
		
	}else
	{
		echo "<br> Nai hUa<br>";

	}
	
	
}
else
{

echo "Not a CSV Extension";

}






function uploadfile($_FILES)
{
echo "---------------";
	$target_path = "uploads/". basename( $_FILES['uploadedfile']['name']);

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
	{
		echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";
		return $target_path;
	
	} 
	else
	{
					echo "There was an error uploading the file, please try again!";
	}
	
	
	
	
}//END OF FUNCTION UPLAOD LFILR



function readmycsvfile($filepath)
{
$file = fopen($filepath,"r");

while(! feof($file))
{
  print_r(fgetcsv($file));
}

fclose($file);

}//////////////end of function readfile






?>

<a href='uploadfile.php'>BACK</a>