<?php
 

$this->menu=array(
	 
	array('label'=>'Show Previously Removed Items  (Outbound History)', 'url'=>array('admin')),
);
?>

<div style="float:right;"><h1>Remove Item from Stock # Outbound</h1></div>
<br><br><br>
  
  
<span style='font-size:x-large;'><?php echo $model->mainItem->name; ?> # <?php echo $model->mainItem->part_number; ?></span>
<br>
<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'history_id_item',
	//	'main_item_id',
		//'mainItem.name',
		//'mainItem.part_number',
		'quantity_moved',
		'current_quantity_in_stock',
		'available_quantity_in_stock',
		'comments',
		//'user_id',
		//'user.username',
		array(  'name'=>'user_id',
				'value'=>$model->user->username,	
			),
		array(  'name'=>'created',
					'value'=>(date('d-M-Y H:i',$model->created)),
			),
	),
));
//for getting search in view.  
 
//$model1=OutboundItemsHistory::model();
//echo "<br>";
//echo $this->renderPartial('admin',array('model'=>$model1));

echo "<br>";
echo "<br>";

?>

<h2> Remove more Items </h2>

<?php 
echo $this->forward('/Items/outboundSearch',false); 

?>
