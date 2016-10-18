<?php

echo "<table>";
		$file_handle = fopen($filepath,"r");
		$i=0;
		//while loop
		while (!feof($file_handle) ) {
		echo "<tr>";
		$line_of_text = fgetcsv($file_handle, 1024);
		echo "<td>";
		//echo $i.$line_of_text[5];
		echo "</td>";
		
		if (!empty($line_of_text))
		{
			updateItem($line_of_text);
		}
		
		
		
		$i++;
		echo "</tr>";
		
		
		}////end of while (!feof($file_handle) )

		fclose($file_handle);

echo "</table>";
 



function updateItem($line_of_text)
	{
		
		$model=new Items;

 
		 
		
		$model->part_number=$line_of_text[0];
		if (empty($model->part_number))
		{
			$model->part_number='Not Available';
		}
		
				
		$model->name=$line_of_text[1];
		if (empty($model->name))
		{
			$model->name='Not Available';
		}
		
		
		
		/////This is Quantity
		$model->current_quantity=$line_of_text[2];
		if (empty($model->current_quantity))
		{
			$model->current_quantity='0';
		}
		
		$model->available_quantity=$line_of_text[2];
		if (empty($model->available_quantity))
		{
			$model->available_quantity='0';
		}
	
		$model->location_room=$line_of_text[3];
		$model->location_row=$line_of_text[4];
		$model->location_column=$line_of_text[5];
		$model->location_shelf=$line_of_text[6];
		$model->barcode=$line_of_text[7];
		$model->description=$line_of_text[8];

		$model->stock_date=strtotime($line_of_text[9]);
		$model->unit_price=$line_of_text[10];
		$model->vat_amount=$line_of_text[11];
		$model->sale_price=$line_of_text[12];
		$model->total_price_inc_vat=$line_of_text[13];
		$model->suppliers_id=$line_of_text[14];






		if ($model->save())
		{
			echo '<tr style="background-color:#EAF2D3"><td>'.$model->part_number.'</td><td>'.$model->name.'</td><td>Item Saved</td><td></td> </tr>';
		}else
		
		{ 
			$errors=$model->getErrors();
			echo '<tr style="background-color:#FF8566"><td>'.$model->part_number.'</td><td>'.$model->name.'</td><td>Item Not Saved</td><td>';
			
			echo "Item not imported.<br><b>Reason:</b>";
			foreach ($errors as $e)
			{
				echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;".$e[0];
				
			}
			
			echo '</td></tr>';
		
			//print_r($model->getErrors()).'</td></tr>';
		}//end of save else
		
		
		
	}////end of update Item Function
		 
	
?>

<div id="scroll_to_end"> 
<?php
echo CHtml::button('Show The Imported Items', array('submit' => array('items/admin')));
?>
</div>


