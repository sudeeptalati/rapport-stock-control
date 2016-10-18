<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo CHtml::submitButton( 'Export to excel', array( 'name' => 'export' ) ); ?>

	<div class="row">
		<?php echo $form->label($model,'history_id_item'); ?>
		<?php echo $form->textField($model,'history_id_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'main_item_id'); ?>
		<?php echo $form->textField($model,'main_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity_moved'); ?>
		<?php echo $form->textField($model,'quantity_moved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_quantity_in_stock'); ?>
		<?php echo $form->textField($model,'current_quantity_in_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'available_quantity_in_stock'); ?>
		<?php echo $form->textField($model,'available_quantity_in_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'items_on_order_id'); ?>
		<?php echo $form->textField($model,'items_on_order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Search'); ?>
		<?php echo CHtml::submitButton('Search', array( 'id' => 'submit-button' )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->