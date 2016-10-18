<?php
$this->layout='column1';

$this->menu = array(
    array('label' => 'List Items', 'url' => array('index')),
    array('label' => 'Create Items', 'url' => array('create')),
    //array('label'=>'Update This Items', 'url'=>array('update', 'id'=>$model->item_id)),
    //array('label'=>'Delete Items', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->item_id),'confirm'=>'Are you sure you want to delete this item?')),
    //array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>


<h1>Item #&nbsp;&nbsp; <?php echo $model->name; ?></h1>


<table>
    <tr>

        <td>
            <h2>Current Quantity# <?php echo $model->current_quantity; ?></h2>

            <div style="width: 150px;">
                <div class='addbuttoninrow'>
                    <?php echo CHtml::link( CHtml::image('images/add.png', 'Add Quantity') , array('inboundItemsHistory/create', 'main_item_id'=>$model->item_id ), array('title'=>'Add Quantity', 'style' => 'text-decoration: blink; font-size: 18px;font-weight: bold;')); ?>
                </div>
                <div class="removebuttoninrow">
                    <?php echo CHtml::link( CHtml::image('images/remove.png', 'Remove Quantity') , array('outboundItemsHistory/create', 'main_item_id'=>$model->item_id ), array('title'=>'Remove Quantity',  'style' => 'text-decoration: blink; font-size: 18px;font-weight: bold;')); ?>

                </div>
            </div>


        </td>
        <td style="text-align: right;">
                <?php $this->renderPartial('generatebarcodelabel', array('model' => $model)); ?>
                <?php echo CHtml::link('Print Barcode', array('items/generatebarcodelabel',
                'id' => $model->item_id),
                array('target' => '_blank',
                    'class' => 'fa fa-print fa-2x'
                )
            ); ?>
        </td>
    </tr>
</table>


<div style="text-align: left;">
    <?php echo CHtml::link('Edit', array('update', 'id' => $model->item_id), array('class'=>'fa fa-pencil-square-o fa-2x')); ?>
</div>
<h2 style="text-align: center">Item Transaction History</h2>

<table>
    <tr>
        <td style="padding: 20px;background-color: #b8f5ad;margin: 10px;border-radius: 10px;">
            <h3>Inbound</h3>
            <table>
                <tr>
                    <th>Scanned Date</th>
                    <th>Quantity Added</th>
                    <th>Purchase Unit Price (exc VAT)</th>
                    <th>Purchase Unit Price (Inc VAT)</th>
                    <th>Supplier</th>
                    <th>Purchase Date</th>

                    <th>Comments</th>

                </tr>
                <?php
                $inbounds = $model->getinboundhistoryofthisitem($model->item_id);
                foreach ($inbounds as $i) { ?>
                    <tr>
                        <td><?php echo Setup::model()->formatinboundoutbounddate($i->created); ?></td>
                        <td><?php echo $i->quantity_moved?></td>

                        <td><?php echo $i->unit_price_exc_vat; ?></td>
                        <td><?php echo $i->unit_price_inc_vat?></td>

                        <td><?php echo $i->supplier->name; ?></td>
                        <td><?php echo Setup::model()->formatdate($i->item_purchase_date); ?></td>

                        <td><?php echo $i->comments; ?></td>

                    </tr>
                <?php } ///end of foreach ?>
            </table>

        </td>
        <td></td>
        <td style="padding: 20px; background-color: #ffae45;margin: 10px;border-radius: 10px;">
            <h3>Outbound</h3>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Quantity Removed</th>
                    <th>Comments</th>
                </tr>
                <?php
                $outbounds = $model->getoutboundhistoryofthisitem($model->item_id);
                foreach ($outbounds as $o) { ?>
                    <tr>
                        <td><?php echo Setup::model()->formatinboundoutbounddate($o->created); ?></td>
                        <td><?php echo $o->quantity_moved?></td>
                        <td><?php echo $o->comments; ?></td>
                    </tr>
                <?php } ///end of foreach ?>
            </table>
        </td>
    </tr>
</table>







<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'item_id',
        //'company_id',
        'part_number',
        'name',
        'description',
        'barcode',
        'location_room',
        'location_row',
        'location_column',
        'location_shelf',
        //'category_id',
        'current_quantity',
        'available_quantity',
        'recommended_lowest_quantity',
        'recommended_highest_quantity',
        'remarks',
		//'active',

		
        array(  'name'=>'stock_date',
 					'value'=>(Setup::model()->formatdate($model->stock_date)),
 			),
		
        array(  'name'=>'purchase_date',
 					'value'=>(Setup::model()->formatdate($model->purchase_date)),
 			),
		
		
        array('name' => 'active',
            'value' => (($model->active == 0) ? "No" : "Yes"),
        ),
        
        //'image_url',
		'unit_price',
        'sale_price',
   		'vat_percentage',
		'vat_amount',
		'total_price_exc_vat',
		'total_price_inc_vat',
        //'factory_due_date',

// 		array(  'name'=>'factory_due_date',
// 					//'value'=>(date('d-M-Y',$model->factory_due_date)),
// 			),		'value'=>(($model->factory_due_date=='')?"":"Yes"),

        //'suppliers_id',
        'suppliers.name',
        'fits_in_model',
        //'created',
        array('name' => 'created',
            'value' => (date('d-M-Y H:i', $model->created)),
        ),
        array('name' => 'modified',
            'value' => (date('d-M-Y H:i', $model->modified)),
        ),

        //	'deleted',
    ),
)); ?>

<br>

   <!-- Item Other Details End-->


    <div class="itemheadingbox">
        Comments
    </div>
    <div class="itemdatabox">

        <?php //echo $form->labelEx($model,'comments'); ?><br>
        <?php //echo $form->textArea($model, 'comments', array('rows' => 8, 'cols' => 60, 'value' => '')); ?>
        <?php //echo $form->error($model, 'comments'); ?>
        <div style="width:70%;">
            <?php echo Setup::model()->printjsonnotesorcommentsinhtml($model->comments); ?>
        </div>
    </div>
    
<br>
<br>
