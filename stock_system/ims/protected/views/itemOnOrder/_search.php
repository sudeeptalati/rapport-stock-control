<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchase_order_id'); ?>
		<?php echo $form->textField($model,'purchase_order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'items_id'); ?>
		<?php echo $form->textField($model,'items_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suppliers_id'); ?>
		<?php echo $form->textField($model,'suppliers_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_status'); ?>
		<?php echo $form->textField($model,'item_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'out_of_stock_factory_date'); ?>
		<?php echo $form->textField($model,'out_of_stock_factory_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'factory_due_date'); ?>
		<?php echo $form->textField($model,'factory_due_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity_ordered'); ?>
		<?php echo $form->textField($model,'quantity_ordered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_price'); ?>
		<?php echo $form->textField($model,'unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->