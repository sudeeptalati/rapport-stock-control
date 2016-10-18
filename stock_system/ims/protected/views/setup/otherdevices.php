
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



 

<h1>Mobile and Other Devices</h1>

	<p class="note">
	If you want to access this rapport system from other devices like mobile phone, tablet or other PC, 
	open a new browser and point to the following url.
	</p>
	
	<div style="background: #EFEFEF;font-size: 20px;padding: 16px;color: #555555;" class="portlet-content">
		<?php

$host= $_SERVER['SERVER_NAME'];
$ip = gethostbyname($host);
//echo "Server IP is: <b>{$host}</b>"; 
//echo "<br>Server IP is: <b>{$ip}</b>"; 


			echo 'To access this stock system from other devices enter 	address : <br><br><b>http://' . $ip.''.Yii::app()->request->baseUrl.'/index.php</b><br> (Interanlly in Local WIFI network)<br><br> OR <br>';

			echo 'To access this stock system from other devices enter address : <br><br><b>http://' . $host.''.Yii::app()->request->baseUrl.'/index.php</b><br>(Over the internet- Additional Router setup may require)';
			/*
			$indicesServer = array('PHP_SELF', 
'argv', 
'argc', 
'GATEWAY_INTERFACE', 
'SERVER_ADDR', 
'SERVER_NAME', 
'SERVER_SOFTWARE', 
'SERVER_PROTOCOL', 
'REQUEST_METHOD', 
'REQUEST_TIME', 
'REQUEST_TIME_FLOAT', 
'QUERY_STRING', 
'DOCUMENT_ROOT', 
'HTTP_ACCEPT', 
'HTTP_ACCEPT_CHARSET', 
'HTTP_ACCEPT_ENCODING', 
'HTTP_ACCEPT_LANGUAGE', 
'HTTP_CONNECTION', 
'HTTP_HOST', 
'HTTP_REFERER', 
'HTTP_USER_AGENT', 
'HTTPS', 
'REMOTE_ADDR', 
'REMOTE_HOST', 
'REMOTE_PORT', 
'REMOTE_USER', 
'REDIRECT_REMOTE_USER', 
'SCRIPT_FILENAME', 
'SERVER_ADMIN', 
'SERVER_PORT', 
'SERVER_SIGNATURE', 
'PATH_TRANSLATED', 
'SCRIPT_NAME', 
'REQUEST_URI', 
'PHP_AUTH_DIGEST', 
'PHP_AUTH_USER', 
'PHP_AUTH_PW', 
'AUTH_TYPE', 
'PATH_INFO', 
'ORIG_PATH_INFO') ; 

echo '<table cellpadding="10">' ; 
foreach ($indicesServer as $arg) { 
    if (isset($_SERVER[$arg])) { 
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
    } 
    else { 
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
    } 
} 
echo '</table>' ; 

*/
			 
			?>
		
	</div>
	<div style="background: #EFEFEF;font-size: 20px;padding: 16px;color: #555555;" class="portlet-content">
		Your secret key: <b><?php echo Setup::model()->getsecretkey(); ?></b>	
	</div>	
	<small>
	<p class="note">Conditions:<br>
	1. All Devices should be in same Wi-Fi network. Specially the Mobile phones and tablets are connected through WIFI and not 3G.<br>
	2. Check if firewall is not blocking this connection with other device. Check the firewall settings of the the current machine and routers.<br>
	</small></p>
 
	<table>
	<tr>
	<td>
		<img src="<?php echo Yii::app()->request->baseUrl.'/images/otherdevices.png';?>" width="350" height="250"/>
	</td>
	<td>
	<a href="https://itunes.apple.com/us/app/rapport-stock-inventory-management/id1162119789?mt=8" target="_blank">
		<img src="<?php echo Yii::app()->request->baseUrl.'/images/app-store-icon.png';?>" width="240" height="120"/>
	</a>
	</td>
		
	</tr>
	</table>
	
		
		
		
