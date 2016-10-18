 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
<h1>View User #<?php echo $model->name; ?></h1>
<div id="submenu">   
<li> <?php echo CHtml::link('Manage Users',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New User',array('create')); ?></li>
</div>

<div style="text-align: right;">
<b>
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</b>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
	//	'password',
		'email',
		'profile',
		array('name'=>'created','value'=>date("d-M-Y",$model->created)),
		array('name'=>'modified','value'=>date("d-M-Y",$model->modified)),
	),
)); ?>
