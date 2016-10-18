<?php
// $this->breadcrumbs=array(
// 	'Setups'=>array('index'),
// 	$model->id,
// );
?>

<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Your Company Details</h1>

<div style="text-align:right; " ><b>
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?></b>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'company',
		'address',
		'town',
		'postcode',
// 		'postcode_s',
// 		'postcode_e',
		'county',
		'country',
		'email',
		'telephone',
		'mobile',
		'alternate',
		'fax',
		//'postcodeanywhere_account_code',
		//'postcodeanywhere_license_key',
		'website',
		'vat_reg_no',
		'company_number',
		//'custom5',
	),
)); ?>


<br>
 <table style="width:100%; padding:5px;background-color: #C7E8FD; border-radius: 15px; vertical-align: top;">
<tr>	
	<td colspan="2" style="vertical-align:top; text-align:left;">
	<h4 style="vertical-align:top; text-align:center; margin-bottom:11px;"><b>Preferred Settings</b></h4>
	
	The following settings should be used to get the best results from the application. The application have been tested under following conditions.</td>
</tr>
<tr>
	<td style="vertical-align:top;"><b>Browser</b></td>
	<td style="vertical-align :top;"><a href="http://www.google.com/intl/en_uk/chrome/browser/" target="_blank" >Google Chrome </a></td>
</tr>
<tr>
	<td style="vertical-align:top;"><b>Pop Ups</b></td>
	<td style="vertical-align :top;">No Pop up Blocker should be installed on browser. The app have several instances when user is notified through alert box. The pop up blocker also blocks the alert box.</td>
</tr>
<tr>
	<td style="vertical-align:top;"><b>Java Script</b></td>
	<td style="vertical-align :top;">No Java Script should be installed. The app uses java script.</td>
</tr>
<tr>
	<td style="vertical-align:top;"><b>Internet Connection</b></td>
	<td style="vertical-align :top;">The app is designed to work perfectly with as well as without internet. However for the features like email notification, sms notification, remote call booking alerts, the system need to have internet connection.</td>
</tr>

</table>
