<div id="sidemenu">
<?php include ('setup_sidemenu.php');?>
</div>

<?php 
	


$setupModel = Setup::model()->findByPk(1);
//$request='http://rapportsoftware.co.uk/versions';
$update_url = $setupModel->version_update_url;
$request = $update_url.'/latest_stocksystem_version.txt';
//echo "<br>request = ".$request;
	
$available_version = curl_file_get_contents($request, true);
$current_version=Yii::app()->params['software_version'];
?>


<table style="width:40%;">
<tr>
	<td style="vertical-align:top;"><h4>Version</h4></td>
	<td style="vertical-align :top;"><?php echo Yii::app()->params['software_version'];?></td>
	<td style="vertical-align :top;">
	<?php 
		if($available_version!=$current_version)
		{
			$step = 1;
			
			//echo "Please delete all contents of update directory";
			echo CHtml::button('Update',array('submit'=>'index.php?r=/Setup/showUpdateProgress&curr_step='.$step));
			//echo CHtml::button('Update',array($this->showUpdateProgress($step)));
			//echo CHtml::button('Update',array('submit'=>$configModel->showProgress($step)));
		}
	?>
	</td>
</tr>
<tr>
	<td style="vertical-align:top;"><h4>Support</h4></td>
	<td style="vertical-align :top;"><a href="http://rapportsoftware.co.uk/index.php/support" target="_blank" >Online</a> support desk and knowledgebase</td>
</tr>
<tr>
	<td style="vertical-align:top;"><h4>Tutorials</h4></td>
	<td style="vertical-align :top;"><a href="http://rapportsoftware.co.uk/index.php/instructions" target="_blank" >Help tutorials</a>  on installation and use.</td>
</tr>
<tr>
	<td style="vertical-align:top;"><h4>Forums</h4></td>
	<td style="vertical-align :top;"><a href="http://www.ukwhitegoods.co.uk/forumsphpbb3/forum59/" target="_blank" >Forums </a>available for whitegoods engineers (trade access required).</td>

</tr>
<tr>
	<td style="vertical-align:top;"><h4>Designed by</h4></td>
	<td style="vertical-align :top;">			Sudeep Talati, 
		  	Kruthika Bethur &amp; Team</td>
</tr>

</table>






<?php

function curl_file_get_contents($request)
{
$curl_req = curl_init($request);

curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

$contents = curl_exec($curl_req);

curl_close($curl_req);

return $contents;
}///end of functn curl File get contents
?>