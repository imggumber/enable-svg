<?php

/**
 * Plugin Name: Enable SVG with Garry
 * Description: Used to enable SVG support by allowing unfiltered file uploads.
 * Version: 1.0.0
 * Requires at least: 6.6.2
 * Requires PHP: 8.1
 * Author: Gurpreet Gumber
 * Author URI: https://github.com/imggumber
 * License: GPLv2 or later
 * Text Domain: enablesvggarry
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Path to wp-config.php file
define('WP_CONFIG_PATH', ABSPATH . 'wp-config.php');
define('ESBG_PLUGIN_DIR', plugin_dir_path(__FILE__));
require_once ESBG_PLUGIN_DIR . '/hooks/hooks.php';
require_once ESBG_PLUGIN_DIR . '/helper/helper.php';

// Function to activate the plugin and add the constant to wp-config.php
function svg_support_activate()
{
    esbg_enable_svg_upload(WP_CONFIG_PATH);
}

// Function to deactivate the plugin and remove the constant from wp-config.php
function svg_support_deactivate()
{
    esbg_disable_svg_upload(WP_CONFIG_PATH);
}

// Hook into plugin activation and deactivation
register_activation_hook(__FILE__, 'svg_support_activate');
register_deactivation_hook(__FILE__, 'svg_support_deactivate');

