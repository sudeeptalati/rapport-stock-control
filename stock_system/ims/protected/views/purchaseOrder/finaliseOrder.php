
<?php

$this->menu=array(
	array('label'=>'Manage Purchase Order', 'url'=>array('/PurchaseOrder/admin')),
	
);
?>

<?php 

	$net_cost=$model->net_cost;
	$free_shipping_amt=$model->suppliers->free_carriage_min_amt;
	
	if ($net_cost<$free_shipping_amt && $model->order_status==1)//i.e if model is in draft stage only
	{
	$diff=$free_shipping_amt-$net_cost;
	$message='You can get free shipping from this supplier if you add value of '.$diff.'  to this order ';

	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
			'id'=>'juiDialog',
			'options'=>array(
					'title'=>'Free Shipping',
					'autoOpen'=>true,
					'modal'=>'true',
					'show' => 'blind',
					'hide' => 'explode'
					//'width'=>'40px',
	//'height'=>'40px',
			),
			'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',


	));
	echo $message;
	$this->endWidget();
}//end of if


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
		$url=Yii::app()->getBaseUrl().'/purchaseOrder/'	;
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
		
		
		$staus_code=$model->order_status;
		//echo $model->getOrderStatus($staus_code);
//		echo $staus_code;
		echo $model->status->name;	
		
		if ($staus_code<10 && $staus_code>1)
		 {
		 	echo '<br><b>';		 	
			echo CHtml::link('Order Recieved',array('orderRecieved',
                   'id'=>$purchase_id));
		 		 		 
		 }
		 
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
		</td>	</table>
	</div>
	<!-- SECOND PART OF FORM WHICH DISPLAYS THE DETAILS OF ORDERED ITEMS FROM item_on_order TABLE -->
	
	
	<div class="row">
	<table>
	<tr>
		<td colspan="5">Ordered Items</td>
		</tr>
		 <tr>
					<th>Item Status</th>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Quantity<br>Ordered</th>
					<th>Quantity<br> Recieved</th>
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
				
				$item_status_code=$ordered_items->item_status;
				$item_status=ItemOnOrder::model()->getItemStatus($item_status_code);
				
				//echo "<td>".$item_status."</td>";
				echo "<td>".$ordered_items->status->name."</td>";
	 			echo "<td>".$ordered_items->items->part_number."</td>";
	 			echo "<td>".$ordered_items->items->name."</td>";
	 			echo "<td>".$ordered_items->quantity_ordered."</td>";
	 			echo "<td>".$ordered_items->quantity_recieved."</td>";
	 			echo "<td>".$ordered_items->unit_price."</td>";
	 			echo "<td>".$ordered_items->total_price."</td>";
	 			echo "<td>";
	 			if($model->order_status<3 )
	 			{
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
		 			$del_url=Yii::app()->request->baseUrl.'/itemOnOrder/previewDelete/'.$append_url;
		 			?>
		 			
		 			
					<a href="<?php echo $del_url; ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo $delete_image_url?>" /></a> 
		 			<?php
	 			}///end of if of orderstatus<3
	 			
	 			echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	 			echo "</td>";
			echo "</tr>";
			?>
	 		<tr><td colspan="7"><small><?php echo $ordered_items->comments.'<hr>';?></small></td></tr>
						
			<?php 
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
		<td colspan="2" ><?php echo $form->textField($model,'shipping_cost',array('disabled'=>'disabled'));
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
	
	<tr>
		<td colspan="2">
		<?php //$send_order_url=Yii::app()->request->baseUrl.'/PurchaseOrder/SendOrder/'.$purchase_id;

			//$send_order_url=Yii::app()->request->baseUrl.'/index.php?r=purchaseOrder/SendOrder&id='.$purchase_id;
			 $send_order_url=$this->createUrl('purchaseOrder/sendOrder',array('id'=>$purchase_id));
						
			
			?>

		
		<?php 
		$setupModel = Setup::model()->findByPk(1);
		$internet_connected =  AdvanceSettings::model()->findByAttributes(array('parameter'=>'internet_connected'));
		$current_url=Yii::app()->request->url;
		 
		
		if ($internet_connected->value==1){
			if(Setup::model()->checkInternet())
			{
			if ($model->order_status<3) {?>
			<a href="<?php echo $send_order_url; ?>" onclick="return confirm('Are you sure?')"> 
			<?php 
				echo CHtml::button($model->order_status==1 ? 'Send Order' : 'Resend Order');
				
				?>
		 	</a>
		 	<br>
			<small>Ordered will be send via email. Please make sure your mail settings are configured</small>	
		 	<?php } //end of if
				else
				{?>
			
			<?php //$supplier_notification_url=Yii::app()->request->baseUrl.'/PurchaseOrder/notifySupplier/'.$purchase_id;
			 $supplier_notification_url=$this->createUrl('purchaseOrder/notifySupplier',array('id'=>$purchase_id));
			?>
			<a href="<?php echo $supplier_notification_url; ?>" onclick="return confirm('Are you sure you wanna send email?')"> 
			<?php 
				echo CHtml::button( 'Notify Supplier');
				
				?>
		 	</a>
			<br>
			<small>The supplier will be notified by email about the Item status</small>
			<?php
			}
			
				// end of else?>
			
		</td>
		
		<td>
			<?php $testUrl=Yii::app()->request->baseUrl.'/PurchaseOrder/testConnection/'.$purchase_id;
			$testUrl=$this->createUrl('purchaseOrder/testConnection',array('id'=>$purchase_id));
			?>
			<a href="<?php echo $testUrl;?>" onclick = "return confirm('Are you sure you wanna send email?')">
			<?php echo CHtml::button('Test Connection');?>
			</a>
			<?php
			}//end of checkInternet
			else
			{
				Yii::app()->controller->redirect(array('Setup/Disableinternet', 'current_url'=>$current_url));
			}
			
		}//end of if internet_connected
		else
		{
		
			echo "<font color='red'><b>As your system is in offline mode, you can not send order. Please enable Internet:</b></font><br>";
			echo CHtml::link('Enable Internet',array('Setup/Enableinternet', 'current_url'=>$current_url));
		
		
		}
		?>
			
		</td>
		
		
		<th colspan="4" style="text-align: right"><?php  echo CHtml::link('PDF',array('orderPreview',
                   'id'=>$purchase_id), array('target'=>'_blank'));
		 ?>
		 </th>
		 
		 <th
		 	style="text-align: right"><?php  echo CHtml::link('Excel', array('orderExcel', 'id'=>$purchase_id));
		 ?>
		 </th>
		 
		 <th
		 	style="text-align: right"><?php  echo CHtml::link('CSV', array('orderCsv', 'id'=>$purchase_id));
		 ?>
		 </th>
		
	</tr>
	
	</table>
	</div>
	
		
<?php $this->endWidget(); ?>
	
</div> 