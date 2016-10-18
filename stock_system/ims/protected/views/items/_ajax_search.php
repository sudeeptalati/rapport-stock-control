<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	);


$allitems=$results->getData()
?>
 
 
 
 
<?php 

// 
// 	echo $r->part_number." ======";
// 	echo $r->name."<br>";
// }


echo "<br><br>";?>



<table class="grid-view">
<thead>
<tr>
<th>Status</th>
<th>Part Number</th>
<th>Name & Seller </th>
<th>Barcode </th>
<th></th>
	<th>Current<br>Quantity</th>



	<th>Price (Unit + VAT)</th>
<th>Location</th>
</tr>
</thead>
<tbody>
<?php 

$i=0;
foreach ($allitems as $row)
  {
  	
  	$id=$row->item_id;
	 // echo //"Title: ".$row->name."<br />";
	  echo "<tr><td colspan='9'><br></td></tr>";

	if ($i==0){
	    ?>
		<tr class="odd">	
		<?php 
		$i=1;
		}//end of if
		else{ 
			?>
			<tr class="even">
			<?php
			$i=0;
			}//end of else	
	?>	
	<td>
	<?php if ($row['available_quantity']==0){?>

				<img src="<?php echo Yii::app()->baseUrl.'/images/red.png';?>" alt="Add this Item in Stock">
					<?php }
			elseif ($row['available_quantity']<$row['recommended_lowest_quantity'])
			{
			?>
				<img src="<?php echo Yii::app()->baseUrl.'/images/yellow.png';?>" alt="Add this Item in Stock">
			<?php 				}
				else 
				{
				?>

				<img  style="width: 20px;"src="<?php echo Yii::app()->baseUrl.'/images/green.png';?>" alt="Add this Item in Stock">
					<?php 
				}
	?>

	</td>
	<td><?php echo $row['part_number']?>
		<br><br>
		<div>
			<div class='addbuttoninrow'>
				<?php echo CHtml::link( CHtml::image('images/add.png', 'Add Quantity') , array('inboundItemsHistory/create', 'main_item_id'=>$id ), array('title'=>'Add Quantity', 'style' => 'text-decoration: blink; font-size: 18px;font-weight: bold;')); ?>
			</div>
			<div class="removebuttoninrow">
				<?php echo CHtml::link( CHtml::image('images/remove.png', 'Remove Quantity') , array('outboundItemsHistory/create', 'main_item_id'=>$id ), array('title'=>'Remove Quantity',  'style' => 'text-decoration: blink; font-size: 18px;font-weight: bold;')); ?>

			</div>
		</div>
	</td>
	<td>
		<a href="<?php echo $this->createUrl('items/view',array('id'=>$id)); ?>"><?php echo $row['name'];?></a>
		<br><hr>
			
		<table>
			<tr>
				<td>	
					<b><?php echo $row->suppliers->name;?></b>
				</td>
				<td>
					<span class="fa fa-check-square-o" title="Stock Date"></span>
					&nbsp;&nbsp;
					 
						<?php echo Setup::model()->formatdate($row->stock_date); ?>
					 
					<br>
					<span class="fa fa-shopping-cart" title="Purchase Date"></span>
					&nbsp;&nbsp;
					<?php echo Setup::model()->formatdate($row->purchase_date); ?>
					<br>
					
				</td>
			</tr>
		</table>

	</td>
	<td><?php echo $row['barcode'];?></td>
	<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php echo $row['part_number']." ".$row['name'];?>" />
			<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/search.jpg';?>" style="width:20px" alt="submit form" />
		</form>	
	</td>
	<td><?php echo $row['current_quantity']?></td>


	  <td>
		  <table>
			  <tr>
				  <td><?php echo   number_format($row->unit_price, 2, '.', '');?></td>
				  <td>+</td>
				  <td><?php echo  number_format($row->vat_amount, 2, '.', '');?></td>
				  <td></td>
			  </tr>
			  <tr>
				  <td colspan="3">
				  	<b>£ <?php echo number_format($row->sale_price, 2, '.', ''); ?></b>
					<hr>
					<table>
						<tr>
							<td>Exc. VAT:</td>
							<td>Inc. VAT:</td>
						</tr>
						<tr>
							<td><b><?php echo   number_format($row->total_price_exc_vat, 2, '.', '');?></b></td>
							<td><b><?php echo   number_format($row->total_price_inc_vat, 2, '.', '');?></b></td>
						</tr>
 					</table>
				  </td>
			  </tr>
 

		  </table>




	  </td>


	<td>
		<?php echo $row['location_room']."  ".$row['location_row']."  ".$row['location_column']."  ".$row['location_shelf']."  "?>
		
	</td>
	</tr>




	<?php 
  }//end of while

?>

</tbody>
</table>