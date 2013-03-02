<?php
    global $CONFIG;
    $class = ($_SESSION['content_debugger'] === 'enabled') ? 'class="active"' : '';
?>

<?php if (isadminloggedin()) :
// the dropdown isn't working the same as 1.7.x, switched to an inline link
?>
        <ul class="elgg-menu elgg-menu-topbar elgg-menu-topbar-alt">
            <li>
                <a id="toggle_content_debugger" <?php echo $class; ?> href="<?php echo $CONFIG->wwwroot?>pg/content_debugger/toggle">
                    <?php echo elgg_echo('content_debugger:toggle'); ?>
                </a>
            </li>
        </ul>
<?php endif; ?>
