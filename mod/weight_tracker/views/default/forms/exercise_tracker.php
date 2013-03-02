<?php

if (elgg_is_sticky_form('exercise_tracker')) {
	extract(elgg_get_sticky_values('exercise_tracker'));
	elgg_clear_sticky_form('exercise_tracker');
}

$milddur = elgg_view('input/text', array('name' => 'milddur', 'value' => !empty($milddur) ? $milddur : 0, 'class' => 'weight_tracker_text'));
$milddesc = elgg_view('input/text', array('name' => 'milddesc', 'value' => $mild_view));
$moderatedur = elgg_view('input/text', array('name' => 'moderatedur', 'value' => !empty($moderatedur) ? $moderatedur : 0, 'class' => 'weight_tracker_text'));
$moderatedesc = elgg_view('input/text', array('name' => 'moderatedesc', 'value' => $mild_view));
$extremedur = elgg_view('input/text', array('name' => 'extremedur', 'value' => !empty($extremedur) ? $extremedur : 0, 'class' => 'weight_tracker_text'));
$extremedesc = elgg_view('input/text', array('name' => 'extremedesc', 'value' => $mild_view));

echo "<h3>Add new datapoint</h3>";
//echo "<label>Date:</label> ";
$datefield = elgg_view('input/text', array('name' => 'date', 'value' => $date, 'id' => 'weight_tracker_datepicker', 'class' => 'weight_tracker_text')) . "<br>";
$date = elgg_echo('exercise_tracker:date');
$intensity = elgg_echo('exercise_tracker:intensity:level');
$mild = elgg_echo('exercise_tracker:intensity:mild');
$moderate = elgg_echo('exercise_tracker:intensity:moderate');
$extreme = elgg_echo('exercise_tracker:intensity:extreme');
$duration = elgg_echo('exercise_tracker:duration:minutes');
$description = elgg_echo('exercise_tracker:description');
$selectdate = elgg_echo('exercise_tracker:date:select');
$html = <<<table
<table class="exercise_tracker_form">
<tr class="exercise_tracker_table_header">
	<td>
		{$date}
	</td>
	<td>
		{$intensity}
	</td>
	<td>
		{$duration}
	</td>
	<td style="width: 310px;">
		{$description}
	</td>
</tr>
<tr>
	<td rowspan=3>
		{$selectdate}:<br>
        {$datefield}
	</td>
	<td>
		{$mild}
	</td>
	<td>
		{$milddur}
	</td>
	<td>
		{$milddesc}
	</td>
</tr>
<tr>
	<td>
		{$moderate}
	</td>
	<td>
		{$moderatedur}
	</td>
	<td>
		{$moderatedesc}
	</td>
</tr>
<tr>
	<td>
		{$extreme}
	</td>
	<td>
		{$extremedur}
	</td>
	<td>
		{$extremedesc}
	</td>
</tr>
</table>
table;

echo $html;
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

