<?php
 
$this->menu=array(
	 
	array('label'=>'Create Suppliers', 'url'=>array('create')),
);

 
?>
<h1>Suppliers List</h1>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'suppliers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'address',
		'town',
		'postcode',

	//	'country',
        array(
      		'name'=>'prefered_supplier',
      		//'value'=>'$data->prefered_supplier == 1 ? "Yes" : "No"',
      		//'value'=>'$data->prefered_supplier ? \'Yes\':\'No\'',
      		'value'=>'$data->prefered_supplier ? "Yes" : "No"',
      		//'value' => '$data->prefered_supplier == 0 ? "No" : "Yes"',
    		'type'=>'text',
    	),
	   array(
      		'name'=>'active',
      		//'value'=>'$data->prefered_supplier == 1 ? "Yes" : "No"',
      		//'value'=>'$data->prefered_supplier ? \'Yes\':\'No\'',
      		'value'=>'$data->active ? "Active" : "Inactive"',
      		//'value' => '$data->prefered_supplier == 0 ? "No" : "Yes"',
    		'type'=>'text',
    	),
		/*
		'contact_number',
		'email',
		'website',
		'lead_time_days',
		'free_carriage_min_amt',
		'vat_reg_no',
		'prefered_supplier',
		'created',
		'modified',
		*/
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}	{update}',
		),
	),
)); ?>
