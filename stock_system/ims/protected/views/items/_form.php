<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'items-form',
        'enableAjaxValidation' => true,

        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),


    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <!-- Item Details Start-->
    <div class="itemheadingbox">
        Item Details
    </div>
    <div class="itemdatabox">
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'barcode'); ?>
            <?php echo $form->textField($model, 'barcode', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'barcode'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'part_number'); ?>
            <?php echo $form->textArea($model, 'part_number', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'part_number'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'active'); ?>
            <?php //echo $form->textField($model,'active'); ?>
            <?php echo $form->DropDownList($model, 'active', array('1' => 'Yes', '0' => 'No')); ?>
            <?php echo $form->error($model, 'active'); ?>
        </div>
    </div>
    <br><br>
    <!-- Item Details End-->


    <!-- Quantity Details Start-->
    <div class="itemheadingbox">
        Quantity
    </div>
    <div class="itemdatabox">
        <table>
            <tr>
                <th><?php echo $form->labelEx($model, 'current_quantity'); ?></th>
                <th><?php echo $form->labelEx($model, 'available_quantity'); ?></th>
                <th> <?php echo $form->labelEx($model, 'recommended_lowest_quantity'); ?></th>
                <th> <?php echo $form->labelEx($model, 'recommended_highest_quantity'); ?></th>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <?php echo $form->textField($model, 'current_quantity'); ?>
                        <?php echo $form->error($model, 'current_quantity'); ?>
                        <input type="hidden" name="original_quantity" value="<?php echo $model->current_quantity; ?>"/>

                    </div>
                </td>
                <td>
                    <div class="row">
                        <?php echo $form->textField($model, 'available_quantity'); ?>
                        <?php echo $form->error($model, 'available_quantity'); ?>
                        <input type="hidden" name="original_available_quantity"
                               value="<?php echo $model->available_quantity; ?>"/>

                    </div>
                </td>
                <td>
                    <div class="row">
                        <?php echo $form->textField($model, 'recommended_lowest_quantity'); ?>
                        <?php echo $form->error($model, 'recommended_lowest_quantity'); ?>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <?php echo $form->textField($model, 'recommended_highest_quantity'); ?>
                        <?php echo $form->error($model, 'recommended_highest_quantity'); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
    <!-- Quantity Details End-->


    <!-- Pricing Details Start-->
    <div class="itemheadingbox">
        Pricing
    </div>
    <div class="itemdatabox">
        <table>
            <tr>
                <th><?php echo $form->labelEx($model, 'vat_percentage'); ?></th>
                <th><?php echo $form->labelEx($model, 'unit_price'); ?></th>
                <th><?php echo $form->labelEx($model, 'vat_amount'); ?></th>
                <th><?php echo $form->labelEx($model, 'sale_price'); ?></th>
            </tr>
            <tr>
                <td>
                    <?php echo $form->dropDownList($model, 'vat_percentage', array('20' => '20% (Standard VAT)', '0' => '0%'), array('onchange' => 'calculateprices()')); ?>
                    <?php echo $form->error($model, 'vat_percentage'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model, 'unit_price'); ?>
                    <?php echo $form->error($model, 'unit_price'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model, 'vat_amount', array('readonly' => 'true', 'style'=>"background-color:#EFEFEF;")); ?>
                    <?php echo $form->error($model, 'vat_amount'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model, 'sale_price', array('readonly' => 'true', 'style'=>"background-color:#EFEFEF;")); ?>
                    <?php echo $form->error($model, 'sale_price'); ?>

                </td>
            </tr>
            <tr>
                <td colspan="4"><br>
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <th><?php echo $form->labelEx($model, 'total_price_exc_vat'); ?></th>
                </td>
                <td> <?php echo $form->textField($model, 'total_price_exc_vat', array('readonly' => 'true', 'style'=>"background-color:#EFEFEF;")); ?>
                    <?php echo $form->error($model, 'total_price_exc_vat'); ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <th><?php echo $form->labelEx($model, 'total_price_inc_vat'); ?></th>
                </td>
                <td> <?php echo $form->textField($model, 'total_price_inc_vat', array('readonly' => 'true', 'style'=>"background-color:#EFEFEF;")); ?>
                    <?php echo $form->error($model, 'total_price_inc_vat'); ?>
                </td>
            </tr>


        </table>
    </div>
    <br><br>
    <!-- Pricing Details End-->


    <!-- Item Location Details Start-->

    <div class="itemheadingbox">
        Location
    </div>
    <div class="itemdatabox">
        <table>
            <tr>
                <th><?php echo $form->labelEx($model, 'location_room'); ?></th>
                <th><?php echo $form->labelEx($model, 'location_row'); ?></th>
                <th> <?php echo $form->labelEx($model, 'location_column'); ?></th>
                <th> <?php echo $form->labelEx($model, 'location_shelf'); ?></th>
            </tr>
            <tr>
                <td>
                    <?php echo $form->textField($model, 'location_room', array('size' => 4, 'maxlength' => 32)); ?>
                    <?php echo $form->error($model, 'location_room'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model, 'location_row', array('size' => 4, 'maxlength' => 4)); ?>
                    <?php echo $form->error($model, 'location_row'); ?>
                </td>
                <td>
                    <?php echo $form->dropDownList($model, 'location_column', array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12,)); ?>
                    <?php echo $form->error($model, 'location_column'); ?>
                </td>
                <td>
                    <?php echo $form->dropDownList($model, 'location_shelf', array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8,)); ?>
                    <?php echo $form->error($model, 'location_shelf'); ?>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
    <!-- Item Location Details End-->

    <!-- Other Details Start-->

    <div class="itemheadingbox">
        Other Details
    </div>
    <div class="itemdatabox">

        <table>
            <tr>
                <td>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'stock_date'); ?>
                        <?php

 			 
 			$model->stock_date=Setup::model()->formatdate($model->stock_date);
 		 
 			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'stock_date'),
				'model'=>$model,
        		'value' => $model->attributes['stock_date'],
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat' => 'dd-mm-yy',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:20px;'
			    ),
			));
						?>
						
						<span style=" padding: 5px;background: bisque;margin-left: 15px;cursor: pointer;" onclick='todaysdate();'>Today</span>
						<?php echo $form->error($model, 'stock_date'); ?>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'purchase_date'); ?>
                        <?php
						
						$model->purchase_date=Setup::model()->formatdate($model->purchase_date);
 		 
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => CHtml::activeName($model, 'purchase_date'),
                            'model' => $model,
                            'value' => $model->attributes['purchase_date'],
                            // additional javascript options for the date picker plugin
                            'options' => array(
                                'showAnim' => 'fold',
                                'dateFormat' => 'dd-mm-yy',
                            ),
                            'htmlOptions' => array(
                                'style' => 'height:20px;',
                                'readonly' => 'true',
                            ),
                        ));

                        ?>
                        <?php echo $form->error($model, 'purchase_date'); ?>
                    </div>
                </td>
            </tr>
        </table>


        <div class="row">
            <?php echo $form->labelEx($model, 'remarks'); ?>
            <?php echo $form->textArea($model, 'remarks', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'remarks'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'image_url'); ?>
            <?php echo $form->textField($model, 'image_url', array('style' => 'width:600px;')); ?>
            <?php echo $form->error($model, 'image_url'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'suppliers_id'); ?>
            <?php echo CHtml::activeDropDownList($model, 'suppliers_id', $model->getSuppliersName()); ?>
            <?php echo $form->error($model, 'suppliers_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'factory_due_date'); ?>
            <?php

            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => CHtml::activeName($model, 'factory_due_date'),
                'model' => $model,
                'value' => $model->attributes['factory_due_date'],
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'dd-mm-yy',
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                    'readonly' => 'true',
                ),
            ));

            ///echo $form->textField($model,'factory_due_date'); ?>
            <?php echo $form->error($model, 'factory_due_date'); ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'fits_in_model'); ?>
            <?php echo $form->textArea($model, 'fits_in_model', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'fits_in_model'); ?>
        </div>

    </div>
    <br><br>
    <!-- Item Other Details End-->


    <div class="itemheadingbox">
        Comments
    </div>
    <div class="itemdatabox">

        <?php //echo $form->labelEx($model,'comments'); ?><br>
        <?php echo $form->textArea($model, 'comments', array('rows' => 8, 'cols' => 60, 'value' => '')); ?>
        <?php echo $form->error($model, 'comments'); ?>
        <div style="width:70%;">
            <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->comments); ?>
        </div>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">


    $(document).ready(function () {

        $("#Items_unit_price").keyup(function () {
            calculateprices();

        });//end of keyup function.

        $("#Items_current_quantity").keyup(function () {
            calculateprices();

        });//end of keyup function.


    });//end of ready function.


    function calculateprices() {

        console.log('calculating Prices........');
        var unit_price = $("#Items_unit_price").val();
        var vat_percentage = $("#Items_vat_percentage").val();

        var current_quantity = $("#Items_current_quantity").val();


        var vat_on_unit_price = (unit_price * vat_percentage) / 100;
        $("#Items_vat_amount").val(vat_on_unit_price);

        var total_price_exc_vat = '';
        var total_price_inc_vat = '';

        var sale_price_inc_vat = parseFloat(unit_price) + parseFloat(vat_on_unit_price);

        $("#Items_sale_price").val(sale_price_inc_vat);

        var total_price_exc_vat = parseFloat(unit_price) * parseFloat(current_quantity);
        var total_price_inc_vat = parseFloat(sale_price_inc_vat) * parseFloat(current_quantity);

        $("#Items_total_price_exc_vat").val(unit_price * current_quantity);
        $("#Items_total_price_inc_vat").val(sale_price_inc_vat * current_quantity);


        console.log('Value is ' + unit_price);
        console.log('VAT is ' + vat_percentage);
        console.log('VAT ON unit price ' + vat_on_unit_price);


    }///end of  function calculatevat()

	function todaysdate()
	{
		 var m_names = new Array("Jan", "Feb", "Mar", 
		"Apr", "May", "Jun", "Jul", "Aug", "Sep", 
		"Oct", "Nov", "Dec");

		var d = new Date();
		var curr_date = d.getDate();
		var curr_month = d.getMonth();
		var curr_year = d.getFullYear();
		today=curr_date + "-" + m_names[curr_month] + "-" + curr_year;
		console.log('Today is  ' + today);
        
		$("#Items_stock_date").val(today);
	}//end of function todaysdate()
	

</script>