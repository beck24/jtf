<?php
/**
 * Elgg Profile CSS
 * 
 * @package Profile
 */
?>
/* ***************************************
	Profile
*************************************** */
.profile {
	float: left;
	margin-bottom: 15px;
}
.profile .elgg-inner {
	margin: 0 5px;
	border: 1px solid #59626D;
}
#profile-details {
	padding: 15px;
}
/*** ownerblock ***/
#profile-owner-block {
	width: 200px;
	float: left;
	border-right: 1px solid #59626D;
	padding: 15px;
}
#profile-owner-block .large {
	margin-bottom: 10px;
}
#profile-owner-block a.elgg-button-action {
	margin-bottom: 4px;
	display: table;
}
.profile-content-menu a {
	display: block;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 0;
}
.profile-content-menu a:hover {
	text-decoration: none;
}
.profile-admin-menu {
	display: none;
}
.profile-admin-menu-wrapper a {
	display: block;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 0;
}
.profile-admin-menu-wrapper {
}
.profile-admin-menu-wrapper li a {
	color: red;
	margin-bottom: 0;
}
.profile-admin-menu-wrapper a:hover {
	color: black;
}
/*** profile details ***/
#profile-details .odd {
	border-bottom: 1px solid #59626D;
	margin: 0 0 7px;
	padding: 2px 0;
}
#profile-details .even {
	border-bottom: 1px solid #59626D;
	margin: 0 0 7px;
	padding: 2px 0;
}
.profile-aboutme-title {
	border-bottom: 1px solid #59626D;
	margin: 0;
	padding: 2px 0;
}
.profile-aboutme-contents {
	padding: 2px 0 0 0;
}
.profile-banned-user {
	border: 1px solid red;
	padding: 4px 8px;
}
/* ***************************************
	Modules - AVATAR
*************************************** */
.elgg-sidebar #profile-owner-block{
	background:none;
    height:200px;
	padding:5px;
	margin:0 0 20px 0;
	border: 1px solid #59626D;
    overflow:hidden; 
}
