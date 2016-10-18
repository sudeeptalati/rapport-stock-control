<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->main_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternate_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->alternate_item_id); ?>
	<br />


</div>