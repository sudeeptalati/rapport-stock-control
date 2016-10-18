<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo CHtml::submitButton( 'Export to excel', array( 'name' => 'export' ) ); ?>

	<div class="row">
		<?php echo $form->label($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'part_number'); ?>
		<?php echo $form->textField($model,'part_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'barcode'); ?>
		<?php echo $form->textArea($model,'barcode',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_room'); ?>
		<?php echo $form->textField($model,'location_room',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_row'); ?>
		<?php echo $form->textField($model,'location_row',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_column'); ?>
		<?php echo $form->textField($model,'location_column',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_shelf'); ?>
		<?php echo $form->textField($model,'location_shelf',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_quantity'); ?>
		<?php echo $form->textField($model,'current_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'available_quantity'); ?>
		<?php echo $form->textField($model,'available_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommended_lowest_quantity'); ?>
		<?php echo $form->textField($model,'recommended_lowest_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommended_highest_quantity'); ?>
		<?php echo $form->textField($model,'recommended_highest_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remarks'); ?>
		<?php echo $form->textArea($model,'remarks',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'image_url'); ?>
		<?php echo $form->textArea($model,'image_url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_price'); ?>
		<?php echo $form->textField($model,'sale_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'factory_due_date'); ?>
		<?php echo $form->textField($model,'factory_due_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suppliers_id'); ?>
		<?php echo $form->textField($model,'suppliers_id'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->label($model,'fits_in_model'); ?>
		<?php echo $form->textArea($model,'fits_in_model',array('rows'=>6, 'cols'=>50)); ?>
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
		<?php echo $form->label($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Search'); ?>
		<?php echo CHtml::submitButton('Search', array( 'id' => 'submit-button' )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->