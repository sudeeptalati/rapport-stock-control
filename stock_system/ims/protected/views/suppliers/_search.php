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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'town'); ?>
		<?php echo $form->textField($model,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_number'); ?>
		<?php echo $form->textField($model,'contact_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'website'); ?>
		<?php echo $form->textField($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lead_time_days'); ?>
		<?php echo $form->textField($model,'lead_time_days'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'free_carriage_min_amt'); ?>
		<?php echo $form->textField($model,'free_carriage_min_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vat_reg_no'); ?>
		<?php echo $form->textField($model,'vat_reg_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prefered_supplier'); ?>
		<?php echo $form->textField($model,'prefered_supplier'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'logo_url'); ?>
		<?php echo $form->textField($model,'logo_url'); ?>
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