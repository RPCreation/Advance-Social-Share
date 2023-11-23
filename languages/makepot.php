<?php
// Load WordPress core
if (file_exists('../../../wp-load.php')) {
    require_once('../../../wp-load.php');
}

require_once ABSPATH . 'wp-admin/includes/file.php';

$plugin_slug = 'advance-social-share'; // Replace with your plugin's slug
$plugin_path = dirname(__FILE__);

$output_dir = $plugin_path . '/languages/';
$output_file = 'advance-social-share.pot';

$command = "wp i18n make-pot . {$output_dir}{$output_file}";

echo "Generating POT file...\n";
echo shell_exec($command);
