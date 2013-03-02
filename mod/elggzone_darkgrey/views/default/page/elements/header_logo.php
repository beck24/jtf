<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>

<a class="elgg-heading-site" href="<?php echo $site_url; ?>"><img src="<?php echo $site_url; ?>mod/elggzone_darkgrey/graphics/logo.png" alt="<?php echo $site_name; ?>" /></a>
