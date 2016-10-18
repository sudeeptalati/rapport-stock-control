<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'suppliers_id'); ?>
		<?php //echo $form->textField($model,'suppliers_id'); ?>
		<?php 	$supplier_id=$model->suppliers_id;  
			$supplierModel=Suppliers::model()->findByPk($supplier_id);
			if ($supplierModel)
			{
				echo $form->textField($supplierModel,'name', array('disabled'=>'disabled')); 
				echo $form->labelEx($supplierModel,'free_carriage_min_amt', array('disabled'=>'disabled'));
				echo $form->textField($supplierModel,'free_carriage_min_amt', array('disabled'=>'disabled'));
							}
			else
				echo "supplier not found";
			
		?>
		<?php echo $form->error($model,'suppliers_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_number'); ?>
		<?php //echo $form->textField($model,'order_number'); ?>
		<?php echo $form->textField($model,'order_number', array('disabled'=>'disabled'));?>
		<?php echo $form->error($model,'order_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_status'); ?>
		<?php echo $form->dropDownList($model,'order_status',array('1'=>'Draft', '2'=>'Send','3'=>'Rejected', '4'=>'Partially Received','5'=>'Received','11'=>'Cancelled','12'=>'Deleted',));?>
		<?php //echo $form->textField($model,'order_status'); ?>
		<?php echo $form->error($model,'order_status'); ?>
	</div>
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'date_of_order'); ?>
		<?php echo $form->textField($model,'date_of_order'); ?>
		<?php echo $form->error($model,'date_of_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_cost'); ?>
		<?php echo $form->textField($model,'total_cost'); ?>
		<?php echo $form->error($model,'total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat'); ?>
		<?php echo $form->textField($model,'vat'); ?>
		<?php echo $form->error($model,'vat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'net_cost'); ?>
		<?php echo $form->textField($model,'net_cost'); ?>
		<?php echo $form->error($model,'net_cost'); ?>
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

	<div class="row">
		<?php //echo $form->labelEx($model,'cancelled'); ?>
		<?php //echo $form->textField($model,'cancelled'); ?>
		<?php //echo $form->error($model,'cancelled'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->