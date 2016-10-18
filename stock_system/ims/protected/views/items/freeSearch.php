<?php $this->layout = 'column1'; ?>




<body onload="document.search_form.query.focus()">
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/jquery.js');

?>


<script type="text/javascript">


    $(document).ready(function () {
		doitemsearch();
        //showvalueofstockeachyear();
        $("#faq_search_input").keyup(function () {
			doitemsearch();
        });
    });

    ////////declaring keypressed function
    function keyPressed(e) {
        var key;
        if (window.event)
            key = window.event.keyCode; //IE
        else
            key = e.which; //firefox

        if (key == 13)///checking the value of enter key press which is 13
        {
            return false;
        } else {
            return true;
        }////end of else if (key == 13)
    }/////end of function keypressed ..

	function doitemsearch()
	{
	    var faq_search_input =$("#faq_search_input").val();
        var dataString = 'keyword=' + faq_search_input;


        if (faq_search_input.length > 3) {

                $.ajax({
                    type: "GET",
                    url: 'index.php?r=items/searchEngine',
                    data: dataString,
                    success: function (server_response) {
                        $('#searchresultdata').html(server_response).show();


                    }
                });
            }
            return false;
	
	}////end of function doitemsearch()


</script>



<table>
    <tr>
        <td>Enter Item Name, Part Number or barcode<br><br>
            <!-- The Searchbox Starts Here  -->
            <form name="search_form">
                <input name="query" type="text" onKeyPress="return keyPressed(event);" id="faq_search_input" placeholder="search by barcode, item name or part number  "
                       style=" width:500px; height: 25px; border-radius:5px;  background-color: #F8F8F8"/>
            </form>
            <!-- The Searchbox Ends  Here  -->

        </td>
        <td>

            <div style="background: #FAF88D;border-radius: 12px; float: right; padding: 10px;">
                <table>
                    <tr>
                        <td>
                            <a style="text-decoration: blink;color:#3A290D;" class="fa fa-list fa-2x"></a>
                        </td>
                        <td><?php echo CHtml::link('  List Items', array('items/index'), array('style' => 'text-decoration: blink;color:#3A290D; font-size: 18px;    font-weight: bold;')); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <a style="text-decoration: blink;color:#3A290D;" class="fa fa-plus-circle fa-2x"></a>
                        </td>
                        <td><?php echo CHtml::link('  Create Item', array('items/create'), array('style' => 'text-decoration: blink;color:#3A290D; font-size: 18px;    font-weight: bold;')); ?></td>
                    </tr>
    				<tr>
                        <td>
                            <a style="text-decoration: blink;color:#3A290D;" class="fa fa-sign-in fa-2x"></a>
                        </td>
                        <td><?php echo CHtml::link('Show Inbound History', array('inboundItemsHistory/admin'), array('style' => 'text-decoration: blink;color:#3A290D; font-size: 18px;    font-weight: bold;')); ?></td>
                    </tr>
	               <tr>
                        <td>
                            <a style="text-decoration: blink;color:#3A290D;" class="fa fa-sign-out fa-2x"></a>
                        </td>
                        <td><?php echo CHtml::link('Show Outbound History', array('outboundItemsHistory/admin'), array('style' => 'text-decoration: blink;color:#3A290D; font-size: 18px;    font-weight: bold;')); ?></td>
                    </tr>
                </table>
            </div>

        </td>
    </tr>
</table>




<div id="searchresultdata" class="faq-articles"></div>



<!-- Statistics -->



<div id='value_of_stock_div'>
    <button  class="fa fa-bar-chart"  onclick="showvalueofstockeachyear();">Show Yearly Statistics</button>
</div>

<div id="stats_results"></div>



<script>
    //window.onload = showvalueofstockeachyear;
    function showvalueofstockeachyear() {

        dataString='';
      

        $.ajax({
            type: "GET",
            url: 'index.php?r=items/yearlyvalueofstockstats',
            data: dataString,
            success: function (server_response) {
                $('#searchresultdata').html(server_response).show();
                document.getElementById('value_of_stock_div').style.display = 'none';


            }
        });
        
        
        $.ajax({
            type: "GET",
            url: 'index.php?r=items/getyearlydataofstockjson',
            data: dataString,
            success: function (server_response) {
            	 formatdataforgooglegraphs(server_response)


            }
        });
        
        
        
    }






</script>

<hr>
<br>
<?php echo $this->renderPartial('/site/dashboard'); ?>
 



