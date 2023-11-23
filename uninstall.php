<?php
// If uninstall is not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options from the database
delete_option('advance_social_share_options');

// Optionally, you can perform additional cleanup tasks here
// For example, remove custom database tables or other data
// Note: Only perform these tasks if your plugin has created such data

// Example: Remove custom database table
// global $wpdb;
// $table_name = $wpdb->prefix . 'your_custom_table_name';
// $wpdb->query("DROP TABLE IF EXISTS $table_name");

// Remove any custom files or directories created by the plugin
// Replace 'your_custom_directory' with the actual directory name
// Example: Delete a custom directory
// $directory_path = plugin_dir_path(__FILE__) . 'your_custom_directory';
// if (is_dir($directory_path)) {
//     // Recursively delete the directory and its contents
//     function delete_directory($dir) {
//         if (!is_dir($dir)) {
//             return false;
//         }
//         $files = array_diff(scandir($dir), array('.', '..'));
//         foreach ($files as $file) {
//             (is_dir("$dir/$file")) ? delete_directory("$dir/$file") : unlink("$dir/$file");
//         }
//         return rmdir($dir);
//     }
//     delete_directory($directory_path);
// }

// Optionally, you can perform additional cleanup tasks specific to your plugin
// Add your custom cleanup code here

