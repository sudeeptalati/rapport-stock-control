<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->item_id), array('view', 'id'=>$data->item_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('part_number')); ?>:</b>
	<?php echo CHtml::encode($data->part_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barcode')); ?>:</b>
	<?php echo CHtml::encode($data->barcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_room')); ?>:</b>
	<?php echo CHtml::encode($data->location_room); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('location_row')); ?>:</b>
	<?php echo CHtml::encode($data->location_row); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_column')); ?>:</b>
	<?php echo CHtml::encode($data->location_column); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_shelf')); ?>:</b>
	<?php echo CHtml::encode($data->location_shelf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->current_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->available_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommended_lowest_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->recommended_lowest_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommended_highest_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->recommended_highest_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image_url')); ?>:</b>
	<?php echo CHtml::encode($data->image_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_price')); ?>:</b>
	<?php echo CHtml::encode($data->sale_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factory_due_date')); ?>:</b>
	<?php echo CHtml::encode($data->factory_due_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suppliers_id')); ?>:</b>
	<?php echo CHtml::encode($data->suppliers_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fits_in_model')); ?>:</b>
	<?php echo CHtml::encode($data->fits_in_model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>