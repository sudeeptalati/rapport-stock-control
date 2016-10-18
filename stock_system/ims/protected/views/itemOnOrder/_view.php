<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_order_id')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_order_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('items_id')); ?>:</b>
	<?php echo CHtml::encode($data->items_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suppliers_id')); ?>:</b>
	<?php echo CHtml::encode($data->suppliers_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_status')); ?>:</b>
	<?php echo CHtml::encode($data->item_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('out_of_stock_factory_date')); ?>:</b>
	<?php echo CHtml::encode($data->out_of_stock_factory_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factory_due_date')); ?>:</b>
	<?php echo CHtml::encode($data->factory_due_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_ordered')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_ordered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->unit_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_price')); ?>:</b>
	<?php echo CHtml::encode($data->total_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>