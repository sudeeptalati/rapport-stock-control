<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('history_id_item')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->history_id_item), array('view', 'id'=>$data->history_id_item)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->main_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_moved')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_moved); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_quantity_in_stock')); ?>:</b>
	<?php echo CHtml::encode($data->current_quantity_in_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_quantity_in_stock')); ?>:</b>
	<?php echo CHtml::encode($data->available_quantity_in_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	*/ ?>

</div>