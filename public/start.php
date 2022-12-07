<?php

/**
 * Gets the application start timestamp.
 */
defined('IO_BEGIN_TIME') or define('IO_BEGIN_TIME', microtime(true));

$config = [
    'client_name'   => 'basic',
    'dev_type'      => 'local',
    'app_type'      => 'backend',
];

return $config;