<?php 

// because multiple graphs may be on the same page, there may be id conflicts which render blank divs
// I originally used a view counter, but that doesn't work for ajax content and still causes issues
// until I can think of something better, we're going with high entropy randomness to avoid collisions
$length = 10;
$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
$string = '';    

for ($p = 0; $p < $length; $p++) {
   $string .= $characters[mt_rand(0, strlen($characters))];
}

$divid = "exercise_tracker_graph-" . $string;

// IE versions < 9 need special js
if(weight_tracker_check_ie_pre9()){
  elgg_load_js('weight_tracker/jqplot/canvas');
}

elgg_load_css('weight_tracker/jqplot');
elgg_load_js('weight_tracker/jqplot');
elgg_load_js('weight_tracker/jqplot/highlighter');
elgg_load_js('weight_tracker/jqplot/cursor');
elgg_load_js('weight_tracker/jqplot/dateaxis');
elgg_load_js('weight_tracker/jqplot/barRender');
elgg_load_js('weight_tracker/jqplot/categoryAxis');
elgg_load_js('weight_tracker/jqplot/pointLabels');
elgg_load_js('weight_tracker/jqplot/canvasAxisLabel');
elgg_load_js('weight_tracker/jqplot/canvasText');

$emptymessage = "No Data Available";
if(strlen($vars['datapoints']['series']) > 12){
  $emptymessage = "";
  $xlabel = elgg_echo('exercise_tracker:graph:xlabel');
  $ylabel = elgg_echo('exercise_tracker:graph:ylabel');
?>
<script>
$(document).ready(function(){
	 var plot2 = $.jqplot('<?php echo $divid; ?>', <?php echo $vars['datapoints']['series']; ?>, {
		 	title:'<?php echo sprintf(elgg_echo('exercise_tracker:graph:title'), $vars['entity']->name); ?>',
		    // Tell the plot to stack the bars.
		    stackSeries: true,
		    captureRightClick: true,
		    seriesDefaults:{
			  renderer:$.jqplot.BarRenderer,
/*		      fill: true,
		      pointLabels: {
			      show: false
			  }, */
		    },
		    axes: {
	            xaxis: {
	    	        renderer:$.jqplot.DateAxisRenderer,
	  	          	tickOptions:{
	  	            	formatString:'%b&nbsp;%#d&nbsp;\'%y'
	  	          	},
	  	          	label:'<?php echo $xlabel; ?>',
	  	          	labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
	  	          	labelOptions: {
	  		    		textColor: '#cfcfcf'
	  		        }
	            },

	            yaxis: {
	            	padMin: 0,
	            	label: '<?php echo $ylabel; ?>',
	            	labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
	            	labelOptions: {
	    	    		textColor: '#cfcfcf'
	    	        }
	            }
	        },
		    seriesColors: [ "#82ED6F", "#FFF67C", "#FF4444"],
		    cursor: {
			      show: true,
			      tooltipLocation: 'ne',
			      zoom: true
			},
		    legend: {
		      show: <?php echo (!$vars['legend']) ? "true" : $vars['legend']; ?>,
		      location: 'e',
		      placement: 'outside',
		      showLabels: true,
		      labels: ['Mild','Moderate','Extreme'],
			  placement: 'outside'
		    }
		  });
});
</script>
<?php
}
?>

<div id="<?php echo $divid; ?>" style="width:<?php echo $vars['width']; ?>px; height:<?php echo $vars['height']; ?>px;"><?php echo $emptymessage; ?></div>
