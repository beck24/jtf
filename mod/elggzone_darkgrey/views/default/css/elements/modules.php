/* ***************************************
	Modules
*************************************** */
.elgg-module {
	overflow: hidden;
	margin-bottom: 20px;
}

/* Aside */
.elgg-module-aside .elgg-head {
	border-bottom: 1px solid #59626D;	
	margin-bottom: 5px;
	padding-bottom: 5px;
}

/* Info */
.elgg-module-info > .elgg-head {
	padding: 5px 0;
	margin-bottom: 10px;
	border-bottom: 1px solid #59626D;	
}
.elgg-module-info > .elgg-head * {
	color: #FFF;
}

/* Popup */
.elgg-module-popup {
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg80.png) repeat;
	border: 1px solid #59626D;	
	
	z-index: 9999;
	margin-bottom: 0;
	padding: 5px;
	-webkit-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
}
.elgg-module-popup > .elgg-head {
	margin-bottom: 5px;
}
.elgg-module-popup > .elgg-head * {
	color: #59626D;
}

/* Dropdown */
.elgg-module-dropdown {
	background-color:white;
	border:5px solid #CCC;
	
	-webkit-border-radius: 5px 0 5px 5px;
	-moz-border-radius: 5px 0 5px 5px;
	border-radius: 5px 0 5px 5px;
	
	display:none;
	
	width: 210px;
	padding: 12px;
	margin-right: 0px;
	z-index:100;
	
	-webkit-box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	-moz-box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	
	position:absolute;
	right: 0px;
	top: 100%;
}

/* Featured */
.elgg-module-featured {
	border: 1px solid #59626D;
}
.elgg-module-featured > .elgg-head {
	padding: 5px;
    border-bottom: 1px solid #59626D;
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
}
.elgg-module-featured > .elgg-head * {
	color: white;
}
.elgg-module-featured > .elgg-body {
	padding: 10px;
}

/* ***************************************
	Widgets
*************************************** */
.elgg-widgets {
	float: right;
	min-height: 30px;
}
.elgg-widget-add-control {
	text-align: right;
	margin: 5px 5px 15px;
}
.elgg-widgets-add-panel {
	padding: 10px;
	margin: 0 5px 15px;
    border: 1px solid #59626D;
}
<?php //@todo location-dependent style: make an extension of elgg-gallery ?>
.elgg-widgets-add-panel li {
	float: left;
	margin: 2px 10px;
	width: 200px;
	padding: 4px;
	background:#79828F;
    border: 1px solid #59626D;
	font-weight: bold;
}
.elgg-widgets-add-panel li a {
	display: block;
}
.elgg-widgets-add-panel .elgg-state-available {
	color: #FFF;
	cursor: pointer;
}
.elgg-widgets-add-panel .elgg-state-available:hover {
	background: #939BA5;
}
.elgg-widgets-add-panel .elgg-state-unavailable {
    background:#49515B;
	color:#59626D;
}

.elgg-module-widget {
	padding: 2px;
	margin: 0 5px 15px;
	position: relative;
    border: 1px solid #59626D;
}
.elgg-module-widget:hover {

}
.elgg-module-widget > .elgg-head {
	color: #d2d8de;
    border-bottom: 1px solid #59626D;
    background: url(<?php echo $vars['url']; ?>mod/elggzone_darkgrey/graphics/gradients/bg40.png) repeat;
	height: 26px;
	overflow: hidden;
}
.elgg-module-widget > .elgg-head h3 {
	float: left;
	padding: 4px 45px 0 20px;
	color: #FFF;
}
.elgg-module-widget.elgg-state-draggable .elgg-widget-handle {
	cursor: move;
}
a.elgg-widget-collapse-button {
	color: #c5c5c5;
}
a.elgg-widget-collapse-button:hover,
a.elgg-widget-collapsed:hover {
	color: #9d9d9d;
	text-decoration: none;
}
a.elgg-widget-collapse-button:before {
	content: "\25BC";
}
a.elgg-widget-collapsed:before {
	content: "\25BA";
}
.elgg-module-widget > .elgg-body {
	width: 100%;
	overflow: hidden;
}
.elgg-widget-edit {
	display: none;
	width: 96%;
	padding: 2%;
    border-bottom: 1px solid #59626D;
}
.elgg-widget-content {
	padding: 10px;
}
.elgg-widget-content .elgg-form-messageboard-add{
	margin-right: 10px;
}
.elgg-widget-placeholder {
	border: 1px dashed #dedede;
	margin-bottom: 15px;
}