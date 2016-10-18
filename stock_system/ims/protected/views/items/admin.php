<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Itemss'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Itemss</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'selectableRows'=>1,
    'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/id/"+$.fn.yiiGridView.getSelection(id);}',

	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'item_id',
		//'company_id',
		'part_number',
		
		array(	'name'=>'name',
				'value' => 'CHtml::link($data->name, array("view&id=".$data->item_id))',
		 		'type'=>'raw',
        ),
		//'name',
		'description',
		'barcode',
		 //array('name'=>'stock_date', 'value'=>'$data->formatdate($data)'),
	
	
	 	
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"No":"Yes"',
				'filter'=>array('1'=>'Yes', '0'=>'No'),
		),
		
		
	 array(
	     	'header'=>'StockDate',
            'name' => 'stock_date',
            'value' => '(($data->stock_date)?date("d-M-Y",$data->stock_date):"")',
             'filter'=>false,
        ),
     	 array(
//	     	'header'=>'StockDate',
            'name' => 'purchase_date',
            'value' => '(($data->purchase_date)?date("d-M-Y",$data->purchase_date):"")',
            'filter'=>false,
        ),
		/*
		'location_room',
		'location_row',
		'location_column',
		'location_shelf',
		'category_id',
		'current_quantity',
		'available_quantity',
		'recommended_lowest_quantity',
		'recommended_highest_quantity',
		'remarks',
		'active',
		'image_url',
		'sale_price',
		'factory_due_date',
		'suppliers_id',
		'fits_in_model',
		'created',
		'modified',
		'deleted',
		'stock_date',
		'purchase_date',
		'unit_price',
		'vat_percentage',
		'vat_amount',
		'total_price_exc_vat',
		'total_price_inc_vat',
		'comments',
		*/
 		//'created',
     	 array(
	     	 
            'name' => 'created',
            'value' => '(($data->created)?date("d-M-Y",$data->created):"")',
             'filter'=>false,
        ),
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

