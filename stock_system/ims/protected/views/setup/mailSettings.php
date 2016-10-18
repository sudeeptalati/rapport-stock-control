<?php 
include 'setup_sidemenu.php';
?><div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-mailSettings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	
	<?php 
	
	if	(isset($_POST['mail_server_values']))
	{
		$smtp_host = $_POST['host'];
		//echo $smtp_host."<br>";
		$smtp_username =  $_POST['username'];
		//echo $smtp_username."<br>";
		$smtp_password = $_POST['password'];
		//echo $smtp_password."<br>";
		$smtp_encryption =  $_POST['encryption'];
		//echo $smtp_encryption."<br>";
		$smtp_port = $_POST['port'];
		//echo $smtp_port."<br>";
	}//end of if isset().
	
	?>
	
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo "<b>Host</b><br>";?>
		<?php echo CHtml::textField('',$smtp_host, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>User Name</b><br>";?>
		<?php echo CHtml::textField('',$smtp_username, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Password</b><br>";?>
		<?php echo CHtml::textField('',$smtp_password, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Encryption</b><br>";?>
		<?php echo CHtml::textField('',$smtp_encryption, array('disabled'=>'disabled'));?>
	</div>

	<div class="row">
		<?php echo "<b>Port</b><br>";?>
		<?php echo CHtml::textField('',$smtp_port, array('disabled'=>'disabled'));?>
	</div>

<div class="row">
		<a href="<?php echo Yii::app()->request->baseUrl."/index.php?r=setup/mailServer";?>">
		 <?php echo CHtml::button('Edit', array('button' => '')); ?><a>
		
		</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->

<!-- ***** SAVING VALUES TO JSON FILE ********* -->

<?php 

	$root = dirname(dirname(dirname(__FILE__)));
	//echo $root."<br>";
	$filename = $root.'/config/mail_server.json';
	
	if(file_exists($filename))
	{
		//echo "File is present<br>";
		
		$data = file_get_contents($filename);
		$decodedata = json_decode($data, true);
		//echo $decodedata;
		//echo "Username = ".$decodedata['smtp_username']."<br>";
		$decodedata['smtp_host'] = $smtp_host;
		//echo "new user name = ".$decodedata['smtp_username']."<br>";
		$decodedata['smtp_username'] = $smtp_username;
		$decodedata['smtp_password'] = $smtp_password;
		$decodedata['smtp_encryption'] = $smtp_encryption;
		$decodedata['smtp_port'] = $smtp_port;
		//echo json_encode($decodedata);
		$fh = fopen($filename, 'w');
		fwrite($fh, json_encode($decodedata));
		fclose($fh);

	}//end of if file present.
	else 
	{
		echo "file not present";
	}

?>


<!-- ***** END OF SAVING VALUES TO JSON FILE ********* -->
