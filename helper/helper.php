<?php
if (!defined('ABSPATH')) {
    exit;
}

// Enable SVG Upload
function esbg_enable_svg_upload($wp_config_path)
{
    // Ensure wp-config.php exists and is writable
    if (file_exists($wp_config_path) && is_writable($$wp_config_path)) {
        // Read wp-config.php file
        $wp_config = file_get_contents($wp_config_path);

        // Check if the constant is already defined, to avoid redefining it
        if (strpos($wp_config, 'ALLOW_UNFILTERED_UPLOADS') === false) {
            // Append the constant definition before the line "/* That's all, stop editing! Happy publishing. */"
            $wp_config .= "\n// Enable unfiltered uploads for SVG files\n";
            $wp_config .= "define('ALLOW_UNFILTERED_UPLOADS', true);\n";

            // Write the updated content back to wp-config.php
            file_put_contents($wp_config_path, $wp_config);
        }
    } else {
        // Log error if wp-config.php is not writable
        error_log('Error: wp-config.php is not writable or does not exist.');
    }
}

// Disable SVG Upload
function esbg_disable_svg_upload($wp_config_path)
{
    // Ensure wp-config.php exists and is writable
    if (file_exists($wp_config_path) && is_writable($wp_config_path)) {
        // Read wp-config.php file
        $wp_config = file_get_contents($wp_config_path);

        // Remove the line where the constant is defined
        $wp_config = preg_replace('/define\(\'ALLOW_UNFILTERED_UPLOADS\', true\);/', '', $wp_config);

        // Write the updated content back to wp-config.php
        file_put_contents($wp_config_path, $wp_config);
    } else {
        // Log error if wp-config.php is not writable
        error_log('Error: wp-config.php is not writable or does not exist.');
    }
}
