<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Your Company Details</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>