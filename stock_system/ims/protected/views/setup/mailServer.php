<?php 
include 'setup_sidemenu.php';
?>

<?php 
	
	$smtp_host = '';
	$smtp_username = '';
	$smtp_password = '';
	$smtp_encryption = '';
	$smtp_port = '';
	
	$root = dirname(dirname(dirname(__FILE__)));
	//echo $root."<br>";
	
	$filename = $root.'/config/mail_server.json';
	//echo "<br>file url = ".$filename;

	if(file_exists($filename))
	{
		//echo "File is present<br>";
		$data = file_get_contents($filename);
		$decodedata = json_decode($data, true);
		
		//echo "host = ".$result['smtp_host']."<br>";
			$smtp_host = $decodedata['smtp_host'];
			//echo "Username = ".$result['smtp_username']."<br>";
			$smtp_username = $decodedata['smtp_username'];
			//echo "Password = ".$result['smtp_password']."<br>";
			$smtp_password = $decodedata['smtp_password'];
			//echo "Encryption = ".$result['smtp_encryption']."<br>";
			$smtp_encryption = $decodedata['smtp_encryption'];
			//echo "Port = ".$result['smtp_port']."<br>";
			$smtp_port = $decodedata['smtp_port'];
		
	}//end of if file exists.
	else 
	{
		echo "File not found";
	}
	
?>



<script type="text/javascript">  
function getSelectedValue() 
{  
    var index = document.getElementById('server_encryption').selectedIndex;
    //alert("value="+document.getElementById('server_encryption').value); 
    document.getElementById('encryption');
    encryption.value = document.getElementById('server_encryption').value;
    //alert("text="+document.getElementById('server_encryption').options[index].text);  
}  

alert(val);
</script>  


<form action="<?php echo Yii::app()->createUrl('setup/mailSettings')?>" method="post">
	
	<b>Host</b><br><input type="text" name="host" value=<?php echo $smtp_host;?>><br>
	
	<b>User Name</b><br><input type="text" name="username" value=<?php echo $smtp_username;?>><br>
	
	<b>Password</b><br><input type="password" name="password" value=<?php echo $smtp_password;?>><br>
	
	<b>Encryption Type</b><br>
	
	
	<!--<select name="encryption" id="encryption" >
		<option value="<?php echo $smtp_encryption;?>"><?php echo $smtp_encryption;?></option>
		<option value="" >none</option>
		<option value="ssl">ssl</option>
		<option value="tls">tls</option>
	</select>
	-->
	<?php echo CHtml::dropDownList( 'encryption',$smtp_encryption,array(''=>'none','ssl'=>'ssl','tls'=>'tls')); ?>
	
	<br>
	<b>Port</b><br><input type="text" name="port" value=<?php echo $smtp_port;?>><br><br>
	
	<input name="mail_server_values"  type="submit" style="width:100px">
	
</form>	








