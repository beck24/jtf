<?php 
// get url for fireworks image
$fireworks = elgg_get_site_url() . "mod/weight_tracker/js/fireworks/image/particles.gif";
?>

<div id="fireworks-template">
 <div id="fw" class="firework"></div>
 <div id="fp" class="fireworkParticle"><img src="<?php echo $fireworks; ?>" alt="" /></div>
</div>
