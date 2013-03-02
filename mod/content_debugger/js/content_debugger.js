jQuery(document).ready(function() {

    var activeNode = null;
    var tipContent = 'Content Debugger';
    var lastTipContent = tipContent;
    var inTransition = false;

    var htmlEntities = function (str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    };

    var renderTooltip = function(view_info, depth) {
        var tip_content = '';

        // Build displayable view info
        var current_ident = (depth * contentDebugger.tab_stop) + 'px';
        tip_content += '<div style="padding-left: ' + current_ident + '">';
        if (contentDebugger.show_view_name) {
            tip_content += '<span><strong>' + view_info.view + '</strong></span>';
        }
        if (contentDebugger.show_view_files) {
            tip_content += '<ul>';
            $.each(view_info.view_details, function(index, element) {
                tip_content += '<li>' + element + '</li>';
            });
            tip_content += '</ul>';
        }
        if (contentDebugger.show_profiling) {
            tip_content += '<span>Render time: ' + view_info.render_time + '</span> | ';
            tip_content += '<span>Total time: ' + view_info.total_time + '</span>';
        }
        tip_content += '</div>';

        return tip_content;
    };

    var prepareTooltip = function(node) {
        var info_array = [];
        var tip_content = '';

        var node_info = node.data('content_debugger_info');
        if (node_info && node_info.length > 0) {
            $.each(node_info, function(index, info_element) {
                info_array.unshift(info_element);
            });
        }
        node.parents().each(function(i, parentElement) {
            var node_info = $(parentElement).data('content_debugger_info');
            if (node_info && (node_info.length > 0) && ((contentDebugger.display_depth == 0) || (contentDebugger.display_depth > i + 1))) {
                $.each(node_info, function(index, info_element) {
                    info_array.unshift(info_element);
                });
            }
        });

        $.each(info_array, function(index, element) {
            tip_content += renderTooltip(element, index);
        });

        if (info_array.length) {
            tip_content += '<span>Current view depth: ' + info_array.length + '</span>';
        }

        return tip_content;
    };

    $('body').poshytip({
        content: function(updateCallback) {
            return tipContent;
        },
        slide: false,
        followCursor: true
    });

    var parseComments = function walk(node, level, callback) {
        var node = node.firstChild;

        while (node) {

            // Check if current node is a comment generated by the content_debugger plugin
            if ((node.nodeType === 8) && ($.trim(node.nodeValue).indexOf('content_debugger_view_start::') === 0)) {

                level++;
                try {
                    var view_info = $.evalJSON(node.nodeValue.replace('content_debugger_view_start::',''));
                // Find the node(s) that we need to bind the info tooltip to
                } catch(err) {
                    console.error('could not parse ', node.nodeValue.replace('content_debugger_view_end::',''));
                }

                var targetNode = node.nextSibling;
                while (targetNode) {
                    if ((targetNode.nodeType === 8) && ($.trim(targetNode.nodeValue).indexOf('content_debugger_view_end::') === 0)) {
                        try {
                            var view_stop = $.evalJSON(targetNode.nodeValue.replace('content_debugger_view_end::',''));
                        } catch(err) {
                            console.error('could not parse ', targetNode.nodeValue.replace('content_debugger_view_end::',''));
                        }

                        // Stop assigning this view info to siblings, as we have found the "end of view" mark
                        if (view_info.id === view_stop.id) {
                            targetNode = null;
                        }
                    } else if (targetNode.nodeType === 1) {
                        callback(targetNode, view_info, level);
                    }
                    if (targetNode) {
                        targetNode = targetNode.nextSibling;
                    }
                }
            } else if (node.nodeType === 1) {
                walk(node, level + 1, callback);
            }
            node = node.nextSibling;
        }
    };

    // Preprocess css highlight parameters
    var css_markers = {};
    if (contentDebugger.css_highlight.length) {
        var css_parts = contentDebugger.css_highlight.split(';');
        $.each(css_parts, function (index, css_definition) {
            var definition_parts = css_definition.split(':');
            if ($.trim(definition_parts[0]).length && $.trim(definition_parts[1]).length) {
                css_markers[$.trim(definition_parts[0])] = $.trim(definition_parts[1]);
            }
        });
    }

    // Walk the DOM tree and parse all comments generated by the content_debugger plugin
    // Using those comments, create js overlays and info tooltips for each displayed Elgg view
    parseComments(document.body, 0, function(node, view_info, level) {
        var node_info_tree = $(node).data('content_debugger_info');
        if (!node_info_tree) {
            node_info_tree = [];
        }
        $(node).data('content_debugger_info', node_info_tree.concat(view_info));

        var zLevel = 10000 + level * 10;
        // Generate a unique id for the magicmarker object
        var mId = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
            return v.toString(16);
        });

        // Create "magicmarker" object to handle highlighting of the target DOM node
        $(node).magicmarker({
            maskId: mId,
            opacity: 0.3,
            startOpacity: 0.3,
            color: '#000',
            zIndex: zLevel,
            css_markers: css_markers,
            apply_mask: contentDebugger.magicmarker
        });

        // Bind mouseEnter/Exit to display / hide node highlighting w/ magicmarker
        $(node).hover(
            function () {
                var $this = $(this);
                $this.magicmarker('show');
            },
            function () {
                var $this = $(this);
                $this.magicmarker('hide');
            }
        );
    });

    $('body').mousemove(function(event) {
        if (!inTransition && $(event.target) !== activeNode) {
            inTransition = true;
            activeNode = $(event.target);
            tipContent = prepareTooltip(activeNode);
            if (tipContent.length && tipContent !== lastTipContent) {
                lastTipContent = tipContent;
                $('body').poshytip('update');
                $('body').poshytip('show');
            }
            inTransition = false;
        }
    });

    $('a#toggle_content_debugger').click(function() {
        $(this).toggleClass('active');
    });

});
