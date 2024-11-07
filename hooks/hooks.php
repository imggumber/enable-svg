<?php
if (!defined('ABSPATH')) {
    exit;
}

// The upload filter to sanitize SVG files
function svg_support_sanitize_svg_file($file)
{
    // Check if it's an SVG file
    if ($file['type'] === 'image/svg+xml') {
        // Get the file path from the array
        $file_path = $file['tmp_name'];

        // Ensure the file exists before proceeding
        if (file_exists($file_path)) {
            // Load the SVG content
            $svg_content = file_get_contents($file_path);

            // Remove any potential malicious code (like <script> tags)
            $svg_content = preg_replace('/<script.*?>.*?<\/script>/is', '', $svg_content);

            // Optionally, remove DOCTYPE and XML declaration as they could be dangerous
            $svg_content = preg_replace('/<!DOCTYPE.*?>/is', '', $svg_content); // Remove DOCTYPE
            $svg_content = preg_replace('/<\?xml.*?>/is', '', $svg_content);    // Remove XML declaration

            // Save sanitized content back to file
            file_put_contents($file_path, $svg_content);
        } else {
            // Log error if file doesn't exist
            error_log('Error: SVG file does not exist at ' . $file_path);
        }
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'svg_support_sanitize_svg_file');

// Add the MIME type for SVG files
function svg_support_mime_types($file_types)
{
    // Allow SVG files with the correct MIME type
    $file_types['svg'] = 'image/svg+xml';
    return $file_types;
}
add_filter('upload_mimes', 'svg_support_mime_types');
