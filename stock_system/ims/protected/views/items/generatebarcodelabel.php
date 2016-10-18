<?php $barcodeimageurl = Setup::model()->getbarcodelabelurl($model->barcode); ?>
<div>

    <?php $barcode_html_img_tag = CHtml::image($barcodeimageurl, $model->part_number); ?>
    <?php echo $barcode_html_img_tag; ?>
</div>
<br>

<?php echo $model->barcode; ?>
<br>
<?php echo $model->name; ?>
<br>
<?php echo $model->part_number; ?>
<br>

<div class='print' id='printbuttondiv'>
    <button   onclick="printlabel()">Print this label</button>
</div>

<script>

    if (!document.getElementById('content'))
        window.onload = printlabel;
    else
        document.getElementById('printbuttondiv').style.display = 'none';


    function printlabel() {
	    document.getElementById('printbuttondiv').style.display = 'none';
	    window.print();
    }
</script>
