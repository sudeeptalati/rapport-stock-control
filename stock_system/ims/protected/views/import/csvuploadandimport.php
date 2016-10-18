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
		
		$model->item_id=$line_of_text[0];	
		$model->company_id=$line_of_text[1];	

		$model->part_number=$line_of_text[2];
		if (empty($model->part_number))
		{
			$model->part_number='Not Available';
		}
		
				
		$model->name=$line_of_text[3];
		if (empty($model->name))
		{
			$model->name='Not Available';
		}
		
		$model->description=$line_of_text[4];
		$model->barcode=$line_of_text[5];
		$model->location_room=$line_of_text[6];
		$model->location_row=$line_of_text[7];
		$model->location_column=$line_of_text[8];
		$model->location_shelf=$line_of_text[9];
		$model->category_id=$line_of_text[10];
		
		$model->current_quantity=$line_of_text[11];
		if (empty($model->current_quantity))
		{
			$model->current_quantity='0';
		}
		
		$model->available_quantity=$line_of_text[12];
		if (empty($model->available_quantity))
		{
			$model->available_quantity='0';
		}
		
		$model->recommended_lowest_quantity=$line_of_text[13];
		$model->recommended_highest_quantity=$line_of_text[14];
		$model->remarks=$line_of_text[15];
		$model->active=$line_of_text[16];
		$model->image_url=$line_of_text[17];
		$model->sale_price=$line_of_text[18];
		$model->factory_due_date=$line_of_text[19];
		$model->suppliers_id=$line_of_text[20];
		$model->fits_in_model=$line_of_text[21];
		$model->created=$line_of_text[22];
		$model->modified=$line_of_text[23];
		$model->deleted=$line_of_text[24];
		
		if ($model->save())
		{
			echo '<tr style="background-color:#EAF2D3"><td>'.$model->part_number.'</td><td>Part Number Saved</td><td></td> </tr>';
		}else
		
		{ 
			$errors=$model->getErrors();
			echo '<tr style="background-color:#FF8566"><td>'.$model->part_number.'</td><td>Part Number Not Saved</td><td>';
			
			echo "Item not imported";
			foreach ($errors as $e)
			{
				echo "<br>".$e[0];
				
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


