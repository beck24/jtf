<!-- Display the Facebook Like button in the contents -->

<?php
   $layout      = elgg_get_plugin_setting('layout',     'fb_like');
   $senddata    = elgg_get_plugin_setting('senddata',   'fb_like');
   $showfaces   = elgg_get_plugin_setting('showfaces',  'fb_like');
   $colorscheme = elgg_get_plugin_setting('colorscheme','fb_like');
   $action      = elgg_get_plugin_setting('action',     'fb_like');
   $font        = elgg_get_plugin_setting('font',       'fb_like');
   $width       = elgg_get_plugin_setting('width',      'fb_like');
    
   $full = elgg_extract('full_view', $vars, FALSE);

   if (strlen(trim($width) ) > 0 || !is_numeric($width) )
   {
      $width = 450;
   }

   $context =  elgg_get_context();


   /* if ($full && !elgg_in_context('gallery') && $context != 'thewire' )  {*/
   if ($full && $context != 'thewire' )  {
?>

<br/>

<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=116948495074486";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php $myurl = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];?>

<div class="fb-like" 
     data-href        ="<?php echo $myurl ; ?>" 
     data-width       ="<?php echo $width ; ?>" 
     data-show-faces  ="<?php echo $showfaces ; ?>"
     data-send        ="<?php echo $senddata ; ?>"
     data-font        ="<?php echo $font ; ?>"  
     data-colorscheme ="<?php echo $colorscheme ; ?>" 
     data-layout      ="<?php echo $layout ; ?>"
     data-action      ="<?php echo $action ; ?>" >
</div>

<?php } ?>