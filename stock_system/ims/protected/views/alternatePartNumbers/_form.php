<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'alternate-part-numbers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'main_item_id'); ?>
		<?php echo $form->textField($model,'main_item_id'); ?>
		<?php echo $form->error($model,'main_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alternate_item_id'); ?>
		<?php echo $form->textField($model,'alternate_item_id'); ?>
		<?php echo $form->error($model,'alternate_item_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->