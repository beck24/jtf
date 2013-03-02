<?php
/**
 * Walled garden CSS
 */

$url = elgg_get_site_url();

?>
.elgg-body-walledgarden {
	margin: 100px auto 0 auto;
	position: relative;
	width: 530px;
}
.elgg-module-walledgarden {
	position: absolute;
	top: 0;
	left: 0;
}
.elgg-module-walledgarden > .elgg-head {
	height: 17px;
}
.elgg-module-walledgarden > .elgg-body {
	padding: 0 10px;
}
.elgg-module-walledgarden > .elgg-foot {
	height: 17px;
}
.elgg-walledgarden-double > .elgg-head,
.elgg-walledgarden-double > .elgg-body,
.elgg-walledgarden-double > .elgg-foot,
.elgg-walledgarden-single > .elgg-head,
.elgg-walledgarden-single > .elgg-body,
.elgg-walledgarden-single > .elgg-foot {
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
}
.elgg-col > .elgg-inner {
	margin: 0 0 0 0;
}
.elgg-col:first-child > .elgg-inner {
	margin: 0;
    padding-right: 18px;
}
.elgg-col:last-child > .elgg-inner {
	border-left: 1px solid #59626D;
    padding-left: 18px;

}
.elgg-col > .elgg-inner {
	padding: 0 8px;
}
.elgg-walledgarden-single > .elgg-body {
	padding: 0 18px;
}
.elgg-module-walledgarden-login {
	margin: 0;
}
.elgg-body-walledgarden h3 {
	font-size: 1.5em;
	line-height: 1.1em;
	padding-bottom: 5px;
}
.elgg-heading-walledgarden {
	margin-top: 60px;
	line-height: 1.1em;
}
input, textarea {
	width: 98%;
}
