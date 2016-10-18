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
		<?php echo $form->label($model,'suppliers_id'); ?>
		<?php echo $form->textField($model,'suppliers_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_number'); ?>
		<?php echo $form->textField($model,'order_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_status'); ?>
		<?php echo $form->textField($model,'order_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_of_order'); ?>
		<?php echo $form->textField($model,'date_of_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_cost'); ?>
		<?php echo $form->textField($model,'total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vat'); ?>
		<?php echo $form->textField($model,'vat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'net_cost'); ?>
		<?php echo $form->textField($model,'net_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->