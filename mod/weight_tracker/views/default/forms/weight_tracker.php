<?php

if (elgg_is_sticky_form('weight_tracker')) {
	extract(elgg_get_sticky_values('weight_tracker'));
	elgg_clear_sticky_form('weight_tracker');
}

echo "<h3>Add new datapoint</h3>";
echo "<label>Date:</label> ";
echo elgg_view('input/text', array('name' => 'date', 'value' => $date, 'id' => 'weight_tracker_datepicker', 'class' => 'weight_tracker_text')) . " ";
echo "<label>Weight:</label> ";
echo elgg_view('input/text', array('name' => 'weight', 'value' => $weight, 'class' => 'weight_tracker_text')) . " lbs&nbsp;&nbsp;&nbsp;&nbsp;";
echo elgg_view('input/submit', array('name' => 'submit', 'value' => 'Submit'));

?>

<script type="text/javascript">
$(function(){

	// Datepicker
	$('#weight_tracker_datepicker').datepicker({
		inline: true
	});			
});
</script>

