
<h2> Net Value of All stock until Now </h2>
<table style="width: 50%;">
    <tr>
        <td>Total (Exc. VAT)</td>
        <td><?php echo $json_data->totalvalueofallstock->total_exc_vat; ?></td>
    </tr>
    <tr>
        <td>Total VAT</td>
        <td><?php echo $json_data->totalvalueofallstock->total_vat_amount; ?></td>
    </tr>
    <tr>
        <td>Total (Inc. VAT)</td>
        <td><?php echo $json_data->totalvalueofallstock->total_inc_vat; ?></td>
    </tr>
</table>

<hr>
<h3><?php echo $json_data->other_info->date_range;?></h3>
<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td colspan="3"><b>Year</b></td>
                </tr>
                <tr>
                    <td>Total (Exc. VAT)</td>
                </tr>
                <tr>
                    <td>Total VAT</td>
                </tr>
                <tr></tr>
                <td>Total (Inc. VAT)</td>

                </tr>
            </table>
        </td>
        <?php
                $data_array=json_decode($json_data_string,true);

                //var_dump($data_array);

                foreach ($data_array['yearly_data'] as $key=>$value)
                {
                    //echo '<hr>'.$key;
                ?>  <td>
                    <table>
                        <tr>
                            <td colspan="3"><b><?php echo $key; ?></b></td>
                        </tr>
                        <tr>
                            <td><?php echo $value['data']['total_exc_vat'] ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $value['data']['total_vat_amount'] ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $value['data']['total_inc_vat'] ?></td>

                        </tr>
                    </table>
                    </td>

                <?php }///end of foreach  ?>

    </tr>
</table>


<div>
   <div id="chart_div"></div>
  <script>
  	google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);
     
function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Exc. VAT(GBP)', 'Inc. VAT(GBP)', 'VAT Amount(GBP)'],
        ['2008-2009', 0,0,0],
        ['2009-2010', 329.18, 283.56, 45.62],
        ['2010-2011', 297.5, 250.24, 47.26],
        ['2011-2012', 289.84, 241.55, 48.29],
        ['2012-2013', 404.9, 337.45, 67.45],
        ['2013-2014', 705.16, 587.58, 117.58],
        ['2014-2015', 2103.33, 1755.2, 348.13],
        ['2015-2016', 4794.09, 3983.91, 796.02],

      ]);

		var options = {
          chart: {
           title: 'Yearly Stock Values',
           subtitle: 'Inc. VAT, Exc. VAT, VAT Amount ',
          },
          bar: {groupWidth: "80%"},
          hAxis: {title: 'Value of Stock',minValue: 0,},
       	  vAxis: {title: 'Year'},
	      chartArea: {width: '70%'},
		  height: 1000,
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, options);
 
    
    }
    
    function formatdataforgooglegraphs(data)
    {
		
		
		var json = JSON.parse(data);
		var yearly_data=json['yearly_data'];
 
		console.log(yearly_data["2008-2009"]);
 		
 		console.log('++++++'+json['yearly_data']);
 
		
		for (var i=0; i<json.length;i++){
		
		
			console.log('++++++'+json['yearly_data']);
		}
		
		
		var graphdata = [];
		graphdata["firstName"] = "John";
 
    
    }///end of    function formatdataforgooglegraphs(data)

    
    
    
    </script>
</div>
 
 

<!--

<h1>Total Value oF all Stock</h1>
<table>
    <tr>
        <th> 06-APRIL-2014 TO 05 APRIL 2015</th>
        <th> 06-APRIL-2015 TO 05 APRIL 2016</th>
        <th> 06-APRIL-2016 TO 05 APRIL 2017</th>
    </tr>
    <tr>
        <td>£600.77</td>
        <td>£879.87</td>
        <td>£954.66</td>
    </tr>
    <tr>
        <td>600.77</td>
        <td>1479</td>
        <td>2433</td>
    </tr>
</table>
<hr>
<h2> Net Value of All stock until Now </h2>
<p> 600 + 879 + 954 = £ 2433</p>
-->
