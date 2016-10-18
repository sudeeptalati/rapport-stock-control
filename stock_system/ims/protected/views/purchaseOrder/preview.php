
<?php

$this->menu=array(
	array('label'=>'Manage Purchase Order', 'url'=>array('/PurchaseOrder/admin')),
);



?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-order-form',
	'enableAjaxValidation'=>false,
)); ?>
 
	 

	<?php echo $form->errorSummary($model); ?>
	
		
	
	
	<?php 
	/*DECLARING all models first*/
	
	$purchase_id=$model->id;
	//echo $purchase_id;
	
	//$purchase_order_id=$purchase_id;
	$items_on_order_model=$model->getItemsOnOrder($purchase_id);
	//echo "Item id from itemOnOrder : ".$items_on_order_model->items_id;


	$taxable_amount=$model->total_cost+$model->shipping_cost;
	$vat_percentage=Yii::app()->params['vat_in_percentage'];
	$model->vat=($taxable_amount*$vat_percentage)/100;
	
	$model->net_cost=$model->vat+$model->total_cost+$model->shipping_cost;
	$net_cost=$model->net_cost;

	$free_carriage=$model->suppliers->free_carriage_min_amt;
	if ($net_cost>$free_carriage)
	{
		//echo $free_carriage;
		$model->shipping_cost='0.0';		
	}
	
	?>
	
	<!-- FIRST PART OF THE FORM WHICH DISPLAYS PURCHASE ORDER DETAILS --> 
	
	<div class="row">
	<table>
	<tr>
		<td>		
		<?php echo $form->labelEx($model,'order_number'); ?>
		<?php echo $form->textField($model,'order_number', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'order_number'); ?>
		</td>
		
		<td>		
		<?php echo $form->labelEx($model,'order_status'); ?>
		<?php
		$staus_code=$model->order_status;
		$status_str=$model->getOrderStatus($staus_code);
		echo $status_str;
		?>
		<?php //echo $form->textField($model,$status_str, array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'order_status'); ?>
		</td>
		
		<td>		
		<?php echo $form->labelEx($model,'net_cost'); ?>
		<?php echo $form->textField($model,'net_cost', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'net_cost'); ?>
		</td>
	</tr>
	<tr>
		<td>		
		<?php echo $form->labelEx($model,'suppliers_id'); ?>
		<?php 	
			$supplier_id=$model->suppliers_id;  
			$supplierModel=Suppliers::model()->findByPk($supplier_id);
			if ($supplierModel)
			{
				echo $form->textField($supplierModel,'name', array('disabled'=>'disabled')); 
			}
			else
				echo "supplier not found";
			
		?>
		<?php //echo $form->textField($model,'supplier_name', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'suppliers_id'); ?>
		</td>
		<td>
			<b><?php 
					if ($model->order_status==1)
						echo 'Created By';
					else
						echo 'Send By';
			
				?>
			</b>
			<br>
			<?php echo $model->user->name;?>
		</td>
		<td>
		<?php 				echo $form->labelEx($supplierModel,'free_carriage_min_amt', array('disabled'=>'disabled'));
				echo $form->textField($supplierModel,'free_carriage_min_amt', array('disabled'=>'disabled'));
		?>
		</td>
	</tr>
	</table>
	</div>
	<!-- SECOND PART OF FORM WHICH DISPLAYS THE DETAILS OF ORDERED ITEMS FROM item_on_order TABLE -->
	
	
	<div class="row">
	<table>
	<tr>
		<td colspan="5">Ordered Items</td>
		</tr>
		 <tr>
					<th>Sr. No.</th>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total</th>
					<th>Actions</th>
					</tr>
					
		<?php
		$i=1;
		foreach ($items_on_order_model as $ordered_items) 
		{
			$item_ordered_id=0;
			
			if (!empty($_GET['ordered_item_id']))
			{
				$item_ordered_id=$_GET['ordered_item_id'];
			}
			
			///echo $item_ordered_id;
				if ($item_ordered_id==$ordered_items->items_id)
				{	?><tr style='color: maroon;margin-left:20px;'>
					<td colspan=7>
					<small>This item is already added, you can update the quantity or delete it</small>
					</td>
					
					
					<?php 
					echo "<tr style='color:maroon;margin-left:20px;'>";
 				}//end of if
				else
				{
					echo "<tr>";
				}
				echo "<td>".$i."</td>";
	 			echo "<td>".$ordered_items->items->part_number."</td>";
	 			echo "<td>".$ordered_items->items->name."</td>";
	 			echo "<td>".$ordered_items->quantity_ordered."</td>";
	 			echo "<td>".$ordered_items->unit_price."</td>";
	 			echo "<td>".$ordered_items->total_price."</td>";
	 			echo "<td>";
	 			$item_on_order_id=$ordered_items->id;
	 			$item_id=$ordered_items->items_id;
	 			$po_id=$ordered_items->purchase_order_id;
	 			$append_url=$item_on_order_id.'?item_id='.$item_id.'&po_id='.$po_id;
				
	 			$update_image_url=Yii::app()->request->baseUrl.'/images/update.png';
	 			$imghtml=CHtml::image($update_image_url,'Update');
	 			echo CHtml::link($imghtml,array('itemOnOrder/update/'.$append_url));
	 			
	 			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	 			
	 			
	 			$delete_image_url=Yii::app()->request->baseUrl.'/images/delete.png';
	 			$deletehtml=CHtml::image($delete_image_url,'Update');
	 			//echo CHtml::link($deletehtml,array('itemOnOrder/previewDelete/'.$append_url));
	 			
	 			
	 			
	 			$del_url=Yii::app()->request->baseUrl.'/itemOnOrder/previewDelete/'.$append_url;
	 			//echo CHtml::link($deletehtml,array('itemOnOrder/delete/'.$append_url));
	 			//echo CHtml::link($deletehtml,array('submit'=>array('delete','id'=>$items_on_order_model->id),'confirm'=>'Are you sure you want to delete this item?'.$append_url));
	 			//echo CHtml::link($deletehtml,array('itemOnOrder/delete/','id'=>$items_on_order_model->id));
	 			?>
	 			
	 			
					<a href="<?php echo $del_url; ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo $delete_image_url?>" /></a> 
	 			<?php 
	 			echo "</td>";
			echo "</tr>";
		$i++;		
		}///end of for each
	
		?>
		
	</tr>
	
	
	<tr>
		<th colspan="5" style="text-align: right"><?php echo $form->labelEx($model,'total_cost'); ?></th>
		<td colspan="2" ><?php 	echo $form->textField($model,'total_cost', array('disabled'=>'disabled'));
					echo $form->error($model,'total_cost'); ?>
		 </td>
	</tr>
	<tr>
		<th colspan="5" style="text-align: right"><?php echo $form->labelEx($model,'shipping_cost'); ?></th>
		<td colspan="2" ><?php echo $form->textField($model,'shipping_cost');
							   echo $form->error($model,'shipping_cost');
		?></td>
	</tr>

	<tr>
		<th colspan="5" style="text-align: right"><?php echo "VAT @ ".$vat_percentage."%"; ?></th>
		<td colspan="2"><?php 	echo $form->textField($model,'vat', array('disabled'=>'disabled'));
					echo $form->error($model,'vat'); ?>
	 </td>
	</tr>
	<tr>
		<th colspan="5" style="text-align: right"><?php echo $form->labelEx($model,'net_cost'); ?></th>
		<td colspan="2"><?php 	echo $form->textField($model,'net_cost', array('disabled'=>'disabled'));
					echo $form->error($model,'net_cost'); ?>
	 </td>
	</tr>
	
	
	</table>
	
	
	<div>
	<h4>Summary</h4>
	Total Order Value : <b><?php echo $model->total_cost;?></b>
	<br>
	</div>
	
		<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Finalise Order'); ?>
	</div>
	
<?php $this->endWidget(); ?>
	
	</div>
	
	<!-- THIRD PART OF FORM WHICH DISPLAYS ADMIN VIEW OF ITEMS -->
	<hr>

	<?php 
		echo $this->forward('/Items/purchaseOrderList',false); 
	?>
	

</div> 