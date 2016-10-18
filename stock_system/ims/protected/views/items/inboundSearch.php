<?php 
  
  $this->menu=array(
	array('label'=>'Show Previously Added Items  (Inbound History)', 'url'=>array('/InboundItemsHistory/admin')),
);
  
  ?>
  

<div style="float:left;"><h1>Add Item to Stock # Inbound</h1></div>
<br><br><br>
  
  
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div> <!--search-form -->

<div style="font-size:x-large;;">Select Items from following. Click <?php $add_img_url=Yii::app()->request->baseUrl.'/images/add.png'; 
					echo CHtml::image($add_img_url,"ballpop",array("width"=>"20", "height"=>"20")); 
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
		'current_quantity',
		'available_quantity',
			
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{add_quantity}',
		    'buttons'=>array
		    (
		        'add_quantity' => array
		        (
		            'label'=>'Add this Item in Stock',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/add.png',
		        	//'click'=>'function(){alert("Adding to stock!");}',
		            //'url'=>'Yii::app()->createUrl("inboundItem/create", array("id"=>$data->id))',
		            'url'=>'Yii::app()->createUrl("inboundItemsHistory/create" , array("main_item_id"=>$data->item_id,))',
		        ),
		        
		    ),
		)
	),
	
)); ?>
  