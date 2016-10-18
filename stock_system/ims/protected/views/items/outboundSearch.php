
<?php

$this->menu=array(
	array('label'=>'Show Previously Removed Items  (Outbound History)', 'url'=>array('/OutboundItemsHistory/admin')),
);
?>

 
<div style="float:right;"><h1>Remove Item from Stock # Outbound</h1></div>
<br><br><br>
  
  
  
 

<div style="font-size:x-large;;">Select Items from following. Click <?php $remove_img_url=Yii::app()->request->baseUrl.'/images/remove.png'; 
					echo CHtml::image($remove_img_url,"ballpop",array("width"=>"20", "height"=>"20")); 
				?> 
	to add items in stock.</div>
	 You can search by any of the following fields	
	
<?php $this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'item_id',
		'part_number',
		'name',
		'description',
		'barcode',
		'available_quantity',
		'current_quantity',

		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{add_quantity}',
		    'buttons'=>array
		    (
		        'add_quantity' => array
		        (
		            'label'=>'This Item is removed from Stock',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/remove.png',
		        	//'click'=>'function(){alert("Adding to stock!");}',
		            //'url'=>'Yii::app()->createUrl("inboundItem/create", array("id"=>$data->id))',
		            //'url'=>'Yii::app()->createUrl("outboundItemsHistory/create")',
		            'url'=>'Yii::app()->createUrl("outboundItemsHistory/create" , array("main_item_id"=>$data->item_id,))',
		        ),
		        
		    ),
		)
		),
	)); 
?>	