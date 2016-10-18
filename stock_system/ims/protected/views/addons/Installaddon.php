
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Uninstalling Addon</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage',array('admin')); ?></li>
<li><?php echo CHtml::link('Install',array('index')); ?></li>
</div><?php
$actionpath=Yii::app()->getBaseUrl()."/index.php?r=setup/Installaddon";
//echo $actionpath;
?>
<form enctype="multipart/form-data" action="<?php echo $actionpath; ?>" method="POST">
Choose a file to upload: <input name="uploadedfile" type="file" /><br />

<input type="submit" value="Upload File" /><br><br><br>

</form>