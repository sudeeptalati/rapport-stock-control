<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-on-order-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php 
/**COLLECTING THE DATA*/

$purchase_id=$_GET['po_id'];
$item_id=$_GET['item_id'];

$model->purchase_order_id=$purchase_id;
$model->items_id=$item_id;
//*SINCE FIRST STATUS OF ITEM IS DRAFT*//
$model->item_status=1;

/*THIS IS FOR THE CURRENT ITEMS Which is being added*/
$itemModel=Items::model()->findByPk($item_id);


$purchaseModel=PurchaseOrder::model()->findByPk($purchase_id);
/*THIS IS To get the items which are already orrderd**/
$items_on_order_model=PurchaseOrder::model()->getItemsOnOrder($purchase_id);






$model->suppliers_id=$purchaseModel->suppliers_id;
$model->unit_price=$itemModel->sale_price;

?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!-- FIRST PART OF THE FORM WHICH DISPLAYS PURCHASE ORDER DETAILS --> 
	
	<div class="row">
	<table>
	<tr>
		<td>		
		<?php echo $form->labelEx($purchaseModel,'order_number'); ?>
		<?php echo $form->textField($purchaseModel,'order_number', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($purchaseModel,'order_number'); ?>
		</td>
		<td>		
		<?php echo $form->labelEx($purchaseModel,'order_status'); ?>
		<?php
		$staus_code=$purchaseModel->order_status;
		$status_str=$purchaseModel->getOrderStatus($staus_code);
		echo $status_str;
		
		?>
		<?php //echo $form->textField($model,$status_str, array('disabled'=>'disabled')); ?>
		<?php echo $form->error($purchaseModel,'order_status'); ?>
		</td>
		<td>		
		<?php echo $form->labelEx($purchaseModel,'total_cost'); ?>
		<?php echo $form->textField($purchaseModel,'total_cost', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($purchaseModel,'total_cost'); ?>
		</td>
	</tr>
	<tr>
		<td colspan=3>		
		<?php echo $form->labelEx($purchaseModel,'suppliers_id'); ?>
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
		
	</tr>
	</table>
	</div>


<!-- SECOND PART OF FORM WHICH DISPLAYS THE DETAILS OF ORDERED ITEMS FROM item_on_order TABLE -->
	
	
	<div class="row">
	<table>
	<tr>
		<td colspan="5">Ordered Items</td>
		<tr>
		 <tr>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Quantity Ordered</th>
					<th>Unit Price</th>
					<th>Total Price</th>
					</tr>
					
		<?php
	
		foreach ($items_on_order_model as $ordered_items) 
		{
			/*$model id is current Model id*/
			if ($model->id==$ordered_items->id)
			{
				echo "<tr style='color:maroon;margin-left:20px;'>";
 			}//end of if
				else
				{
					echo "<tr>";
				}
	 			echo "<td>".$ordered_items->items->part_number."</td>";
	 			echo "<td>".$ordered_items->items->name."</td>";
	 			echo "<td>".$ordered_items->quantity_ordered."</td>";
	 			echo "<td>".$ordered_items->unit_price."</td>";
	 			echo "<td>".$ordered_items->total_price."</td>";

//	 			echo "<td>".$data->user->username."</td>";
//	 			echo "<td>".$data->created."</td>";

	 			echo "</tr>";
			
		}
	
		?>
		
	</table>
	</div>





<!-- THIS IS THE THIRD PART FOR  ADDING CURRENT ITEM -->
		
<!-- CURRENT ITEM DETAILS -->

	<div class="row">
		Item Being Added
	</div>
<table>
<tr>
	<td>
	<div class="row">
		<?php echo $form->labelEx($itemModel,'name'); ?>
		<?php echo $form->textField($itemModel,'name', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($itemModel,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($itemModel,'part_number'); ?>
		<?php echo $form->textField($itemModel,'part_number', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($itemModel,'part_number'); ?>
	</div>
	</td>
	<!--<div class="row">		
		<?php echo $form->labelEx($model,'item_status'); ?>
		<?php
		$staus_code=$model->item_status;
		$status_str=$model->getItemStatus($staus_code);
		echo $status_str;
		?>
		<?php //echo $form->textField($model,$status_str, array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'order_status'); ?>
	</div>
	
--><!-- CURRENT ITEM DETAILS  END-->		

	<div class="row">
		<?php //echo $form->labelEx($model,'purchase_order_id'); ?>
		<?php //echo $form->textField($model,'purchase_order_id'); ?>
		<?php echo $form->hiddenField($model,'purchase_order_id'); ?>
		<?php echo $form->error($model,'purchase_order_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'items_id'); ?>
		<?php //echo $form->textField($model,'items_id'); ?>
		<?php echo $form->hiddenField($model,'items_id'); ?>
		<?php echo $form->error($model,'items_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'suppliers_id'); ?>
		<?php //echo $form->textField($model,'suppliers_id'); ?>
		<?php echo $form->hiddenField($model,'suppliers_id'); ?>
		<?php echo $form->error($model,'suppliers_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'item_status'); ?>
		<?php //echo $form->textField($model,'item_status'); ?>
		<?php echo $form->hiddenField($model,'item_status'); ?>
		<?php echo $form->error($model,'item_status'); ?>
	</div>
	
	<td>
	<div class="row">
		<?php echo $form->labelEx($model,'quantity_ordered'); ?>
		<?php echo $form->textField($model,'quantity_ordered'); ?>
		<?php echo $form->error($model,'quantity_ordered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_price'); ?>
		<?php echo $form->textField($model,'unit_price'); ?>
		<?php echo $form->error($model,'unit_price'); ?>
	</div>
</td><td>
	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<small>(Comments will be visible to supplier)</small><br>
		
		<?php echo $form->textArea($model,'comments',array('rows'=>3, 'cols'=>20)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

<!-- 
	<div class="row">
		<?php //echo $form->labelEx($model,'out_of_stock_factory_date'); ?>
		<?php //echo $form->textField($model,'out_of_stock_factory_date'); ?>
		<?php //echo $form->error($model,'out_of_stock_factory_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'factory_due_date'); ?>
		<?php ///echo $form->textField($model,'factory_due_date'); ?>
		<?php //echo $form->error($model,'factory_due_date'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'total_price'); ?>
		<?php //echo $form->textField($model,'total_price'); ?>
		<?php //echo $form->error($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified'); ?>
	</div>
 -->
	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Update'); ?>
	</div>

	</td>
	
	</tr>
</table>
	
<?php $this->endWidget(); ?>

</div><!-- form -->