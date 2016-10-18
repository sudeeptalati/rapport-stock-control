<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inbound-items-history-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'main_item_id'); ?>
		<?php //echo $model->main_item_id;  ?>	
		<?php echo $form->hiddenField($model,'main_item_id'); ?>
		
		<?php echo CHtml::label('Item Name','item-id');?>
		<?php 	$item_id=$model->main_item_id;  
			$itemModel=Items::model()->findByPk($item_id);
			if ($itemModel){
				echo "<span style='font-size:x-large;'>";
				echo $itemModel->name;
				echo "</span><br><br>";
				
				echo CHtml::label('Part Number','partnumber-id');
				echo "<span style='font-size:x-large;'>";
				echo $itemModel->part_number;
				echo "</span>";
				
				$model->current_quantity_in_stock= $itemModel->current_quantity;
				$model->available_quantity_in_stock= $itemModel->available_quantity;
			}
			else
				echo "Item not found";
			
	?>
	
	
		<?php echo $form->error($model,'main_item_id'); ?>
	</div>
	


		<table>
			<tr>
				<td>
				<?php echo $form->labelEx($model,'current_quantity_in_stock'); ?>
				<?php echo $form->hiddenField($model,'current_quantity_in_stock'); ?>
				<?php 
					echo "<span style='font-size:x-large;'>";
					echo $itemModel->current_quantity; 
					echo "</span>";	
				?>
				<?php echo $form->error($model,'current_quantity_in_stock'); ?>
					
				</td><td>
					
					
				<?php echo $form->labelEx($model,'available_quantity_in_stock'); ?>
				<?php echo $form->hiddenField($model,'available_quantity_in_stock'); ?>
				<?php 
					echo "<span style='font-size:x-large;'>";
					echo $itemModel->available_quantity; 
					echo "</span>";	
				?>
				<?php echo $form->error($model,'available_quantity_in_stock'); ?>
				</td>
			</tr>
		</table>





	<table style="width: 50%">
		<tr>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'supplier_id'); ?>
					<?php echo CHtml::activeDropDownList($model, 'supplier_id', Suppliers::model()->getactivesupplierslist()); ?>
					<?php echo $form->error($model,'supplier_id'); ?>
				</div>
			</td>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model, 'item_purchase_date'); ?>
					<?php

					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name' => CHtml::activeName($model, 'item_purchase_date'),
						'model' => $model,
						'value' => $model->attributes['item_purchase_date'],
						// additional javascript options for the date picker plugin
						'options' => array(
							'showAnim' => 'fold',
							'dateFormat' => 'dd-mm-yy',
						),
						'htmlOptions' => array(
							'style' => 'height:20px;',
							'readonly' => 'true',
						),
					));
					?>

					<?php echo $form->error($model, 'item_purchase_date'); ?>
				</div>
			</td>
		</tr>
	</table>









	<div class="row">
		<?php echo $form->labelEx($model,'quantity_moved'); ?>
		<?php echo $form->textField($model,'quantity_moved'); ?>
		<?php echo $form->error($model,'quantity_moved'); ?>
	</div>


	<table>
		<td>
			<?php echo $form->labelEx($model, 'unit_price_exc_vat'); ?>
			<?php echo $form->textField($model, 'unit_price_exc_vat'); ?>
			<?php echo $form->error($model, 'unit_price_exc_vat'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($model, 'unit_price_inc_vat'); ?>
			<?php echo $form->textField($model, 'unit_price_inc_vat', array('readonly' => 'true','style'=>"background-color:#EFEFEF;" )); ?>
			<?php echo $form->error($model, 'unit_price_inc_vat'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($model, 'vat_percentage'); ?>
			<?php echo $form->dropDownList($model, 'vat_percentage', array('20' => '20% (Standard VAT)', '0' => '0%'), array('onchange' => 'calculateprices()')); ?>
			<?php echo $form->error($model, 'vat_percentage'); ?>
		</td>

		<td>
			<?php echo $form->labelEx($model, 'vat_amount'); ?>
			<?php echo $form->textField($model, 'vat_amount', array('readonly' => 'true','style'=>"background-color:#EFEFEF;" )); ?>
			<?php echo $form->error($model, 'vat_amount'); ?>
		</td>
		</tr>
		<tr>
		<td>
			<?php echo $form->labelEx($model, 'total_amount_exc_vat'); ?>
			<?php echo $form->textField($model, 'total_amount_exc_vat', array('readonly' => 'true', 'style'=>"background-color:#EFEFEF;")); ?>
			<?php echo $form->error($model, 'total_amount_exc_vat'); ?>

		</td>
		<td>
			<?php echo $form->labelEx($model, 'total_amount_inc_vat'); ?>
			<?php echo $form->textField($model, 'total_amount_inc_vat', array('readonly' => 'true', 'style'=>"background-color:#EFEFEF;")); ?>
			<?php echo $form->error($model, 'total_amount_inc_vat'); ?>

		</td>
	</table>




	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>







	<!--<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'items_on_order_id'); ?>
		<?php echo $form->textField($model,'items_on_order_id'); ?>
		<?php echo $form->error($model,'items_on_order_id'); ?>
	</div>

	--><!--<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add Items' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



<script type="text/javascript">


	$(document).ready(function () {

		$("#InboundItemsHistory_quantity_moved").keyup(function () {
			calculateprices();

		});//end of keyup function.

		$("#InboundItemsHistory_unit_price_exc_vat").keyup(function () {
			calculateprices();

		});//end of keyup function.


	});//end of ready function.


	function calculateprices() {

		console.log('calculating Prices........');
		var unit_price = $("#InboundItemsHistory_unit_price_exc_vat").val();
		var vat_percentage = $("#InboundItemsHistory_vat_percentage").val();

		var current_quantity = $("#InboundItemsHistory_quantity_moved").val();


		var vat_on_unit_price = (unit_price * vat_percentage) / 100;
		$("#InboundItemsHistory_vat_amount").val(vat_on_unit_price);

		var total_price_exc_vat = '';
		var total_price_inc_vat = '';

		var sale_price_inc_vat = parseFloat(unit_price) + parseFloat(vat_on_unit_price);

		$("#InboundItemsHistory_unit_price_inc_vat").val(sale_price_inc_vat);

		var total_price_exc_vat = parseFloat(unit_price) * parseFloat(current_quantity);
		var total_price_inc_vat = parseFloat(sale_price_inc_vat) * parseFloat(current_quantity);

		$("#InboundItemsHistory_total_amount_exc_vat").val(unit_price * current_quantity);
		$("#InboundItemsHistory_total_amount_inc_vat").val(sale_price_inc_vat * current_quantity);


		console.log('Value is ' + unit_price);
		console.log('VAT is ' + vat_percentage);
		console.log('VAT ON unit price ' + vat_on_unit_price);


	}///end of  function calculatevat()


</script>