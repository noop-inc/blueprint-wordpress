<?php

/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?? true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);
Config::define('DISALLOW_INDEXING', true);

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);

Config::define('S3_UPLOADS_KEY', 'ABCDEF');
Config::define('S3_UPLOADS_SECRET', '1234567890');

// Or if using IAM instance profiles, you can use the instance's credentials:
// define( 'S3_UPLOADS_USE_INSTANCE_PROFILE', true );

// Config::define('S3_UPLOADS_USE_LOCAL', true);
