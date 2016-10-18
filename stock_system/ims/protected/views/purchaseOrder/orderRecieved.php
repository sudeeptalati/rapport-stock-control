
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
<!-- 
	<p class="note">Fields with <span class="required">*</span> are required.</p>
 -->
	<?php echo $form->errorSummary($model); ?>
	<?php 
	/*DECLARING all models first*/
	
	$purchase_id=$model->id;
	//echo $purchase_id;
	
	//$purchase_order_id=$purchase_id;
	$items_on_order_model=$model->getItemsOnOrder($purchase_id);
	//echo "Item id from itemOnOrder : ".$items_on_order_model->items_id;
	$vat_percentage=Yii::app()->params['vat_in_percentage'];
	
	
	
	?>

	<?php 
		$url=Yii::app()->getBaseUrl().'/purchaseOrder/preview/'.$purchase_id	;
		echo CHtml::link('Back',$url);
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
//		$status_code=$model->order_status;
//		echo $status_code;
		echo $model->status->name;
//		echo $model->getOrderStatus($status_code);
		  
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
			<b>Recieved By</b><br>
			<?php echo $model->user->name;?>
		</td>
		<td>
		<b>Recieved On</b><br>
		<?php
		$received_date = date('d-M-Y', $model->date_of_order_recieved); 
		//echo $form->textField($model, $received_date, array('disabled'=>'disabled', 'size'=>'22'));
		echo CHtml::textField('', $received_date, array('disabled'=>'disabled', 'size'=>'22')); 

		?>
		</td>
		
	</tr>
	</table>
	</div>
	<?php $this->endWidget(); ?>
	
	<!-- SECOND PART OF FORM WHICH DISPLAYS THE DETAILS OF ORDERED ITEMS FROM item_on_order TABLE -->
	
	
	<div class="row">
	<table style="vertical-align:top;" >
	<tr>
		<td colspan="5" style="color:#0066CC;"><b>Ordered Items</b></td>
		</tr>
		 <tr>
					<th>Status</th>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Ordered</th>
					<th>Recieved</th>
					<th colspan="2">Action</th>
					</tr>
					
		<?php
		$i=1;
		foreach ($items_on_order_model as $ordered_items) 
		{
			
			///echo $item_ordered_id;
			if ($ordered_items->quantity_recieved>$ordered_items->quantity_ordered)
			{	?><tr style='color: maroon;margin-left:20px;'>
			<td colspan=7>
			<small>Quantity Recieved is more than ordered</small>
			</td>
			
			<?php
			echo "<tr style='color:maroon;margin-left:20px;'>";
			}//end of if
			else
			{
			echo "<tr>";
			}
			?>
				
				<?php 	//		$item_status_code=$ordered_items->item_status;
//								$item_status=ItemOnOrder::model()->getItemStatus($item_status_code);
//								echo $item_status;
//								echo "<br>";
								?>
				<td><?php echo $ordered_items->status->name; ?></td>			
				<td><?php echo $ordered_items->items->part_number; ?></td>
	 			<td><?php echo $ordered_items->items->name; ?></td>
	 			<td><?php echo $ordered_items->quantity_ordered; ?></td>
	 			<td><?php echo $ordered_items->quantity_recieved; ?></td>
	 			<td>

	 			<?php 
	 			$item_on_order_id=$ordered_items->id;
	 			
	 			//echo $item_on_order_id;
	 			$item_status_code=$ordered_items->item_status;
	 			
	 			/*THIS ITEM MODEL IS FOR THE FORM OF EACH ROW*/
	 			$item_model=PurchaseOrder::model()->getItemOnOrder($item_on_order_id);
				if ($item_status_code==3 || $item_status_code>=10 )
				{
					$item_status=ItemOnOrder::model()->getItemStatus($item_status_code);
					
					echo $item_status;
					if ($model->order_status<10)//i.e. if order is complete, this will not be visible
						{
						$reset_url=Yii::app()->baseUrl.'/ItemOnOrder/updateStatus/'.$item_on_order_id.'?item_status=2&purchase_id='.$purchase_id.'&comments='.$ordered_items->comments;
						echo '<b>'.CHtml::link('Reset',$reset_url).'</b><br>';
						}
					echo "</td>";
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

					
				//	echo "<td style='vertical-align:top;'>".$ordered_items->comments."</td>";
					
				}//end of if of item status code
				else{
					
				$url="/ItemOnOrder/updateStatus/".$item_on_order_id;
				$action_url=$this->createUrl($url);
				
				$item_form=$this->beginWidget('CActiveForm', array(
						'id'=>'items_on_order_form',
						'enableAjaxValidation'=>false,
						'action'=>$action_url,
						'method'=>'post',
				));
				
				
				
				if (empty($item_model->quantity_recieved))
				{
					$item_model->ordered_recieved_difference=$ordered_items->quantity_ordered;
					$ordered_items->quantity_recieved='0.0';
				}
				else
				{
					$diff=$ordered_items->quantity_ordered-$ordered_items->quantity_recieved;
					$item_model->ordered_recieved_difference=$diff;
				}
				
				$status = array('3'=>'Received', '6'=>'Damaged');
				//echo $ordered_items->item_status;
				?>
				<?php 
				echo $item_form->TextField($item_model,'ordered_recieved_difference');				

				echo $item_form->dropDownList($item_model,'item_status',$status);
				echo $item_form->labelEx($item_model,'comments');
				echo $item_form->TextArea($item_model,'comments',array('rows'=>1, 'cols'=>28));			
				?>
				<br>
								
				<input type="hidden" name='purchase_id' value='<?php echo $purchase_id;?>' 	/>
				<input type="submit" name='items_on_order_form_update' value='Save ' 	/>
				
				<?php
				$this->endWidget(); //end of form
				}//end of else
				?>
				
			</td>
			<td>
			<?php
					if ($item_model->item_status>3 && $model->order_status<10  )//i.e. if order is complete, this will not be visible
					{
						$cancel_url=Yii::app()->baseUrl.'/ItemOnOrder/CancelItems/'.$item_on_order_id;
						echo '<b>'.CHtml::link('Cancel Remaining Items ',$cancel_url).'</b>';
					}
	 		?></td>
	 		</tr>
	 		<tr><td colspan="7"><small><?php echo $item_model->comments.'<hr>';?></small></td>
	 		
	 		</tr>
	 		
			<?php 
	 		$i++;		
		}///end of for each
		?>

		
	<tr>
		<td colspan="7">
		<?php $all_recieved_url=Yii::app()->request->baseUrl.'/index.php?r=ItemOnOrder/updateStatus&id=0&all_recieved=true&purchase_id='.$purchase_id;
			//$all_recieved_url=$this->createUrl('itemOnOrder/updateStatus&id=0&all_recieved=true',array('id'=>$purchase_id));
			?>

		
			<a href="<?php echo $all_recieved_url; ?>" onclick="return confirm('Have you checked all items. ?')"> 
			<?php 
				echo CHtml::button( 'Rest Recieved OK');
				?>
		 	</a>
			<br>
			<small>Only The Items with status on Order will be added</small>
		</td>

		
		
		
		
		
	
		
	</tr>
	</table>
	</div>
</div> 