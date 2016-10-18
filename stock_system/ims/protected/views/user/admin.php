<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 

<h1>Manage Users</h1>
<div id="submenu">   
<li> <?php echo CHtml::link('Manage Users',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New User',array('create')); ?></li>
</div>


 





<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/id/"+$.fn.yiiGridView.getSelection(id);}',

	'columns'=>array(
		//'id',
		'name',
			'username',
		'email',
		'profile',
		array('name'=>'created','value'=>'date("d-M-Y",$data->created)'),
		/*
		'password',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
