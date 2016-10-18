<?php
 

$this->menu=array(
	array('label'=>'List Suppliers', 'url'=>array('admin')),
	array('label'=>'Create Suppliers', 'url'=>array('create')),
// 	array('label'=>'Update Suppliers', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete Suppliers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Suppliers', 'url'=>array('admin')),
);
?>

<h1>Supplier # <?php echo $model->id; ?></h1>
<h1>Supplier # <?php echo $model->name; ?></h1>
<div style="text-align: right;">
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'contact_person',
		'address',
		'town',

		'postcode',

		'country',
		'contact_number',
		'email',
		'website',
		'lead_time_days',
		'free_carriage_min_amt',
		'vat_reg_no',
		//'prefered_supplier',
		 array(
      		'label'=>'prefered_supplier',
      		'value'=>$model->prefered_supplier ? "Yes" : "No",
    	),	
// 		'logo_url',
// 		'api_url',
			array(
					'label'=>'active',
					'value'=>$model->active ? "Active" : "Inactive",
			),
			
		//'created',
		array(
				'label'=>'created',
				'value'=>date('d-M-Y', $model->created),
		),
		//'modified',
		array(
				'label'=>'modified',
				'value'=>date('d-M-Y', $model->modified),
		),
	),
)); ?>
