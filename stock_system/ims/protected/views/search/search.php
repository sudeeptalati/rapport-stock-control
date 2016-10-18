<?php
$this->pageTitle=Yii::app()->name . ' - Search results';
$this->breadcrumbs=array(
    'Search Results',
);
?>
 
<h3>Search Results for: "<?php echo CHtml::encode($term); ?>"</h3>

	<table border="1"> <tr>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Description</th>
					<th>Barcode</th>
					<th>Available Quantity</th>
					<th>Current Quantity</th>
					</tr>

<?php if (!empty($results)): ?>
                <?php  foreach($results as $result): 
?>  
<?php 
			echo "<tr>";
	 			echo "<td>".CHtml::encode($result->part_number)."</td>";
	 			echo "<td>".CHtml::encode($result->name)."</td>";
	 			echo "<td>".CHtml::encode($result->description)."</td>";
	 			echo "<td>".CHtml::encode($result->barcode)."</td>";
	 			echo "<td>".CHtml::encode($result->available_quantity)."</td>";
	 			echo "<td>".CHtml::encode($result->current_quantity)."</td>";
	 			echo "</tr>";
	 			
?>

 
	
		<!--<?php //working ?>              
		<p>Part Number: <?php //echo $query->highlightMatches(CHtml::encode($result->part_number)); ?></p>
        <p>Name: <?php //echo $query->highlightMatches(CHtml::encode($result->name)); ?></p>
         <p>Description: <?php //echo $query->highlightMatches(CHtml::encode($result->description)); ?></p>
        <p>Barcode: <?php //echo $query->highlightMatches(CHtml::encode($result->barcode)); ?></p>
        <p>Available Quantity<?php //echo $query->highlightMatches(CHtml::encode($result->available_quantity)); ?></p>
         <p>Current Quantity: <?php //echo $query->highlightMatches(CHtml::encode($result->current_quantity)); ?></p>
        <hr/>
     --><?php endforeach; ?>
 
     <?php else: ?>
        <p class="error">No results matched your search terms.</p>
     <?php endif; ?>