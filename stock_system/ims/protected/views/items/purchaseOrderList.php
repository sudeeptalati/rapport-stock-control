<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
);
/*original
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('items-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/

//for excel.
Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});

$('#submit-button').click(function(){ 
        $.fn.yiiGridView.update('some-grid', {
                data: $('.search-form form').serialize()
        });
        return false;
});
				");

?>





<?php 
$po_id=$_GET['id'];
/*
echo $po_id;
echo "---<br><br>";
*/
?>
	
<b>Start adding Items to Purchase Order</b	>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'item_id',
	 	array(            
            'name'=>'available_quantity',
	 	 	'type'=>'html',
            'value'=>array($this,'gridStatusColumn'), 
        ),
		//'company_id',
		'part_number',
		'name',
		//'description',
		//'barcode',
		'location_room',
		'location_row',
		'location_column',
		'location_shelf',
		//'suppliers_id',
		'current_quantity',
		'available_quantity',

	//	array( 'name'=>'supplier_name', 'value'=>'$data->suppliers->name' ),
	/*	
		array(
            'name'=>'available_quantity',
            'type'=>'raw',
            'value'=>'Items::model()->statusBarang($data->item_id)',
        ),
      */  
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{add_item_to_order_list}',
		    'buttons'=>array
		    (
		        'add_item_to_order_list' => array
		        (
		            'label'=>'Add this Item to Order List',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/add.png',
		        	//'click'=>'function(){alert("Adding to stock!");}',
		            //'url'=>'Yii::app()->createUrl("inboundItem/create", array("id"=>$data->id))',
		            'url'=>'Yii::app()->createUrl("itemOnOrder/create" , array("item_id"=>$data->item_id,"po_id"=>'.$po_id.',))',
		        ),
		        
		    ),
		),
	),
)); 


?>
