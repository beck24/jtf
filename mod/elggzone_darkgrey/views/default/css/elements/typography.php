<?php
/**
 * CSS typography
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	Typography
*************************************** */
body {
	background: #000 url(<?php echo elgg_get_site_url(); ?>mod/elggzone_darkgrey/graphics/tile_bg.jpg) repeat top left;
	font-size: 80%;
	line-height: 1.4em;
	font-family: "Lucida Grande", Arial, Tahoma, Verdana, sans-serif;
    color:#d2d8de;
}

a {
	color: #B5BFC9;
}

a:hover,
a.selected { <?php //@todo remove .selected ?>
	color: #FFF;
	text-decoration: none;
}

p {
	margin-bottom: 15px;
}

p:last-child {
	margin-bottom: 0;
}

pre, code {
	font-family: Monaco, "Courier New", Courier, monospace;
	font-size: 12px;
	
	background:#EBF5FF;
	color:#000000;
	overflow:auto;

	overflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not needed in Firefox 3 */

	white-space: pre-wrap;
	word-wrap: break-word; /* IE 5.5-7 */
	
}

pre {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
}

code {
	padding:2px 3px;
}

.elgg-monospace {
	font-family: Monaco, "Courier New", Courier, monospace;
}

blockquote {
	line-height: 1.3em;
	padding:3px 15px;
	margin:0px 0 15px 0;
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
	border:none;
	color:#FFF;
    
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}

h1, h2, h3, h4, h5, h6 {
	font-weight: bold;
	color:#FFF;
}

h1 { font-size: 1.6em; }
h2 { font-size: 1.35em; line-height: 1.1em; padding-bottom:5px}
h3 { font-size: 1.1em; }
h4 { font-size: 1.0em; }
h5 { font-size: 0.9em; }
h6 { font-size: 0.8em; }

.elgg-heading-site, .elgg-heading-site:hover {
    height:86px;
    width:224px;
	font-size: 2em;
	line-height: 1.4em;
	color: white;
	font-family: Georgia, times, serif;
	text-shadow: 1px 2px 4px #333333;
	text-decoration: none;
}
.elgg-heading-site img {
	margin-top:20px;
}

.elgg-heading-main {
	float: left;
	max-width: 530px;
	margin-right: 10px;
}
.elgg-heading-basic {
	color: #0054A7;
	font-size: 1.2em;
	font-weight: bold;
}

.elgg-subtext {
	color:#788A9A;
	font-size: 85%;
	line-height: 1.2em;
	font-style: italic;
}

.elgg-text-help {
	display: block;
	font-size: 85%;
	font-style: italic;
}

.elgg-quiet {
	color:#788A9A;
}

.elgg-loud {
	color: #0054A7;
}

/* ***************************************
	USER INPUT DISPLAY RESET
*************************************** */
.elgg-output {
	margin-top: 10px;
}

.elgg-output dt { font-weight: bold }
.elgg-output dd { margin: 0 0 1em 1em }

.elgg-output ul, .elgg-output ol {
	margin: 0 1.5em 1.5em 0;
	padding-left: 1.5em;
}
.elgg-output ul {
	list-style-type: disc;
}
.elgg-output ol {
	list-style-type: decimal;
}
.elgg-output table {
	border: 1px solid #ccc;
}
.elgg-output table td {
	border: 1px solid #ccc;
	padding: 3px 5px;
}
.elgg-output img {
	max-width: 100%;
}