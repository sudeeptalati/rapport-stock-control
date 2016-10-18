<?php 
$this->layout=false;
$setupModel = Setup::model()->findByPk(1);

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/eclipse-php/workspace/ims_working/IMS_LocalWorking/ims/css/print.css" />
	
	<?php 
	$purchase_id=$model->id;
	$items_on_order_model=$model->getItemsOnOrder($purchase_id);
	
	
	?>
</head>
<body>



<table style="width:100%; ">

<tr>
<td><h2>Purchase Order</h2></td>
</tr>
<tr>
<td align="right">
<?php 
$logo_url=Yii::app()->request->baseUrl.'/images/company_logo.png';
echo CHtml::image($logo_url);
?>
</td>
</tr>
<tr>
<td align="right" style="font-size:10px;">
<?php 
//$company_name=Yii::app()->params['company_name'];
$company_name = $setupModel->company;
//$company_address=Yii::app()->params['company_address'];
$company_address = $setupModel->address;
//$company_contact_details=Yii::app()->params['company_contact_details'];
$company_contact_details = 'Telephone: '.$setupModel->telephone.'  Fax: '.$setupModel->fax.'  Email: '.$setupModel->email;
$vat_percentage=Yii::app()->params['vat_in_percentage'];

echo $company_name."<br>".$company_address;
echo "<br> ".$company_contact_details;

?>
</td>
</tr>
</table>

<br>


<table style="width:100%; margin-left:5%;margin-right:5%; vertical-align: top;">
	<tr>
		<td>Attention:</td>
		<td><?php echo $model->suppliers->name ;?></td>
		<td>P.O. Number:</td>
		<td><?php echo $model->order_number ;?></td>
	</tr>
	<tr>
		<td>Company</td>
		<td><?php echo $model->suppliers->name ;?></td>
		<td>Delivery Instuctions:</td>
		<td>Yes/No</td>
	</tr>
	<tr>
		<td>Address</td>
		<td><?php echo $model->suppliers->address."<br>".$model->suppliers->town."<br>".$model->suppliers->postcode_s." ".$model->suppliers->postcode_e ;?></td>
		<td>Placed By:</td>
		<td><?php echo $model->user->profile ;?></td>
	</tr>
</table>

<br>
<br>
<table style="width:100%; margin-left:5%;margin-right:5%; vertical-align: top;">
	<tr>
		<th style="width:15%;text-align:left">Part Number</th>
		<th style="width:40%;text-align:left">Description</th>
		<th style="width:10%;text-align:left">Quantity</th>
		<th style="width:10%;text-align:left">Price</th>
		<th style="width:10%;text-align:left">Total</th>
	    <th style="width:10%;text-align:left">Comments</th>
		
	</tr>
	
		<?php 
		$i=1;
		foreach ($items_on_order_model as $ordered_items) 
		{
				echo "<tr>";
				//echo "<td>".$i."</td>";
	 			echo "<td>".$ordered_items->items->part_number."</td>";
	 			echo "<td>".$ordered_items->items->name."</td>";
	 			echo "<td>".$ordered_items->quantity_ordered."</td>";
	 			echo "<td>".$ordered_items->unit_price."</td>";
	 			echo "<td>".$ordered_items->total_price."</td>";
	 			echo "<td>".$ordered_items->comments."</td>";
	 			echo "</tr>"; 
		$i++;		
		}///end of for each
	
		?>
		<tr><td colspan="7"> <hr></td></tr>
		<tr><th colspan="5" style="width:10%;text-align:right">Subtotal</th>
		<td colspan="2" style="width:10%;text-align:left"><?php echo $model->total_cost; ?></td></tr>
		<tr><th colspan="5" style="width:10%;text-align:right">Shipping Cost</th>
		<td colspan="2" style="width:10%;text-align:left"><?php  echo $model->shipping_cost; ?></td></tr>
		<tr><th colspan="5" style="width:10%;text-align:right">VAT @ <?php echo $vat_percentage;?>%</th>
		<td colspan="2" style="width:10%;text-align:left"><?php echo $model->vat; ?></td></tr>
		<tr><th colspan="5" style="width:10%;text-align:right">Total</th>
		<td colspan="2" style="width:10%;text-align:left"><?php echo $model->net_cost; ?></td></tr>
		
		
		
	</table>
	






</body>
</html>


<?php // $this->endWidget(); ?>