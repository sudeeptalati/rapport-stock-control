<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Google Charts-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php
		$setupModel = Setup::model()->findByPk(1);
		
	?>
</head>

<body>
<?php
$company_logo=Yii::app()->request->baseUrl."/images/company_logo.png";

$rapport_stock_logo=Yii::app()->request->baseUrl."/images/rapport_stock_logo.png";

?>

<div class="container" id="page">
	
	<table><tr>
		<td style="margin:20px; vertical-align:middle;" ><div id="logo" ><a href="<?php echo Yii::app()->request->baseUrl;?>"><?php echo $setupModel->company; ?></a><br><small>Stock System</small></div></td>
		<td style="margin:20px; text-align:right;" >
		<a href="<?php echo Yii::app()->request->baseUrl;?>">
		<?php echo CHtml::image($company_logo,"ballpop",array("width"=>"200", "height"=>"75"));?> </a>
	</td>
	</tr>
	</table>
	
	<div style="text-align: center;
font-weight: bold;
float: right;
width: 150px;
background-color: #FFFFFF;
height: 20px;
border-radius: 10px;">
	
	<?php 
		if(Yii::app()->user->isGuest) {
				echo CHtml::link( 'Login' ,array('/site/login')); 
     
			} else {
				echo CHtml::link( 'Logout ('.Yii::app()->user->name.')' ,array('/site/logout')); 
		
			}
			
		?>
		
	</div>
	<br><br>
	
	<div id="header">
		</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Items', 'url'=>array('/items/freeSearch/')),
				//array('label'=>'Inbound', 'url'=>array('/items/inboundSearch')),
				//array('label'=>'Outbound', 'url'=>array('/items/outboundSearch')),
				//array('label'=>'Purchase Order', 'url'=>array('/purchaseOrder/admin')),
				//array('label'=>'ItemsOnOrder', 'url'=>array('/itemOnOrder/admin')),
				//array('label'=>'Suppliers', 'url'=>array('/suppliers/admin')),
				//array('label'=>'My Account', 'url'=>array('/userGroups/admin')),
				//array('label'=>'Login', 'url'=>array('/userGroups'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'My Account', 'url'=>array('/user/'.Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Set Up', 'url'=>array('/setup/view&id=1')),
				array('label'=>'Back Up', 'url'=>array('/site/backup'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Mobile', 'url'=>array('setup/otherdevices')),
				
				//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				
				),
				
		)); ?>
	</div><!-- mainmenu -->

	<div id='submenu' style="text-align:center">
		<?php
		
			$addons_list=Addons::model()->findAll(array('condition'=>'active=1'));
			foreach ($addons_list as $addon)
			{	
			 echo "<li>";
			 
				echo CHtml::link($addon->addon_label,array('/'.$addon->name)); 
				echo "</li>";
			
			}
		
		?>
	
	</div>
	
	
	
	
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
	
	<table><tr><td>
	<a href="<?php echo Yii::app()->request->baseUrl;?>">
		
		
		<?php echo CHtml::image($rapport_stock_logo,"ballpop", array("width"=>"170", "height"=>"56.6")); ?>

	</a></td>
	<td style="text-align:right;">
		Copyright &copy; <?php echo date('Y'); ?> by UK Whitegoods Ltd.<br/>
		All Rights Reserved. <br>Version <?php echo Yii::app()->params['software_version'];?><br/>
		System Designed by 
			<a href="mailto:sudeep.talati@gmail.com">Sudeep Talati</a>, 
		  	<a href="mailto:kruthika.bethur@gmail.com">Kruthika Bethur</a>
		  	&amp; Team

			
	</td></tr></table>
</div><!-- footer -->
</div><!-- page -->
 

</body>
</html>