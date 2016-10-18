<div class="form">

	<?php
	$model->town='na';
	$model->postcode='na';
	$model->email='na@na.com';
	$model->contact_number='na';
	$model->country='na';

	?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'suppliers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'contact_person'); ?>
		<?php echo $form->textField($model,'contact_person',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'contact_person'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textField($model,'town'); ?>
		<?php echo $form->error($model,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode'); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_number'); ?>
		<?php echo $form->textField($model,'contact_number'); ?>
		<?php echo $form->error($model,'contact_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website'); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lead_time_days'); ?><small>(Please enter numeric value for no. of days)</small></br>
		
		<?php echo $form->textField($model,'lead_time_days');?>
		<?php echo $form->error($model,'lead_time_days'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'free_carriage_min_amt'); ?>
		<?php echo $form->textField($model,'free_carriage_min_amt'); ?>
		<?php echo $form->error($model,'free_carriage_min_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_reg_no'); ?>
		<?php echo $form->textField($model,'vat_reg_no'); ?>
		<?php echo $form->error($model,'vat_reg_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prefered_supplier'); ?>
		<?php //echo $form->textField($model,'prefered_supplier'); ?>
		<?php echo $form->dropDownList($model,'prefered_supplier',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'prefered_supplier'); ?>
	</div>

	<!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'logo_url'); ?>
		<?php echo $form->textField($model,'logo_url'); ?>
		<?php echo $form->error($model,'logo_url'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'api_url'); ?>
		<?php echo $form->textField($model,'api_url'); ?>
		<?php echo $form->error($model,'api_url'); ?>
	</div>
	 -->
		<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array('1'=>'Active','0'=>'Inactive',)); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
		
	
	<!--<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->