<?php

/* ***********************************************************************
 * @author : Purusothaman Ramanujam
 * @link http://www.iYaffle.com/
 * Under this agreement, No one has rights to sell this script further.
 * ***********************************************************************/
 
    function fb_like_init()
    {
	// Extend the below views to have the FB Like button.
         elgg_extend_view('object/elements/summary', 'fb_like/like_me');
         elgg_extend_view('page/elements/comments', 'fb_like/comment_like',345);
    }
 
    register_elgg_event_handler('init','system','fb_like_init');
 
?>