

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<table style="padding:25px;margin:10px;background-color: #C7E8FD;  border-radius: 15px;">
	
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'company'); ?>
			<?php echo $form->textField($model,'company',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'company'); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textArea($model,'address',array('rows'=>5, 'cols'=>30)); ?>
			<?php echo $form->error($model,'address'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'town'); ?>
			<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'town'); ?>
		</td>
	
		<td>
			<?php echo $form->labelEx($model,'postcode_s'); ?> <small>First Part &nbsp; Second Part</small><br>
			<?php echo $form->textField($model,'postcode_s',array('size'=>3,'maxlength'=>4)); ?>
			<?php echo $form->error($model,'postcode_s'); ?>
		
			<?php //echo $form->labelEx($model,'postcode_e'); ?>
			<?php echo $form->textField($model,'postcode_e',array('size'=>3, 'maxlength'=>4)); ?>
			<?php echo $form->error($model,'postcode_e'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'county'); ?>
			<?php echo $form->textField($model,'county',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'county'); ?>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'country'); ?>
			<?php echo $form->textField($model,'country',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'country'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'vat_reg_no'); ?>
			<?php echo $form->textField($model,'vat_reg_no',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'vat_reg_no'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'company_number'); ?>
			<?php echo $form->textField($model,'company_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'company_number'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			
			<?php echo $form->labelEx($model,'telephone'); ?>
			<?php echo $form->textField($model,'telephone',array('maxlength'=>10, 'rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'telephone'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'alternate'); ?>
			<?php echo $form->textField($model,'alternate',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'alternate'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'fax'); ?>
			<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'fax'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			 
			
			<?php echo $form->labelEx($model,'mobile'); ?>	
			<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'mobile'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'email'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'website'); ?>
			<?php echo $form->textField($model,'website',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'website'); ?>
		</td>
	</tr>
	
	
	<!--<tr>
		<td>
			<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
			<?php echo $form->textField($model,'postcodeanywhere_account_code',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
		</td>
	
		<td>
			<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
			<?php echo $form->textField($model,'postcodeanywhere_license_key',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
		</td>
	</tr>
	-->
	
	<tr>
		<td>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</td>
		
	</tr>
	
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->