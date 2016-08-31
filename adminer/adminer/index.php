<?php
function adminer_object() {
    require __DIR__. '/plugin.php';
    require __DIR__. '/extra.php';
    $plugins = [
        new AdminerDumpJson(),
        new AdminerSqlLog(__DIR__. '/../sql_logs'),
        new AdminerRestoreMenuScroll(),
        new AdminerTablesFilter(),
    ];
    return new AdminerPlugin($plugins);
}

require __DIR__. '/adminer.php';
