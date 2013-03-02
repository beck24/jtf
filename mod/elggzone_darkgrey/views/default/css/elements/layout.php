<?php
/**
 * Page Layout
 *
 * Contains CSS for the page shell and page layout
 *
 * Default layout: 990px wide, centered. Used in default page shell
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	PAGE LAYOUT
*************************************** */
/***** DEFAULT LAYOUT ******/
<?php // the width is on the page rather than topbar to handle small viewports ?>
.elgg-page-default {
	min-width: 998px;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	width: 990px;
	margin: 0 auto;
	height:160px;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
	width: 990px;
	margin: 0 auto;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
	width: 990px;
	margin: 0 auto;
	padding: 5px 0;
	background: transparent url(<?php echo elgg_get_site_url(); ?>mod/elggzone_darkgrey/graphics/line.png) repeat-x top left;
}

/***** TOPBAR ******/
.elgg-page-topbar {
	position: relative;
	height:30px;
	z-index: 9000;
}
.elgg-page-topbar > .elgg-inner {
	background: transparent url(<?php echo elgg_get_site_url(); ?>mod/elggzone_darkgrey/graphics/line.png) repeat-x bottom left;
	width: 990px;
	margin: 0 auto;
	height:30px;
	padding: 8px 0 2px;
}

/***** PAGE MESSAGES ******/
.elgg-system-messages {
	position: fixed;
	top: 24px;
	right: 20px;
	max-width: 500px;
	z-index: 9001;
}
.elgg-system-messages li {
	margin-top: 10px;
}
.elgg-system-messages li p {
	margin: 0;
}

/***** PAGE HEADER ******/
.elgg-page-header {
	position: relative;
}
.elgg-page-header > .elgg-inner {
	position: relative;
}

/***** PAGE BODY LAYOUT ******/
.elgg-layout {
	min-height: 360px;
}
.elgg-layout-one-sidebar {

}
.elgg-layout-two-sidebar {

}
.elgg-layout-error {
	margin-top: 20px;
}
.elgg-sidebar {
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
	position: relative;
	padding: 20px;
	float: right;
	width: 210px;
	margin: 0 0 0 10px;
}
.elgg-sidebar-alt {
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
	position: relative;
	padding: 20px;
	float: left;
	width: 160px;
	margin: 0 10px 0 0;
}
.elgg-main {
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
	position: relative;
	min-height: 360px;
	padding: 20px;
}
.elgg-main > .elgg-head {
	padding-bottom: 3px;
	border-bottom:1px solid #59626D;
	margin-bottom: 10px;
}

/***** PAGE FOOTER ******/
.elgg-page-footer {
	position: relative;
    margin-top:20px;
    padding-bottom:10px;
}
.elgg-page-footer {

}
.elgg-page-footer a:hover {

}