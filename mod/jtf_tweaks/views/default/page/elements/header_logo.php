<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>

<a class="elgg-heading-site" href="<?php echo $site_url; ?>"><img src="<?php echo $site_url; ?>mod/jtf_tweaks/graphics/logo.png" alt="<?php echo $site_name; ?>" /></a>

<?php 
$startweight = elgg_get_plugin_setting('start_weight', 'weight_tracker');
$currentweight = elgg_get_plugin_setting('current_weight', 'weight_tracker');
$deltaweight = $currentweight - $startweight;

$prefix = ($deltaweight > 0) ? "+" : "";
?>
<div class="jtf_tweaks_site_total_weight">
	Site Totals
	<table width="100%" cellpadding="0">
		<tr>
			<td>
				Start:
			</td>
			<td>
				<?php echo round($startweight, 1); ?> lbs
			</td>
		</tr>
		<tr>
			<td>
				Current:
			</td>
			<td>
				<?php echo round($currentweight, 1); ?> lbs
			</td>
		</tr>
		<tr class="jtf_tweaks_delta_weight">
			<td>
				&Delta;:
			</td>
			<td>
				<?php echo $prefix . round($deltaweight, 1); ?> lbs
			</td>
		</tr>
	</table>
</div>



















