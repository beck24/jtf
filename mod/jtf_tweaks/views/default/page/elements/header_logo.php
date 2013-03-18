<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>

<div class="jtf-header-contents">
<a class="jtf-header-logo" href="<?php echo $site_url; ?>"><img src="<?php echo $site_url; ?>mod/jtf_tweaks/graphics/logo.png" alt="<?php echo $site_name; ?>" /></a>

<?php

if (elgg_is_logged_in()) {
  echo elgg_view('page/elements/header/personal_totals', array('entity' => elgg_get_logged_in_user_entity()));
}
else {
  echo elgg_view('page/elements/header/site_totals');
}
?>

</div>