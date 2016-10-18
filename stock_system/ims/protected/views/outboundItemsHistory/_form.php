<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'outbound-items-history-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php //	echo $form->labelEx($model,'main_item_id'); ?>
		<?php //echo $form->textField($model,'main_item_id'); ?>
		<?php echo $form->hiddenField($model,'main_item_id'); ?>
		
<?php echo CHtml::label('Item Name','item-id');?>
		<?php 	$item_id=$model->main_item_id;  
			$itemModel=Items::model()->findByPk($item_id);
			if ($itemModel){
				echo "<span style='font-size:x-large;'>";
				echo $itemModel->name;
				echo "</span><br><br>";
				
				echo CHtml::label('Part Number','partnumber-id');
				echo "<span style='font-size:x-large;'>";
				echo $itemModel->part_number;
				echo "</span>";
				
				$model->current_quantity_in_stock= $itemModel->current_quantity;
				$model->available_quantity_in_stock= $itemModel->available_quantity;
			}
			else
				echo "Item not found";
			
	?>
	
	
		<?php echo $form->error($model,'main_item_id'); ?>
	</div>

	
	<table>
			<tr>
				<td>
				<?php echo $form->labelEx($model,'current_quantity_in_stock'); ?>
				<?php echo $form->hiddenField($model,'current_quantity_in_stock'); ?>
				<?php 
					echo "<span style='font-size:x-large;'>";
					echo $itemModel->current_quantity; 
					echo "</span>";	
				?>
				<?php echo $form->error($model,'current_quantity_in_stock'); ?>
					
				</td><td>
					
					
				<?php echo $form->labelEx($model,'available_quantity_in_stock'); ?>
				<?php echo $form->hiddenField($model,'available_quantity_in_stock'); ?>
				<?php 
					echo "<span style='font-size:x-large;'>";
					echo $itemModel->available_quantity; 
					echo "</span>";	
				?>
				<?php echo $form->error($model,'available_quantity_in_stock'); ?>
				</td>
			</tr>
		</table>
	<div class="row">
		<?php echo $form->labelEx($model,'quantity_moved'); ?>
		<?php echo $form->textField($model,'quantity_moved'); ?>
		<?php echo $form->error($model,'quantity_moved'); ?>
	</div>

	 

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		
		<?php //$user_id=$model->user_id;
		
		?>
		
		<?php //echo $form->textField($model,'user_id', $model->getUserName()); ?>
		<?php //echo CHtml::activeDropDownList($model, 'user_id', $model->getUserName());?>
		<?php //echo $form->textField($model,'user_id',Yii::app()->user->name); ?>
		<?php //echo $form->error($model,'user_id'); ?>
	</div>

	--><!--<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Remove Items' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->