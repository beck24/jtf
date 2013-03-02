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

$divid = "weight_tracker_graph-" . $string;

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
if(strlen($vars['datapoints']) > 4){
  
  $emptymessage = "";
  $xlabel = elgg_echo('weight_tracker:graph:xlabel');
  $ylabel = elgg_echo('weight_tracker:graph:ylabel');
?>
<script>
$(document).ready(function(){
	  var line1=[<?php echo $vars['datapoints']; ?>];
	  var plot1 = $.jqplot('<?php echo $divid; ?>', [line1], {
	    title:'<?php echo sprintf(elgg_echo('weight_tracker:graph:title'), $vars['entity']->name); ?>',
	    seriesDefaults: {
	        show: true,
	        showMarker: false  
	    },
	    axes:{
	      xaxis:{
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
	      yaxis:{
	    	label:'<?php echo $ylabel; ?>',
	        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
	        labelOptions: {
	    		textColor: '#cfcfcf'
	        }
	       }
	    },
	    highlighter: {
	      show: false
	    },
	    cursor: {
	      show: true,
	      tooltipLocation: 'ne',
	      zoom: true
	    },
	    markerOptions: {
            show: false
	    }
	  });
	});
</script>
<?php
}
?>

<div id="<?php echo $divid; ?>" style="width:<?php echo $vars['width']; ?>px; height:<?php echo $vars['height']; ?>px;"><?php echo $emptymessage; ?></div>
