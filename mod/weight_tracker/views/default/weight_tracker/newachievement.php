<?php
// load our js and css
elgg_load_css('weight_tracker/fireworks');
elgg_load_js('weight_tracker/fireworks/sound');
elgg_load_js('weight_tracker/fireworks/js');

$user = elgg_get_logged_in_user_entity();

// get our achievements
$newachievements = unserialize($user->weight_tracker_newachievements);
$user->weight_tracker_newachievements = "";

// set the sound
$src = elgg_get_site_url() . "mod/weight_tracker/audio/achievement.mp3";

// create the html for the achievements display
$markup = "<h3>" . elgg_echo('weight_tracker:achievement:new') . "</h3><br><br>";
foreach($newachievements as $achievement){
  $markup .= "<img src=\"" . elgg_get_site_url() . "mod/weight_tracker/graphics/" . $achievement . ".png\"><br>";
}
$markup .= "<b>" . elgg_echo('weight_tracker:achievement:instructions') . "</b>";

?>

<embed src="<?php echo $src; ?>" autostart="true" hidden="true" loop="false">

<script>
$(document).ready(function(){
    //add modal background
    $('<div />').addClass('weight_tracker_lightbox').html('<div id="fireContainer"></div>').appendTo('body').show();
    //add modal window
    $('<div />').html('<?php echo $markup; ?>').addClass('weight_tracker_modal').appendTo('body');


    setTimeout("$('.weight_tracker_lightbox, .weight_tracker_modal').fadeOut('slow');", 7000);

    for(var i=0; i<15; i++){
    	setTimeout('createFirework(59,141,7,1,null,null,null,null,false,true);', i*300);
    }
    //createFirework(100,100,1,null,50,100,50,50,false,true);

    // vertically center everything
    $(function() {
        $('.weight_tracker_modal').each(function() {
    	this.style.position = 'absolute';
    	this.style.top = $(this).parent().height()/2 + 'px';
    	this.style.marginTop = (-$(this).height()/2 - 100) + 'px';
    	this.style.left = ($(this).parent().width() - $(this).width())/2 + 'px';
        });
    });
    
});
</script>