 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>Advanced Items Import </h1>

<div id="submenu">   
<li><?php echo CHtml::link('Simple Items Import',array('simpleitemsimport')); ?></li>
<li><?php echo CHtml::link('Advance Items Import',array('itemsimport')); ?></li>
</div>
 
<?php
$actionpath=Yii::app()->getBaseUrl()."/index.php?r=Import/csvuploadandimport";
//echo $actionpath;
$csv_image=Yii::app()->request->baseUrl."/images/csvexport.jpg";
?>
<form name="import_data_form" enctype="multipart/form-data" action="<?php echo $actionpath; ?>" method="POST" onsubmit="return validateForm()" >
Choose a file to upload: <input name="uploadedfile" id="uploadedfile" type="file" /><br />

<input type="submit" value="Import Now	" />
	


</form>

<script>
function validateForm() {
    var x = document.forms["import_data_form"]["uploadedfile"].value;
    if (x==null || x=="") {
        alert("Please Choose File first and then click on Import ");
        return false;
    }
	
	var fup = document.getElementById('uploadedfile');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	
	if(ext == "csv")
	{
		return true;
	}	 
	else
	{
		alert("Please Upload a Valid CSV file");
		fup.focus();
		return false;	
	}
	
	
	
}///end of functiuon validatefoem
</script>





<br><br><br>
<p style="font-size: 30px;"><font color='green'  > Note: This is advanced import routine. Please make sure the uploaded file should be same as the sample file.<br>
</font></p>





 <br>
 <b>Sample CSV file</b>
<?php
$download_img_html= CHtml::image($csv_image,"csvexport",array("width"=>"30", "height"=>"35"));
$download_img_link=CHtml::link('Download','uploads/sample_import_file.csv');


?>


<table  style="width:10%">
	<tr>
		<td>
			<?php echo CHtml::link($download_img_html,'uploads/sample_import_file.csv'); ?>
		</td>
		<td></td>
	</tr>
	<tr>
		<td>
			<?php echo $download_img_link; ?>
		</td>
		<td>
			<a id='show_csv_format_title' href='#' onclick="show_csv_format()" > Show  </a>
			<a id='hide_csv_format_title' href='#' onclick="hide_csv_format()" style="display:none;" > Hide  </a>
		</td>
	</tr>
</table>



<script>
function show_csv_format() {
   
   document.getElementById('csv_format').style.display = "block";
   document.getElementById('show_csv_format_title').style.display = "none";
   document.getElementById('hide_csv_format_title').style.display = "block";
   
}

function hide_csv_format() {
   document.getElementById('csv_format').style.display = "none";
   document.getElementById('hide_csv_format_title').style.display = "none";
   document.getElementById('show_csv_format_title').style.display = "block";
   
}


</script> 

 
 
 <style>
 
 .tt {
		border:1px solid black;
		width:10%;

}

</style>


<div id="csv_format" style="display:none;">
 <?php
 echo "<table class='tt'>";
		$file_handle = fopen("uploads/sample_import_file.csv","r");
		$i=0;
		//while loop
		while (!feof($file_handle) ) {
		echo "<tr>";
		$line_of_text = fgetcsv($file_handle, 1024);
		echo  "<td  class='tt'>".$line_of_text[0]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[1]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[2]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[3]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[4]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[5]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[6]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[7]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[8]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[9]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[10]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[11]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[12]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[13]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[14]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[15]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[16]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[17]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[18]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[19]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[20]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[21]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[22]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[23]. "</td>";
		echo  "<td  class='tt'>".$line_of_text[24]. "</td>";
		
		
		
		
		
		
		$i++;
		echo "</tr>";
		}////end of while (!feof($file_handle) )

		fclose($file_handle);

echo "</table>";
		

		?>
 
 

 
</div>



