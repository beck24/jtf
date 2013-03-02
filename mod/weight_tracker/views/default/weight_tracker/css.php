.weight_tracker_center {
	text-align: center;
}

.weight_tracker_datapoints {
	height: 400px;
	overflow-y: auto;
	text-align: center;
}

.weight_tracker_datapoints table {
	display: inline-block;
}

.weight_tracker_datapoints table tr td {
	vertical-align: middle;
	padding: 2px 5px;
}

.weight_tracker_text {
	width: 100px;
}

#weight_tracker_graph {
	text-align: center;
}

img.weight_tracker_widget_achievement {
	width: 280px;
	height: auto;
}

a.weight_tracker_widget_delete {
	position: absolute;
	left: 285px;
	margin-top: 30px;
}

/* ACHIEVEMENTS MODAL */
    .weight_tracker_lightbox {
    	display:none;
    	position:fixed;
        background:#000000; none repeat scroll 0 0;
        filter:alpha(opacity=50);
        opacity: 0.5;
        width:100%;
        height:100%;
        left:0;
        top:0;
        z-index:700;
    }
    .weight_tracker_modal{
        position:absolute;
        width: 100%;
        top:45%;
        z-index:751;
        text-align: center;
    }
    
    
/*  EXERCISE TRACKER FORM */

table.exercise_tracker_form td{
	padding: 3px 10px;
	vertical-align: middle !important;
}

table.exercise_tracker_form tr.exercise_tracker_table_header td {
	font-weight: bold;
	border-bottom: 1px solid white;
}