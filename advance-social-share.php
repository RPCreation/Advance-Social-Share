<?php
/*
Plugin Name: Advance Social Share
Plugin URL: https://wwww.myselftips.in/advance-social-share/
Description: Add social sharing icons to your posts. Share your content on various social media platforms.
Version: 1.2.0
Requires at least: 5.2
Requires PHP: 7.2
Author: RP Creation
Author URI: https://www.instagram.com/myselftips/
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Domain Path: /languages
*/

// Enqueue Font Awesome CSS from the CDN
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}

// Enqueue your custom CSS file
function enqueue_custom_css() {
    wp_enqueue_style('advance-social-share-css', plugin_dir_url(__FILE__) . 'assets/css/social-share.css');
}

// Enqueue your custom JavaScript file
function enqueue_custom_js() {
    wp_enqueue_script('advance-social-share-js', plugin_dir_url(__FILE__) . 'assets/js/social-share.js', array('jquery'), '1.0', true);
}

// Hook functions to appropriate WordPress action hooks
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
add_action('wp_enqueue_scripts', 'enqueue_custom_css');
add_action('wp_enqueue_scripts', 'enqueue_custom_js');

// Add social share buttons to posts
function add_social_share_buttons($content) {
    $options = get_option('advance_social_share_options');
    $enable_social_share = isset($options['enable_social_share']) && $options['enable_social_share'] === 'on';

    if (is_single() && $enable_social_share) {
        // Display the buttons on single post pages
        $post_url = get_permalink();
        $post_title = get_the_title();
        $social_buttons = '
            <div class="social-share-buttons">
                <p style="font-weight: bold; font-family: Arial, sans-serif;">Share this post:</p>
                <a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url($post_url) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook fa-3x"></i></a>
                <a href="https://twitter.com/intent/tweet?url=' . esc_url($post_url) . '&text=' . esc_attr($post_title) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter fa-3x"></i></a>
                <a href="whatsapp://send?text=' . esc_attr($post_title) . ' ' . esc_url($post_url) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp fa-3x"></i></a>
                <a href="https://t.me/share/url?url=' . esc_url($post_url) . '&text=' . esc_attr($post_title) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-telegram fa-3x"></i></a>
                <a href="https://www.instagram.com/share?url=' . esc_url($post_url) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram fa-3x"></i></a>
                <!-- Add more social networks as needed -->
            </div>
        ';
        $content .= $social_buttons;
    }
    return $content;
}

// Add a settings page
function advance_social_share_settings_page() {
    add_options_page(
        'Advance Social Share Settings',
        'Advance Social Share',
        'manage_options',
        'advance-social-share-settings',
        'render_advance_social_share_settings'
    );
}

// Render the settings page content
function render_advance_social_share_settings() {
    ?>
    <div class="wrap">
        <h2>Advance Social Share Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('advance-social-share-settings');
            do_settings_sections('advance-social-share-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings and fields
function advance_social_share_register_settings() {
    register_setting(
        'advance-social-share-settings',
        'advance_social_share_options'
    );

    add_settings_section(
        'advance-social-share-general',
        'General Settings',
        'advance_social_share_general_section_callback',
        'advance-social-share-settings'
    );

    add_settings_field(
        'advance-social-share-enable',
        'Enable Social Share Buttons',
        'advance_social_share_enable_callback',
        'advance-social-share-settings',
        'advance-social-share-general'
    );

    // Add more settings fields as needed
}

// Callback for the General Settings section
function advance_social_share_general_section_callback() {
    echo '<p>Customize the settings for the Advance Social Share plugin here.</p>';
}

// Callback for the "Enable Social Share Buttons" field
function advance_social_share_enable_callback() {
    $options = get_option('advance_social_share_options');
    $checked = isset($options['enable_social_share']) ? 'checked' : '';
    echo '<input type="checkbox" name="advance_social_share_options[enable_social_share]" ' . $checked . '>';
}

// Hook functions to appropriate WordPress action hooks
add_action('admin_menu', 'advance_social_share_settings_page');
add_action('admin_init', 'advance_social_share_register_settings');

add_filter('the_content', 'add_social_share_buttons');

// Rest of your plugin code...
